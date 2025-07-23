<?php
require __DIR__ . '/../vendor/autoload.php';

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/../src/controller/CourseController.php',
    __DIR__ . '/../src/controller/UserController.php'
]);

header('Content-Type: application/x-yaml');
echo $openapi->toJson();