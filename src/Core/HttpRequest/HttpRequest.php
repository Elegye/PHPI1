<?php

namespace App\Core\HttpRequest;

use App\Core\HttpResponse\HttpResponse;
use App\Core\ParameterBag\ParameterBag;
use App\Core\Exception\NotFoundHttpException;

class HttpRequest
{
    /**
     * All routes we can match
     */
    private $routes;

    /**
     * Route we want to match
     */
    private $route;
    
    /**
     * GET Params
     */
    public $query;

    /**
     * POST Params
     */
    public $request;

    /**
     * SESSIONS Params
     */
    public $session;

    public function __construct(array $query = [], array $request = [], array $session = [], array $server = [], array $routes = [])
    {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
        $this->session = new ParameterBag($session);
        $this->server = new ParameterBag($server);
        
        $this->route = trim($this->server->get('REQUEST_URI'), '/'); // Trivial, mais fonctionnel !
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

    public function redirectTo(string $target){
        foreach($this->routes as $route){
            if($route['name'] == $target){
                return $this->getControllerMethod($route['controller'], $route['action']);
            }
        }
    }

    /**
     * A ajouter : gestion de la sécurité
     */
    private function getControllerMethod(string $controller, string $method, array $params = null, bool $is_secure = False): HttpResponse
    {
        return (new $controller)->$method();
    }
}