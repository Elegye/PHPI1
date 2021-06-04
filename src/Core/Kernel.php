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
        $this->request = new HttpRequest($_GET, $_POST, $_SESSION, $_SERVER, $routes);
        $this->response = new HttpResponse();
    }

    public function start()
    {
        try {
            $this->response = $this->request->toController();
        } catch (NotFoundHttpException $e) {
            $this->response->toHttpError(404);
        }

        return $this->response->send();
    }
}
