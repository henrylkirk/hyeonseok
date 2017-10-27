<?php

// include_once("Product.class.php");
// include_once("Cart.class.php");

/**
 * Used to access and set data in database.
 */
class DB {

	private $pdo;
	const PRODUCTS_PER_PAGE = 5;
	
	/**
	 * Constructor
	 */
	function __construct(){
		try {
			$this->pdo = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // shows errors
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
	/**
	 * Get a Product by its id
	 * @param int
	 * @return array
	 */ 
	public function get_product(int $id){
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
			$product = $stmt->fetch();
			return $product;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	/**
	 * Holds logic for getting products from database
	 * @param string
	 * @return array
	 */
	private function get_products(string $sql_string){
		try {
			$data = array();
			$stmt = $this->pdo->prepare($sql_string);
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

	/**
	 * Returns the number of products in the catalog section.
	 */
	public function get_catalog_products_count(){
		$sqlString = "SELECT COUNT(*) FROM products WHERE SalePrice = 0";
		$result = $this->pdo->prepare($sqlString);
		$result->execute(); 
		$number_of_products = $result->fetchColumn();
		return $number_of_products; 
	}

	// Returns an array of all Products in database
	public function get_all_products(){
		return $this->get_products("SELECT * FROM products ORDER BY Name");
	}

	// Returns an array of Products not on sale
	public function get_catalog_products($page_num = 1){
		$offset = ($page_num - 1) * self::PRODUCTS_PER_PAGE;
		return $this->get_products("SELECT * FROM products WHERE SalePrice = 0 ORDER BY Name LIMIT ". self::PRODUCTS_PER_PAGE ." OFFSET {$offset}");
	}

	// Returns an array of all Products in database on sale
	public function get_sale_products(){
		return $this->get_products("SELECT * FROM products WHERE SalePrice > 0 ORDER BY Name");
	}	
	
	// Used to insert a new product into the database
	public function insert_product($name, $price, $description, $quantity, $sale_price, $image_name){
		try {
			$stmt = $this->pdo->prepare("INSERT INTO products (Name, Price, Description, Quantity, SalePrice, ImageName) VALUES (:name, :price, :description, :quantity, :sale_price, :image_name)");
			$stmt->execute(array(":name"=>$name, ":price"=>$price, ":description"=>$description, ":quantity"=>$quantity, ":sale_price"=>$sale_price, ":image_name"=>$image_name));
			return $this->pdo->lastInsertId();
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}

	/**
	 * Insert data into db.
	 * @param string, array
	 * @return int
	 */
	public function insert(string $sql_string, $params){
		try {
			$stmt = $this->pdo->prepare($sql_string);
			for($i = 0; $i < count($params); $i++){
				$stmt->bindParam($i+1, $params[$i]);
			}
			$stmt->execute();
			return $this->pdo->lastInsertId();
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}


	/////////////
	// Cart
	/////////////

	public function get_cart_contents(){
		try {
			$cart_contents = array();
			$stmt = $this->pdo->prepare("SELECT ID, Quantity FROM cart ORDER BY ID");
			$result = $stmt->execute();
			$cart_contents = $stmt->fetchAll();
			return $cart_contents;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
		

	}
	
}

?>