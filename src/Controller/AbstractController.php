<?php

namespace App\Controller;

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
    }

    public function render(string $template, array $params){
        $controller = get_called_class();
        $this->templateDir = $controller::$templateDir;

        if(!empty($this->templateDir)){
            try{
                foreach($params as $key => $value){
                    ${$key} = $value;
                }
                require_once(dirname(__DIR__)."/../templates/".$this->templateDir."/".$template.".php");
            }
            catch(\Exception $e){
                throw new \Exception("Template inexistant");
            }
        }
        else{
            throw new \Exception("Dossier de template non renseigné.");
        }
    }

    public function redirectTo(string $route){
        
    }

    /**
     * On laisse vide. Si besoin, on utilisera la surcharge de méthodes
     */
    public function beforeFilter(){

    }

    /**
     * On laisse vide. Si besoin, on utilisera la surcharge de méthodes
     */
    public function afterFilter(){

    }

}