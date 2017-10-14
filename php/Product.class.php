<?php

class Product {

	private $id, $name, $price, $description, $quantity, $sale_price, $image_name;

	function __construct($name, $price, $description, $quantity, $sale_price, $image_name){
		$this->name = $name;
		$this->price = $price;
		$this->description = $description;
		$this->quantity = $quantity;
		$this->sale_price = $sale_price;
		$this->image_name = $image_name;
	}
	
	// Accessors
	public getId(){
		return $this->id;
	}
	public getName(){
		return $this->name;
	}
	public getPrice(){
		return $this->price;
	}
	public getDescription(){
		return $this->description;
	}
	public getQuantity(){
		return $this->quantity;
	}
	public getSalePrice(){
		return $this->sale_price;
	}
	public getImageName(){
		return $this->image_name;
	}

	// Mutators

	
}

?>