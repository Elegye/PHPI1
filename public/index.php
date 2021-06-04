<?php

session_start();

require_once dirname(__DIR__).'/config/routes.php';
require_once dirname(__DIR__).'/config/config.php';
require_once dirname(__DIR__).'/vendor/autoload.php';

$_SERVER['routes'] = $routes;
$_SERVER['config'] = $params;

$kernel = new App\Core\Kernel($routes, $params);
$kernel->start();

?>

