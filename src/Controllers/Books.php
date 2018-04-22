<?php

namespace Controllers;

class Books extends \Framework\Controller{

    private $dataLayer;

    public function __construct(){
        $this->dataLayer = new \BusinessLogic\MockDataLayer;
    }

    public function GET_Index(){
       $this->renderView('booklist', array(
            'categories' => $this->dataLayer->getCategories(),
            'books' => $this->hasParam('cid')?$this->dataLayer->getBooksForCategory($this->getParam('cid')):null,
            'selectedCategoryId' => $this->getParam('cid')
       ));
       //TODO show all books
    }

    public function GET_Search(){
        $this->renderView('booksearch');
        //TODO search for books
    }

}