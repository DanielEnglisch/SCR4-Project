<?php

namespace Models;

class Entity{
    private $id;

    public function __construct($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }


}