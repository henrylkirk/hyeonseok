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
	public function get_id(){
		return $this->ID;
	}
	public function get_name(){
		return $this->Name;
	}
	public function get_price(){
		return ($this->Price - $this->SalePrice);
	}
	public function get_description(){
		return $this->Description;
	}
	public function get_quantity(){
		return $this->Quantity;
	}
	private function get_sale_price(){
		return $this->SalePrice;
	}
	public function get_image_name(){
		return $this->ImageName;
	}

	// Mutators

	
}

?>