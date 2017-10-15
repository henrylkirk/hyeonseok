<?php

class DB {

	private $dbh;
	
	function __construct(){
		try {
			$this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // shows errors
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
	function getProduct($id){
		try {
			$data = array();
			$stmt = $this->dbh->prepare("SELECT ID, Name, Price, Description, Quantity, SalePrice, ImageName FROM products WHERE id = :id");
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll();
			return $data;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	function getAllProducts(){
		try {
			// include_once("Product.class.php");
			$data = array();
			$stmt = $this->dbh->prepare("SELECT ID, Name, Price, Description, Quantity, SalePrice, ImageName FROM products");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
			while($person = $stmt->fetch()){
				$data[] = $person;
			}
			return $data;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	// Gets all products from database and returns HTML
	function getAllProductsAsItems(){
		$products = $this->getAllProducts();
		// make html item for each product
		$items = "";
		foreach($products as $product){
$items .= <<<HTML 
	<div class="col-md-4 col-sm-6 portfolio-item">
        <a class="portfolio-link" data-toggle="modal" href="#modal-{$product->getId()}">
          <div class="portfolio-hover">
            <div class="portfolio-hover-content">
              <i class="fa fa-plus fa-3x"></i>
            </div>
          </div>
          <img class="img-fluid" src="img/products-thumb/{$product->getImageName()}.jpg" alt="">
        </a>
        <div class="portfolio-caption">
          <h4>{$product->getName()}</h4>
          <p class="text-muted">{$product->getPrice()}</p>
          <a href=""><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
        </div>
	</div>
HTML;
		}
		return $items;
	}	
	
	function insert($name, $price, $description, $quantity, $sale_price, $image_name){
		try {
			$stmt = $this->dbh->prepare("INSERT INTO products (Name, Price, Description, Quantity, SalePrice, ImageName) VALUES (:name, :price, :description, :quantity, :sale_price, :image_name)");
			$stmt->execute(array(":name"=>$name, ":price"=>$price, ":description"=>$description, ":quantity"=>$quantity, ":sale_price"=>$sale_price, ":image_name"=>$image_name));
			return $this->dbh->lastInsertId();
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
}

?>