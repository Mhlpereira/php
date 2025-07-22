<?php
use App\Repository\UserRepository;
use App\Service\UserService;

return function ($container) {
    $container->set(UserRepository::class, function () {
        return new UserRepository();
    });

    $container->set(UserService::class, function ($container) {
        return new UserService($container->get(UserRepository::class));
    });
};