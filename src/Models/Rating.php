<?php

namespace Models;

class Rating extends Entity{

    private $product_id;
    private $author;
    private $date;
    private $value;
    private $comment;
   
    public function __construct($id, $product_id, $author, $date, $value, $comment){
        parent::__construct($id);
        $this->product_id = $product_id;
        $this->author = $author;
        $this->date = $date;
        $this->value = $value;
        $this->comment = $comment;
    }

    public function getProductId(){
        return $this->product_id;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getDate(){
        return $this->date;
    }

    public function getValue(){
        return $this->value;
    }

    public function getComment(){
        return $this->comment;
    }

}