<?php

namespace Models;

class Raiting extends Entity{

    public $product_id;
    public $author;
    public $date;
    public $value;
    public $comment;
   
    public function __construct($id, $product_id, $author, $date, $value, $comment){
        parent::__construct($id);
        $this->product_id = $product_id;
        $this->author = $author;
        $this->date = $date;
        $this->value = $value;
        $this->comment = $comment;
    }

}