<?php

namespace App\Core\Controller;

use App\Core\DependencyInjection\Container;

abstract class AbstractController{

    private $templateDir;

    private $container;

    protected $request;

    protected $response;

    protected $template;

    public function __construct(){
        $this->container = new Container();
        $this->request = $this->container->get('request');
        $this->response = $this->container->get('response');
        $this->template = $this->container->get('template');

        $this->beforeFilter();
    }

    public function render(string $template, array $params = []){
        $controller = get_called_class();
        $this->templateDir = $controller::$templateDir;

        if(!empty($this->templateDir)){
            try{
                // On va implémenter le nouveau TOKEN pour le CSRF
                $_SESSION['token'] = bin2hex(random_bytes(32));
                foreach($params as $key => $value){
                    ${$key} = $value;
                }
                return $this->response->setContent(file_get_contents(dirname(__DIR__)."/../../templates/".$this->templateDir."/".$template.".php"))->send();
            }
            catch(\Exception $e){
                throw new \Exception("Template inexistant");
            }
        }
        else{
            throw new \Exception("Dossier de template non renseigné.");
        }

        return $this->response->setStatusCode(500)->send();
    }

    public function redirectTo(string $route){
        return $this->request->redirectTo($route);
    }

    public function isSended(){
        return count($this->request->request) > 0;
    }

    public function isValid(){
        if($this->request->session->has('token')){
            if(hash_equals($this->request->session->get('token'), $this->request->request->get('token'))){
                return true;
            }
        }
        return false;
    }

    /**
     * On laisse vide. Si besoin, on utilisera la surcharge de méthodes
     */
    public function beforeFilter(){
        echo "Avant requête";
    }

    /**
     * On laisse vide. Si besoin, on utilisera la surcharge de méthodes
     */
    public function afterFilter(){
        echo "Après requête";
    }

}