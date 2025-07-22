namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\CourseService;

class CourseController
{
    private $courseService;

    public function createCourse(Request $request, Response $response): Response
    {
        $response->getBody()->write("Curso criado com sucesso!");
        return $response;
    }

    publica function updateCourse(Request $request, Response $response, array $args): Response
    {
        $courseId = $args['id'];
        $response->getBody()->write("Curso com ID " . htmlspecialchars($courseId) . " atualizado com sucesso!");
        return $response;
    }

    public function deleteCourse(Request $request, Response $response, array $args): Response
    {
        $courseId = $args['id'];
        $response->getBody()->write("Curso com ID " . htmlspecialchars($courseId) . " deletado com sucesso!");
        return $response;
    }
}