<?php

namespace BusinessLogic;

interface DataLayer{
    public function getProducts();
    public function getProductWithId($product_id);
    public function getCategories();
    public function getRatingsForProduct($product_id);
    public function getUser($username);
    public function getUserForUsernameAndPassword($username, $password);
    public function registerUser($username, $password);
}