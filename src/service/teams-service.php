<?php
namespace App\Service;

use App\Entities\Team;
use App\Entities\User;

use App\Repository\TeamRepository;

class TeamsService
{   
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository) {
        $this->teamRepository = $teamRepository;
    }

    public function addStudent(User $student): void
    {
        if (empty($student->getName())) {
            throw new \InvalidArgumentException('Student name is required');
        }

        if (count($this->students) >= $this->maxStudents) {
            throw new \Exception("Não tem vagas disponíveis para mais alunos.");
        }

        $this->teamRepository->addStudent($student);
    }



}