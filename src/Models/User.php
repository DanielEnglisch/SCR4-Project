<?php

namespace Models;

class User extends Entity{

    private $username;
   
    public function __construct($id){
        parent::__construct($id);
        $this->username = $id;
    }

    public function getUsername(){
        return $this->username;
    }

}