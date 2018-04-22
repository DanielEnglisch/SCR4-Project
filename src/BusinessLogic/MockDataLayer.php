<?php
namespace BusinessLogic;

use \Models\Product;
use \Models\Category;
use \Models\User;
use \Models\Raiting;


class MockDataLayer implements DataLayer {
  	private $categories;
	private $products;
	private $users;
	private $raitings;

	public function __construct() {

		$this->products = array(
			1 => new Product(1, "DanielEnglisch", "Reifen", "Mojo", "4", "2.3", "car"),
			2 => new Product(2, "Alex", "Buntstifte", "Fabacastel", "1", "3", "office"),
			3 => new Product(3, "MasterX", "Gebrauchte Taschentücher", "Tempo", "3", "5", "office"),
			4 => new Product(4, "Xer0", "Büroklammern", "Pagro", "4", "1.4", "office"),
		);

		

	}

	public function getProducts(){
		return $this->products;
	}

	
}