<?php

namespace App\Controller;

use App\Repository\UserRepository;

class HomeController extends AbstractController{

    protected static $templateDir = "home";

    public function index(){
        
        $userRepository = new UserRepository();

        if($this->isSended() && $this->isValid()){
            echo "La requête est valide";
        }
        
        return $this->render('index', [
            'users' => $userRepository->findAll()
        ]);

    }

}