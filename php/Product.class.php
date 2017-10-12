<?php

class Product {

	private $id;
	private $name;
	private $price;
	private $description;
	private $quantity;
	private $sale_price;
	private $image_name;
	
	// Accessors
	public getId(){
		return $this->id;
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