<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';


$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$dotenv = parse_ini_file(__DIR__ . '/.env');
foreach ($dotenv as $key => $value) {
    putenv("$key=$value");
}

// Carrega dependências e rotas
(require __DIR__ . '/../src/config/dependencies.php')($container);
(require __DIR__ . '/../src/routes/routes.php')($app);


$app->run();