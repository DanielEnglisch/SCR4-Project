<?php

namespace BusinessLogic;

interface DataLayer{
    
    public function getCategories();

    /* Rating specific */
    public function getRatingsForProduct($product_id);
    public function getRatingWithId($rid);
    public function addRating($pid, $username, $value, $comment);
    public function editRating($rid, $value, $comment);
    public function deleteRating($rid);

    /* User specific */
    public function getUser($username);
    public function getUserForUsernameAndPassword($username, $password);
    public function registerUser($username, $password);
    
    /* Product specific */
    public function getProducts();
    public function getProductWithId($product_id);
    public function getProductsFromQuery($query);
    public function addProduct($username, $name, $manufacturer, $category);
    public function editProduct($pid, $name, $manufacturer, $category);
    public function deleteProduct($pid);

}