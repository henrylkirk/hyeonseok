<?php

function __autoload($class_name) {
    require_once 'php/' . $class_name . '.class.php'; 
}

require_once(__DIR__."/LIB_project1.php");

$db = new DB();
$products = $db->get_all_products();

// create a new cart
if(!isset($cart)){
	$cart = new Cart;
}

?>