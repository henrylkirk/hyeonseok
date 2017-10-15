<?php

class Product {

	private $ID, $Name, $Price, $Description, $Quantity, $SalePrice, $ImageName;

	// function __construct($id, $name, $price, $description, $quantity, $sale_price, $image_name){
	// 	$this->id = $id;
	// 	$this->name = $name;
	// 	$this->price = $price;
	// 	$this->description = $description;
	// 	$this->quantity = $quantity;
	// 	$this->sale_price = $sale_price;
	// 	$this->image_name = $image_name;
	// }
	
	// Accessors
	public function getId(){
		return $this->ID;
	}
	public function getName(){
		return $this->Name;
	}
	public function getPrice(){
		return $this->Price;
	}
	public function getDescription(){
		return $this->Description;
	}
	public function getQuantity(){
		return $this->Quantity;
	}
	public function getSalePrice(){
		return $this->SalePrice;
	}
	public function getImageName(){
		return $this->ImageName;
	}

	// Mutators

	
}

?>