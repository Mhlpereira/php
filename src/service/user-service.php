<?php 

namespace App\Service;

use App\Repository\UserRepository;
use App\Service\TeamService;

class UserService {

    private $userRepository;

    public function __construct(UserRepository $userRepository, TeamService $teamService) {
        $this->userRepository = $userRepository;
        $this->teamService = $teamService;
    }

    public function createUser($data){
        try{
            $dto = new \App\Dto\UserCreateDto($data->getName(), $data->getEmail());
            return $this->userRepository->save($dto);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

    public function getAllCoursesMatriculated($userId) {
        try{
            if (empty($userId)) {
                throw new \InvalidArgumentException('User ID is required');
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

    public function deleteUser($name) {
        try {
            if (empty($name)) {
                throw new \InvalidArgumentException('Name is required');
            }
            return $this->userRepository->deleteUser($name);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function enroll($enrollDto): void {
        try {
            if (empty($enrollDto->getUserId()) || empty($enrollDto->getCourseId()) || empty($enrollDto->getTeamId())) {
                throw new \InvalidArgumentException('User ID, Course ID, and Team ID are required');
            }
            $this->teamService->enrollUserInTeam($enrollDto);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }
}