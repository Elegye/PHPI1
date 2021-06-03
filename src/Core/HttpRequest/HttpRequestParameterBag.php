<?php

namespace App\Core\HttpRequest;

class HttpRequestParameterBag{

    private $query;

    private $post;

    public function __construct($query, $post){
        $this->query = $query;
        $this->post = $post;
    }

    public function getQuery(string $param){
        return $this->query[$param];
    }

    public function getPost(string $param){
        return $this->post[$param];
    }

}