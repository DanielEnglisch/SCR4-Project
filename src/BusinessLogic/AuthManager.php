<?php

namespace BusinessLogic;

final class AuthManager{

    private $dataLayer;
    private $session;

    public function __construct(DataLayer $dataLayer, \Framework\Session $session){
        $this->dataLayer = $dataLayer;
        $this->session = $session;
    }

    const SESSION_USER = 'user';

    public function auth($username, $password){
        $user = $this->dataLayer->getUserForUsernameAndPassword($username, $password);
        if($user != null){
            $this->session->setValue(self::SESSION_USER, $user->getUsername());
            return true;
        }else{
            self::logout();
            return false;
        }
    }

    public function logout(){
        $this->session->deleteValue(self::SESSION_USER);
    }

    public function isLoggedIn(){
        return $this->session->hasValue(self::SESSION_USER);
    }

    public function getLoggedInUser(){
        return $this->dataLayer->getUser($this->session->getValue(self::SESSION_USER), null);
    }

} 