<?php

namespace BusinessLogic;

interface DataLayer{
    public function getBooksForCategory($categoryId);
    public function getCategories();
    public function getBooksForSearchCriteria($title);
    //TODO: login
}