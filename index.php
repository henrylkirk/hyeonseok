<?php 
  define("PATH_PHP", __DIR__."/php/");
  require_once(PATH_PHP."page_start.php");
?>

<!-- Head -->
<?php echo Library::get_head("Hyeonseok"); ?>

<!-- Navigation -->
<?php echo Library::get_nav(); ?>

<!-- Header/Intro Section -->
<?php echo Library::get_header(); ?>

<!-- Sales Section -->
<?php echo Library::get_sales($db); ?>

<!-- Catalog of Products for this page -->
<?php echo Library::get_catalog($db, 1); ?>

<!-- Get product modals -->
<?php
  foreach($products as $product){
    echo Library::get_product_modal($product);
  }
?>

<!-- Footer -->
<?php echo Library::get_footer(); ?>