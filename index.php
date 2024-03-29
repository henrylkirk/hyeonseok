<?php require_once("php/page_start.php"); ?>

<!-- Head -->
<?php echo $lib->get_head("Hyeonseok"); ?>

<!-- Navigation -->
<?php echo $lib->get_nav(); ?>

<!-- Header/Intro Section -->
<?php echo $lib->get_header("Welcome to Hyeonseok's Furniture Store", "Custom furniture &amp; Woodworking"); ?>

<!-- Sales Section -->
<?php echo $lib->get_sales(); ?>

<!-- Catalog of Products for this page -->
<?php echo $lib->get_catalog($page_num); ?>

<!-- Footer -->
<?php echo $lib->get_footer(); ?>