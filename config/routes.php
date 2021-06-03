<?php

$routes = [
    [
        'controller' => App\Controller\HomeController::class,
        'action' => 'index',
        'route' => '/index/',
        'name' => 'app_index' // En dissociant la route de son URL initiale, cela permet de conserver les liens entre les versions
    ],
    [
        'controller' => App\Controller\SecurityController::class,
        'action' => 'login',
        'route' => '/login/',
        'name' => 'app_login'
    ]
];