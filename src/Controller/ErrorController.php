<?php

namespace App\Controller;

class ErrorController extends AbstractController{

    protected static $templateDir = 'errors';

    public function error(int $http_code){
        return $this->render(strval($http_code));
    }

}