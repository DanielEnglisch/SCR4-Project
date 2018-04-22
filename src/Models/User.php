<?php

namespace Models;

class User extends Entity{

    public $password;
   
    public function __construct($id, $password){
        parent::__construct($id);
        $this->password = $password;
    }

}