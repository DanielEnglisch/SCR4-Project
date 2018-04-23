<?php

namespace Controllers;

class Products extends \Framework\Controller{

    private $dataLayer;

    public function __construct(\BusinessLogic\DataLayer $dataLayer){
        $this->dataLayer = $dataLayer;
    }

    public function GET_Index(){
       $this->renderView('home', ['products' => $this->dataLayer->getProducts()]);
    }

}