<?php

require_once dirname(__DIR__).'/config/routes.php';
require_once dirname(__DIR__).'/vendor/autoload.php';

$_SERVER['routes'] = $routes;

$kernel = new App\Core\Kernel($routes);
$kernel->start();

?>

