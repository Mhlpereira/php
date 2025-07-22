<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\UserService;

class UserController
{   
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function createUser(Request $request, Response $response): Response
    {
        $response->getBody()->write("Olá, mundo!");
        return $response;
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