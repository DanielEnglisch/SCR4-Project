<?php

namespace Models;

class Category extends Entity{

    private $name;

    public function __construct($id){
        parent::__construct($id);
        $this->name = $id;
    }

    public function getName(){
        return $this->name;
    }

}