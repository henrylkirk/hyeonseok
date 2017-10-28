<?php require_once("php/page_start.php"); ?>

<?php

	// start session
	session_name("login");
	session_start();

	// check if user logged in
	if(isset($_SESSION['loggedin'])){
 		
 		// unset session variable
 		session_unset();
 		
 		// destroy session
 		session_destroy();
 		
 		// set cookie to expire
 		setcookie("loggedin", "", 1);
 		
	} else { // not logged in, redirect to login.php
		header("location: login.php");
	}

	//if update form was submitted
	if (isset($_POST['update'])) {
		$ids = $_POST['id'];
		$names = $_POST['name'];
		$descriptions = $_POST['description'];
		$prices = $_POST['price'];
		$sale_prices = $_POST['sale_price'];
		$quantities = $_POST['quantity'];
		$image_names = $_POST['image_name'];

		// update this product with id
		for($i = 0; $i < count($ids); $i++){
			$name = Validator::sanitize_string($names[$i]);
			$price = filter_var($prices[$i], FILTER_SANITIZE_NUMBER_INT);
			$description = Validator::sanitize_string($descriptions[$i]);
			$quantity = filter_var($quantities[$i], FILTER_SANITIZE_NUMBER_INT);
			$sale_price = filter_var($sale_prices[$i], FILTER_SANITIZE_NUMBER_INT);
			$image_name = Validator::sanitize_string($image_names[$i]);
			$id = filter_var($ids[$i], FILTER_SANITIZE_NUMBER_INT);

			// validate
			if(Validator::is_numeric($id) && Validator::is_numeric($price) && Validator::is_numeric($quantity) && Validator::is_numeric($sale_price) && Validator::is_valid_string($name) && Validator::is_valid_string($description) && Validator::is_valid_string($image_name)){
				// update
				$sql_string = "UPDATE products SET Name = ?, Price = ?, Description = ?, Quantity = ?, SalePrice = ?, ImageName = ? WHERE ID = ?";
				$params = array($names[$i], $prices[$i], $descriptions[$i], $quantities[$i], $sale_prices[$i], $image_names[$i], $ids[$i]);
				$lib->db->set_data($sql_string, $params);
			}
		}
	}

	// if create product form submitted
	if(isset($_POST['create'])){
		// sanitize
		$name = Validator::sanitize_string($_POST['new_name']);
		$description = Validator::sanitize_string($_POST['new_description']);
		$price = filter_var($_POST['new_price'], FILTER_SANITIZE_NUMBER_INT);
		$sale_price = filter_var($_POST['new_sale_price'], FILTER_SANITIZE_NUMBER_INT);
		$quantity = filter_var($_POST['new_quantity'], FILTER_SANITIZE_NUMBER_INT);
		$image_name = Validator::sanitize_string($_POST['new_image_name']);
		//validate
		if(Validator::is_numeric($price) && Validator::is_numeric($quantity) && Validator::is_numeric($sale_price) && Validator::is_valid_string($name) && Validator::is_valid_string($description) && Validator::is_valid_string($image_name)){
			// insert
			$lib->db->insert_product($name, $price, $description, $quantity, $sale_price, $image_name);
		}
	}
?>

<!-- Head -->
<?php echo $lib->get_head("Hyeonseok | Admin"); ?>

<!-- Navigation -->
<?php echo $lib->get_nav(); ?>

<!-- Header/Intro Section -->
<?php echo $lib->get_header("", "Admin"); ?>

<!-- Admin Section -->
<?php echo $lib->get_admin_section(); ?>

<!-- Footer -->
<?php echo $lib->get_footer(); ?>