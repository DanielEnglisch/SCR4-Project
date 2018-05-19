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

    public function GET_AddProduct(){

        if(!$this->authManager->isLoggedIn())
            $this->redirect('Login', 'User');

        $this->renderView('addProduct', [
            'categories' => $this->dataLayer->getCategories(),
        ]);
    }

    public function POST_AddProduct(){

        if(!$this->authManager->isLoggedIn())
        $this->redirect('Login', 'User');

        $name = $this->getParam('name');
        $manufacturer = $this->getParam('manufacturer');
        $category = $this->getParam('category');
        $this->notEmpty($name);
        $this->notEmpty($manufacturer);
        $this->notEmpty($category);
        if($this->hasErrors()){
            $this->renderView('addProduct', [
                'categories' => $this->dataLayer->getCategories(),
                'name' => $name,
                'manufacturer' => $manufacturer,
                'category' => $category,
                'errors' => $this->getErrors(),
            ]);
        }else{
            $pid = $this->dataLayer->addProduct($this->authManager->getLoggedInUser()->getId(), $name, $manufacturer, $category);
            $this->redirect('Detail', 'Products', ['pid' => $pid]);
        }
    }



}