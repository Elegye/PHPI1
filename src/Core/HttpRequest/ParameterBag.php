<?php
namespace App\Core\ParameterBag;

use App\Core\ParameterBag;

class HttpRequestParameterBag extends ParameterBag{

    private $params;

    public function __construct(){
        $this->params = isset($_SERVER['config']) ? $_SERVER['config'] : [];
    }

    public function get(string $param)
    {
        if(isset($this->params[$param])){
            return $this->params[$param];
        }
        else{
            throw new \Exception('Ce paramètre n\'existe pas.');
        }
    }

}