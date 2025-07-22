<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\CourseService;
use App\Service\TeamService;

class CourseController
{
    public function __construct(private CourseService $courseService, private TeamService $teamService){}

    public function createCourse(Request $request, Response $response): Response
    {   
        $course = $this->courseService->createCourse($request->getParsedBody());
        if (!$course) {
            $response->getBody()->write("Erro ao criar curso.");
            return $response->withStatus(500);
        }
        $response->getBody()->write(json_encode($course));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201); 
    }

    public function updateCourse(Request $request, Response $response, array $args): Response
    {
        $courseId = $args['id'];
        $courseData = $request->getParsedBody();
        
        $updatedCourse = $this->courseService->updateCourse($courseId, $courseData);
        if (!$updatedCourse) {
            $response->getBody()->write("Erro ao atualizar curso.");
            return $response->withStatus(500);
        }
        
        $response->getBody()->write(json_encode($updatedCourse));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function deleteCourse(Request $request, Response $response, array $args): Response
    {
        $courseId = $args['id'];
        
        if (!$this->courseService->deleteCourse($courseId)) {
            $response->getBody()->write("Erro ao deletar curso.");
            return $response->withStatus(500);
        }
        
        $response->getBody()->write("Curso deletado com sucesso!");
        return $response->withStatus(200);
    }

    public function createTeam(Request $request, Response $response): Response
    {   
        $courseId = $args['id'];
        $teamData = $request->getParsedBody();
        $team = $this->teamService->createTeam($teamData);
        
        if (!$team) {
            $response->getBody()->write("Erro ao criar equipe.");
            return $response->withStatus(500);
        }
        
        $response->getBody()->write(json_encode($team));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function updateTeam(Request $request, Response $response, array $args): Response
    {
        $teamId = $args['id'];
        $teamData = $request->getParsedBody();
        
        $updatedTeam = $this->teamService->updateTeam($teamId, $teamData);
        if (!$updatedTeam) {
            $response->getBody()->write("Erro ao atualizar equipe.");
            return $response->withStatus(500);
        }
        
        $response->getBody()->write(json_encode($updatedTeam));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function deleteTeam(Request $request, Response $response, array $args): Response
    {
        $grupoId = $args['grupoId'];
        $teamId = $args['teamId'];
        
        if (!$this->teamService->deleteTeam($teamId)) {
            $response->getBody()->write("Erro ao deletar equipe.");
            return $response->withStatus(500);
        }
        
        $response->getBody()->write("Equipe deletada com sucesso!");
        return $response->withStatus(200);
    }

    public function getCourseWithAvailableTeams(Request $request, Response $response, array $args): Response
    {        
        $filters = $request->getQueryParams(); 

        $courseWithTeams = $this->courseService->getCourseWithAvailableTeams($filters);
        if (!$courseWithTeams) {
            $response->getBody()->write("Curso não encontrado ou sem equipes disponíveis.");
            return $response->withStatus(404);
        }
        
        $response->getBody()->write(json_encode($courseWithTeams));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}