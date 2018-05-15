<?php

namespace Controllers;

class User extends \Framework\Controller{
    
    private $authManager;

    public function __construct(\BusinessLogic\AuthManager $authManager){
        $this->authManager = $authManager;
    }

    public function GET_login(){
        if($this->authManager->isLoggedIn())
            return $this->redirect('Index', 'Products');
        else
            return $this->renderView('login');
    }

    public function POST_login(){
        if($this->authManager->auth($this->getParam('un'), $this->getParam('pwd'))){
            $this->redirect('Index', 'Products');
        }else{
            $this->renderView('login',
            [
                'username' => $this->getParam('un'),
                'errors' => ['Invalid user name or password'],
            ]
        );
        }
    }

    public function POST_logout(){
        $this->authManager->logout();
        return $this->redirect('Index', 'Products');
    }

}