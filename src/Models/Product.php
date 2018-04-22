<?php

namespace Models;

class Product extends Entity{

    public $author;
    public $name;
    public $manufacturer;
    public $num_raitings;
    public $average_raiting;
    public $category;
   
    public function __construct($id, $author, $name, $manufacturer, $num_raitings, $average_raiting, $category){
        parent::__construct($id);
        $this->author = $author;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->num_raitings = $num_raitings;
        $this->average_raiting = $average_raiting;
        $this->category = $category;
    }

}