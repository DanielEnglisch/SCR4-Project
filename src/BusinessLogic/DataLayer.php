<?php

namespace BusinessLogic;

interface DataLayer{
    public function getProducts();
    public function getCategories();
    public function getRatingsForProduct($product_id);
    public function getUser($username);
    public function getUserForUsernameAndPassword($username, $password);
}