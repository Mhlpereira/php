<?php

use App\Controller\CourseController;
use App\Controller\UserController;

return function($app){
// Cursos
$app->post('/courses', [CourseController::class, 'createCourse']);
$app->put('/courses/{id}', [CourseController::class, 'updateCourse']);
$app->delete('/courses/{id}', [CourseController::class, 'deleteCourse']);
$app->get('/courses/teams/available', [CourseController::class, 'getCourseWithAvailableTeams']);
$app->post('/courses/teams', [CourseController::class, 'createTeam']);
$app->put('/courses/teams/{id}', [CourseController::class, 'updateTeam']);
$app->delete('/courses/teams/{grupoId}/{teamId}', [CourseController::class, 'deleteTeam']);


// Usuários
$app->post('/user', [UserController::class, 'createUser']);
$app->delete('/user/{id}', [UserController::class, 'deleteUser']);
$app->get('/user/{id}/enroll', [UserController::class, 'getAllCoursesEnrolled']);
$app->post('/user/{id}/enroll', [UserController::class, 'enroll']);
};