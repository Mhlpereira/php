<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\UserService;
use App\Dto\UserCreateDto;

class UserController
{   
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function createUser(Request $request, Response $response): Response
    {   
        $data = $request->getParsedBody();
        try {
            $dto = new UserCreateDto($data['name'], $data['email']);
            $result = $this->userService->createUser($dto);
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }

    public function deleteUser(Request $request, Response $response, array $args): Response
    {
        $name = $args['name'];
        $response->getBody()->write("Olá, " . htmlspecialchars($name));
        return $response;
    }

    public function getAllCoursesMatriculated(Request $request, Response $response, array $args): Response
    {   
        $userId = $args['id'];
        $courses = $this->userService->getAllCoursesMatriculated($userId);
        if (empty($courses)) {
            $response->getBody()->write("Nenhum curso matriculado encontrado.");
            return $response->withStatus(404);
        }
        
        $response->getBody()->write(json_encode($courses));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}