<?php

namespace App\Controller;

use App\Repository\UserRepository;

class HomeController extends AbstractController{

    protected static $templateDir = "home";

    public function index(){
        $userRepository = new UserRepository();
        $userRepository->findAll();
        return $this->render('index', [
            'say' => $this->request->params->getPost('say'),
            'to' => $this->request->params->getPost('to')
        ]);

    }

}