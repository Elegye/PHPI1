<?php
namespace App\Core;

use App\Core\HttpRequest\HttpRequest;
use App\Core\HttpResponse\HttpResponse;
use App\Core\Exception\NotFoundHttpException;

class Kernel{

    public $request;
    public $response;
    public $container;

    public function __construct(array $routes){
        $this->request = new HttpRequest($_GET, $_POST, $routes);
        $this->response = new HttpResponse();
    }

    public function start(){
        
        try {
            $this->request->toController();
        } catch (NotFoundHttpException $e) {
            return $this->response->toHttpError(404);
        }
    }
}
