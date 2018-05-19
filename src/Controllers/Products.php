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


    public function GET_editProduct(){

        if(!$this->authManager->isLoggedIn())
            $this->redirect('Login', 'User');

        $pid = $this->getParam('pid');
        $username = $this->authManager->getLoggedInUser()->getId();
        $product = $this->dataLayer->getProductWithId($pid);

        /* If the product isn't his */
        if($username !== $product->getAuthor())
            $this->redirect('Index', 'Products');

        $this->renderView('editProduct', [
            'categories' => $this->dataLayer->getCategories(),
            'name' => $product->getName(),
            'manufacturer' => $product->getManufacturer(),
            'category' => $product->getCategory(),
            'pid' => $pid
        ]);
    }

    public function POST_editProduct(){
        if(!$this->authManager->isLoggedIn())
            $this->redirect('Login', 'User');

        $pid = $this->getParam('pid');
        $username = $this->authManager->getLoggedInUser()->getId();
        $product = $this->dataLayer->getProductWithId($pid);

        /* If the product isn't his */
        if($username !== $product->getAuthor())
            $this->redirect('Index', 'Products');

        $name = $this->getParam('name');
        $manufacturer = $this->getParam('manufacturer');
        $category = $this->getParam('category');
        $this->notEmpty($name);
        $this->notEmpty($manufacturer);
        $this->notEmpty($category);
        if($this->hasErrors()){
            $this->renderView('editProduct', [
                'categories' => $this->dataLayer->getCategories(),
                'name' => $name,
                'manufacturer' => $manufacturer,
                'category' => $category,
                'errors' => $this->getErrors(),
                'pid' => $pid
            ]);
        }else{
            $this->dataLayer->editProduct($pid, $name, $manufacturer, $category);
            $this->redirect('Detail', 'Products', ['pid' => $pid]);
        }

    }


}