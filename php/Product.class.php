<?php

class Product {

	private $ID, $Name, $Price, $Description, $Quantity, $SalePrice, $ImageName;
	
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
	public function get_sale_price(){
		return $this->SalePrice;
	}
	public function get_image_name(){
		return $this->ImageName;
	}
	public function get_original_price(){
		return $this->Price;
	}

	// Mutators
	
	
}

?>