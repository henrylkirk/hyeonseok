<?php require_once("php/page_start.php"); ?>

<?php
	//if form was submitted
	if (isset($_POST['submit'])) 
	{
		$ids = $_POST['id'];
		$names = $_POST['name'];
		$descriptions = $_POST['description'];
		$prices = $_POST['price'];
		$sale_prices = $_POST['sale_price'];
		$quantities = $_POST['quantity'];
		$image_names = $_POST['image_name'];

		foreach($names as $name){
			echo "<h2>$name</h2>";
		}
		
		echo "<h2>Count: ".count($_POST)."</h2>";

		//use print_r
		print_r($_POST);
		
		echo "<hr />";
		
		//another useful debugging tool
		var_dump($_POST);
		
		echo "<hr />";
		
		
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