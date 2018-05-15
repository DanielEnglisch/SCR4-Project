<?php
namespace BusinessLogic;

use \Models\Product;
use \Models\Category;
use \Models\User;
use \Models\Rating;


class MockDataLayer implements DataLayer {

  	private $categories;
	private $products;
	private $users;
	private $ratings;

	public function __construct() {

	    $this->categories = array(
	        1 => new Category("Office"),
            2 => new Category("Car"),
            3 => new Category("Tools"),
        );

	    $this->users = array(
	        1 => new User("Daniel"),
            2 => new User("Andi"),
            3 => new User("Maike"),
        );

		$this->products = array(
			1 => new Product(1, "Daniel", "Reifen", "Mojo", "4", "2.3", "Car"),
			2 => new Product(2, "Daniel", "Buntstifte", "Fabacastel", "1", "3", "Office"),
			3 => new Product(3, "Andi", "Gebrauchte Taschentücher", "Tempo", "3", "5", "Office"),
			4 => new Product(4, "Maike", "Büroklammern", "Pagro", "4", "1.4", "Tools"),
		);

        $this->ratings = array(
            1 => new Rating(1,1,"Andi","14.12.1996",2,"Good product!"),
            2 => new Rating(2,1,"Maike","14.12.1996",3,"Ok product!"),
            3 => new Rating(3,3,"Daniel","14.12.1996",1,"Flawless product!"),
            4 => new Rating(4,4,"Daniel","14.12.1996",5,"Bad product!"),
        );

	}

	public function getProducts(){
		return $this->products;
	}

	public function getCategories(){
		return $this->categories;
	}
    public function getRatingsForProduct($product_id){
		$res = array();

		foreach ($this->ratings as $id => $rating){
            if($rating->getId() == $product_id)
                $res[] = $rating;
        }

		return $res;
	}


    public function getUser($username)
    {

        foreach ($this->users as $id => $user){
            if($user->getUsername() == $username)
                return $user;
        }

        return null;
    }

    public function getUserForUsernameAndPassword($username, $password)
    {
        foreach ($this->users as $id => $user){
            if($user->getUsername() == $username)
                if($username == $password)
                    return $user;
        }

        return null;
    }
}