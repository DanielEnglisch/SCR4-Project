<?php

namespace Controllers;

class Products extends \Framework\Controller{

    private $dataLayer;
    private $authManager;

    public function __construct(\BusinessLogic\DataLayer $dataLayer, \BusinessLogic\AuthManager $authManager){
        $this->dataLayer = $dataLayer;
        $this->authManager = $authManager;
    }

    public function GET_Index(){
        
       $this->renderView('home', [
           'products' => $this->dataLayer->getProducts(),
       ]);
    }

    public function GET_Detail(){

        $this->renderView('detail', [
            'ratings' => $this->dataLayer->getRatingsForProduct($this->getParam('pid')),
            'product' => $this->dataLayer->getProductWithId($this->getParam('pid'))
        ]);
    }

    public function GET_Search(){
        
        $this->renderView('search',[
            'products' => $this->dataLayer->getProductsFromQuery($this->getParam("title")),
            'title' => $this->getParam('title'),
        ]);
    }



}