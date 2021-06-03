<?php

$routes = [
    [
        'controller' => App\Controller\HomeController::class,
        'action' => 'index',
        'route' => '/index/'
    ],
    [
        'controller' => App\Controller\SecurityController::class,
        'action' => 'login',
        'route' => '/login/'
    ]
];