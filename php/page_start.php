<?php

function __autoload($class_name) {
    require_once 'php/' . $class_name . '.class.php'; 
}

// Global Variables
// Include and create
$lib = new Library();

// get the page number
$page_num = isset($_GET["page"]) ? $_GET["page"] : 1;

?>