<?php

namespace Models;

class Product extends Entity{

    private $author;
    private $name;
    private $manufacturer;
    private $num_ratings;
    private $average_rating;
    private $category;
   
    public function __construct($id, $author, $name, $manufacturer, $num_ratings, $average_rating, $category){
        parent::__construct($id);
        $this->author = $author;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->num_ratings = $num_ratings;
        $this->average_rating = $average_rating;
        $this->category = $category;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getName(){
        return $this->name;
    }

    public function getManufacturer(){
        return $this->manufacturer;
    }

    public function getNumberOfRatings(){
        return $this->num_ratings;
    }

    public function getAverageRating(){
        return number_format($this->average_rating, 1, '.', '');
    }

    public function getCategory(){
        return $this->category;
    }
}