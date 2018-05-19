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

}