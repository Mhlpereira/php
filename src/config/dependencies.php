<?php
use App\Repository\UserRepository;
use App\Service\UserService;
use App\Repository\CourseRepository;
use App\Service\CourseService;
use App\Repository\TeamRepository;
use App\Service\TeamService;

return function ($container) {
    $container->set(UserRepository::class, function () {
        return new UserRepository();
    });

    $container->set(CourseRepository::class, function () {
        return new CourseRepository();
    });

    $container->set(TeamRepository::class, function () {
        return new TeamRepository();
    });

    $container->set(UserService::class, function ($container) {
        return new UserService($container->get(UserRepository::class));
    });

    $container->set(CourseService::class, function ($container) {
        return new CourseService($container->get(CourseRepository::class));
    });

    $container->set(TeamService::class, function ($container) {
        return new TeamService($container->get(TeamRepository::class), $container->get(CourseService::class));
    });

};