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

    public function GET_register(){
        if($this->authManager->isLoggedIn())
            return $this->redirect('Index', 'Products');
        else
            return $this->renderView('register');
    }

    public function POST_register(){
        
        if($this->getParam('pwd1') !== "" && $this->getParam('pwd1') !== null &&
        $this->getParam('un') !== "" && $this->getParam('pwd1') !== null &&
            $this->getParam('pwd1') === $this->getParam('pwd2') &&
            $this->authManager->register($this->getParam('un'), $this->getParam('pwd1'))){

            /* Login after registration  */
            if($this->authManager->auth($this->getParam('un'), $this->getParam('pwd1')))
                $this->redirect('Index', 'Products');
            else
             die("ERROR LOGGING IN");
        }else{
            $this->renderView('register',
            [
                'username' => $this->getParam('un'),
                'errors' => ['User already exists. Or invalid input.'],
            ]
        );
        }
    }

    public function POST_logout(){
        $this->authManager->logout();
        return $this->redirect('Index', 'Products');
    }

}