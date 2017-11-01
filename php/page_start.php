<?php

function __autoload($class_name) {
    require_once 'php/' . $class_name . '.class.php'; 
}

// get the page number
$page_num = isset($_GET["page"]) ? $_GET["page"] : 1;

// Global Variables
// Include and create
$lib = new Library();
$products_manager = new ProductsManager();
$cart = new Cart();

// get product to be added to cart
$cart_action = isset($_GET["action"]) ? $_GET["action"] : "";
$product_id = isset($_GET["id"]) ? $_GET["id"] : 0;

// add product to cart
if($cart_action == "addToCart"){
	// decrement product quantity
	if($products_manager->get_product_quantity($product_id) >= 1){
		$cart->add($product_id);
		$products_manager->remove_product($product_id, 1);
		header("Refresh:0"); // refresh page
	}
} elseif($cart_action == "removeFromCart"){
	$cart->remove($product_id);
}

?>