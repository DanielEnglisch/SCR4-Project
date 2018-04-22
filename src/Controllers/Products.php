<?php

namespace Controllers;

class Products extends \Framework\Controller{

    private $dataLayer;

    public function __construct(){
        $this->dataLayer = new \BusinessLogic\MockDataLayer;
    }

    public function GET_Index(){
       $this->renderView('home', ['products' => $this->dataLayer->getProducts()]);
    }

}