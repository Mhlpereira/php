<?php
namespace App\Service;

use App\Entities\Team;
use App\Entities\User;

class TeamsService
{

    public function addStudent(User $student): void
    {
        if (count($this->students) < $this->maxStudents) {
            $this->students[] = $student;
        } else {
            throw new \Exception("Maximum number of students reached.");
        }
    }


}