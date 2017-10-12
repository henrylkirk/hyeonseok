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
			$stmt = $this->dbh->prepare("SELECT * FROM people WHERE PersonID = :id");
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
			include_once("Product.class.php");
			$data = array();
			$stmt = $this->dbh->prepare("SELECT * FROM people");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Person");
			while($person = $stmt->fetch()){
				$data[] = $person;
			}
			return $data;
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
	function insert($name, $price, $description, $quantity, $sale_price, $image_name){
		try {
			$stmt = $this->dbh->prepare("INSERT INTO products (name, price, description, quantity, sale_price, image_name) VALUES (:name, :price, :description, :quantity, :sale_price, :image_name)");
			$stmt->execute(array(":name"=>$name, ":price"=>$price, ":description"=>$description, ":quantity"=>$quantity, ":sale_price"=>$sale_price, ":image_name"=>$image_name));
			return $this->dbh->lastInsertId();
		} catch(PDOException $pdoe){
			echo $pdoe->getMessage();
			die();
		}
	}
	
}

?>