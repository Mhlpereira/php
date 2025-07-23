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
    
    /**
     * @OA\Post(
     *     path="/user",
     *     @OA\Response(response="201", description="Criar usuário")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/user/{id}",
     *    @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\Response(response="204", description="Deletar usuário")
     * )
     */
    public function deleteUser(Request $request, Response $response, array $args): Response
    {
        $userId = $args['id'];
        try {
            $result = $this->userService->deleteUser($userId);
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        } catch (\Exception $e) {  
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }

    /**
     * @OA\Get(
     *     path="/user/enroll",
     *     @OA\Response(response="200", description="Buscar cursos matriculados")
     * )
     */
    public function getAllCoursesEnrolled(Request $request, Response $response, array $args): Response
    {   
        $userId = $args['id'];
        $courses = $this->userService->getAllCoursesEnrolled($userId);
        if (empty($courses)) {
            $response->getBody()->write("Nenhum curso matriculado encontrado.");
            return $response->withStatus(404);
        }
        
        $response->getBody()->write(json_encode($courses));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    /**
     * @OA\Post(
     *     path="/user/{id}/enroll",
     *    @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\Response(response="200", description="Matricular usuário em curso")
     * )
     */
    public function enroll(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        try{
            $dto = new EnrollDto(
                $data['user_id'],
                $data['course_id'],
                $data['team_id']
            );
            $this->userService->enroll($dto);
        $response->getBody()->write("Usuário {$userId} matriculado no curso {$courseId}");
        return $response->withStatus(200);
    }catch (\InvalidArgumentException $e) {
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }
    }
}