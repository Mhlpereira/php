<?php
namespace App\Service;

use App\Entities\Team;
use App\Entities\User;

use App\Repository\TeamRepository;
use App\Dto\TeamCreateDto;
use App\Dto\EnrollDto;
use App\Service\CourseService;
use App\Dto\TeamUpdateDto;

class TeamsService
{   
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository, CourseService $courseService) {
        $this->teamRepository = $teamRepository;
        $this->courseService = $courseService;
    }


    public function enrollUserInTeam(EnrollDto $enrollDto): void
    {
        if (empty($enrollDto->getUserId()) || empty($enrollDto->getCourseId()) || empty($enrollDto->getTeamId())) {
            throw new \InvalidArgumentException('User ID, Course ID, and Team ID are required');
        }
        $team = $this->teamRepository->getTeamById($enrollDto->getTeamId());
        if (!$team) {
            throw new \InvalidArgumentException('Team not found');
        }
        if ($team->getStatus() === TeamStatus::CLOSED) {
            throw new \InvalidArgumentException('Team is not available for enrollment');
        }
        $this->teamRepository->enrollUserInTeam($enrollDto);
    }
    public function getTeamById(string $teamId): Team
    {
        $team = $this->teamRepository->getTeamById($teamId);
        if($team){
            this->verifyTeamEndingDate($teamId);
            this->verifyTeamCapacity($teamId);
        }
        if (!$team) {
            throw new \InvalidArgumentException('Team not found');
        }
        return $team;
    }

    public function createTeam(TeamCreateDto $data): team{
        try{
        if (empty($data->getName()) || empty($data->getCourseId())) {
            throw new \InvalidArgumentException('Team name and course ID are required');
        }
        if (!$this->courseService->getCourseById($data->getCourseId())) {
            throw new \InvalidArgumentException('Course not found');
        }
        $team = $this->teamRepository->createTeam($data);
        if (!$team) {
            throw new \Exception('Error creating team');
        }
        return $team;
        }catch (\Exception $e) {
            throw new \Exception('Error creating team: ' . $e->getMessage());
        }
    }

    public function updateTeam(TeamUpdateDto $data){
        try{
            $team = $this->getTeamById($data->getTeamId());
            if (!$team) {
                throw new \InvalidArgumentException('Team not found');
            }
            $updatedTeam = $this->teamRepository->updateTeam($team, $data);
            if (!$updatedTeam) {
                throw new \Exception('Error updating team');
            }
            return $updatedTeam;
        } catch (\Exception $e) {
            throw new \Exception('Error updating team: ' . $e->getMessage());
        }
    }

    public function deleteTeam(string $teamId): void
    {
        try {
            $team = $this->getTeamById($teamId);
            if (!$team) {
                throw new \InvalidArgumentException('Team not found');
            }
            $this->teamRepository->deleteTeam($teamId);
        } catch (\Exception $e) {
            throw new \Exception('Error deleting team: ' . $e->getMessage());
        }
    }

    private function closeTeam(string $teamId): void
    {
        try {
            $team = $this->getTeamById($teamId);
            if (!$team) {
                throw new \InvalidArgumentException('Team not found');
            }
            $team->setStatus(TeamStatus::CLOSED);
            $this->teamRepository->updateTeam($team);
        } catch (\Exception $e) {
            throw new \Exception('Error closing team: ' . $e->getMessage());
        }
    }
    
    private function verifyTeamEndingDate(string $teamId): void
    {
        try {
            $currentDate = new \DateTime();
            if ($team->getEndingDate() < $currentDate) {
                $this->closeTeam($teamId);
            }
        } catch (\Exception $e) {
            throw new \Exception('Error verifying team ending date: ' . $e->getMessage());
        }
    }

    private function verifyTeamCapacity(string $teamId): void
    {
        try {
            if (count($team->getStudents()) >= $team->getMaxStudents()) {
                $this->closeTeam($teamId);
            }
        } catch (\Exception $e) {
            throw new \Exception('Error verifying team capacity: ' . $e->getMessage());
        }
    }
}