<?php 

namespace App\Service;

use App\Repository\UserRepository;

class UserService {

    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
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
}