<?php

namespace App\Core\HttpRequest;

use App\Core\HttpRequest\HttpRequestParameterBag;
use App\Core\Exception\NotFoundHttpException;

class HttpRequest{

    private $routes;
    private $route;
    public $params;

    public function __construct(array $query, array $post, array $routes = [])
    {
        $this->params = new HttpRequestParameterBag($query, $post);
        $this->route = $this->params->getQuery('route');
        $this->routes = $routes;
    }

    public function getRoute(){
        return $this->route;
    }

    public function toController()
    {
        foreach($this->routes as $route){
            if(preg_match($route['route'], $this->route)){
                return $this->getControllerMethod($route['controller'], $route['action']);
            }
        }
        
        throw new NotFoundHttpException();
    }

    /**
     * A ajouter : gestion de la sécurité
     */
    private function getControllerMethod(string $controller, string $method, bool $is_secure = False)
    {
        $controller = (new $controller);
        $controller->beforeFilter();
        $controller->$method();
        $controller->afterFilter();
    }
}