<?php

function __autoload($class_name) {
    require_once 'php/' . $class_name . '.class.php'; 
}

// Include and create
$lib = new Library();

// create a new cart
if(!isset($cart)){
	$cart = new Cart;
}

// get the page number
$page_num = isset($_GET["page"]) ? $_GET["page"] : 1;

?>