<?php
include_once("Product.class.php");

class DB {

	private $db;
	
	function __construct(){
		try {
			$this->db = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);
			$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // shows errors
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
	// Get a Product by its id
	function getProduct($id){
		try {
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll();
			return $data;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	// Returns an array of all Products in database
	function getAllProducts(){
		try {
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM products ORDER BY ID");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
			while($product = $stmt->fetch()){
				$data[] = $product;
			}
			return $data;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	// Returns an array of all Products in database on sale
	function getAllProductsOnSale(){
		try {
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM products WHERE SalePrice > 0 ORDER BY ID");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
			while($product = $stmt->fetch()){
				$data[] = $product;
			}
			return $data;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	// Gets all products from database and returns HTML
	// Takes in array of products
	function getProductsAsItems($products){
		// $products = $this->getAllProducts();
		// make html item for each product
		$items = "";
		foreach($products as $product){
$items .= <<<HTML
	<div class="col-md-4 col-sm-6 portfolio-item">
        <a class="portfolio-link" data-toggle="modal" href="#modal-{$product->getId()}">
          <div class="portfolio-hover">
            <div class="portfolio-hover-content">
              <i class="fa fa-eye fa-3x"></i>
            </div>
          </div>
          <img class="img-fluid" src="img/products-thumb/{$product->getImageName()}.jpg" alt="">
        </a>
        <div class="portfolio-caption">
          <h4>{$product->getName()}</h4>
          <p class="text-muted">&#36;{$product->getPrice()}</p>
          <a href=""><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i></a>
        </div>
	</div>
HTML;
		}
		return $items;
	}	
	
	// Used to insert a new product into the database
	function insert($name, $price, $description, $quantity, $sale_price, $image_name){
		try {
			$stmt = $this->db->prepare("INSERT INTO products (Name, Price, Description, Quantity, SalePrice, ImageName) VALUES (:name, :price, :description, :quantity, :sale_price, :image_name)");
			$stmt->execute(array(":name"=>$name, ":price"=>$price, ":description"=>$description, ":quantity"=>$quantity, ":sale_price"=>$sale_price, ":image_name"=>$image_name));
			return $this->db->lastInsertId();
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
}

?>