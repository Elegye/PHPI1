<?php

namespace App\Core\DependencyInjection;

use App\Core\HttpResponse\HttpResponse;
use App\Core\HttpRequest\HttpRequest;
use App\Core\Template\Template;
use App\Core\ParameterBag\ParameterBag;

class Container{

    public function get(string $service){
        switch($service){
            case 'request':
                return $this->getRequest();
                break;
            case 'response':
                return $this->getResponse();
                break;
            case 'template':
                return $this->getTemplate();
                break;
            case 'param':
                return $this->getParameterBag();
                break;
        }

        throw new \Exception('Service inconnu');
    }
    
    public function getResponse(){
        return new HttpResponse();
    }

    public function getRequest(){
        return new HttpRequest($_GET, $_POST, $_SERVER['routes']);
    }

    public function getTemplate(){
        return Template::class;
    }

    public function getParameterBag(){
        return new ParameterBag($_SERVER['config']);
    }

}