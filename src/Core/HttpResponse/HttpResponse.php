<?php
namespace App\Core\HttpResponse;

//use App\Controller\ErrorController;
use App\Core\Controller\ErrorController;

class HttpResponse{

    public function toHttpError(int $http_code)
    {
        
        return (new ErrorController())->error($http_code);
    }

}