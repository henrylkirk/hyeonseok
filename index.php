<?php 
  define("PATH_PHP", __DIR__."/php/");
  require_once(PATH_PHP."page_start.php");
?>

<!-- Head -->
<?php echo $lib->get_head("Hyeonseok"); ?>

<!-- Navigation -->
<?php echo $lib->get_nav(); ?>

<!-- Header/Intro Section -->
<?php echo $lib->get_header(); ?>

<!-- Sales Section -->
<?php echo $lib->get_sales(); ?>

<!-- Catalog of Products for this page -->
<?php echo $lib->get_catalog($page_num); ?>

<!-- Footer -->
<?php echo $lib->get_footer(); ?>