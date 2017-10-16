<?php

// function __autoload($class_name) {
//     require_once 'php/' . $class_name . '.class.php'; 
// }

class Library {

// Returns main navigation as string/HTML
public static function getNav(){
return <<<HTML
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Hyeonseok</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#catalog">Catalog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
HTML;
}

public static function test(){
	return "test";
}

// Returns the header section as string/HTML
public static function getHeader(){
return <<<HTML
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Welcome To Hyeonseok's Furniture Store</div>
          <div class="intro-heading">Custom furniture &amp; Woodworking</div>
          <a class="btn btn-xl js-scroll-trigger" href="#services">Tell Me More</a>
        </div>
      </div>
    </header>
HTML;
}

// Returns catalog section as string/HTML
public static function getCatalog($db){
$catalog = <<<HTML
	<section class="bg-light" id="catalog">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Catalog</h2>
            <h3 class="section-subheading text-muted">Available furniture for purchasing.</h3>
          </div>
        </div>
        <div class="row">
HTML;
      $catalog .= $db->getAllProductsAsItems();
$catalog .= <<<HTML
        </div>
      </div>
    </section>
HTML;
    return $catalog;
}

// Returns the footer section as string/HTML
public static function getFooter(){
return <<<HTML
	<!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; Hyeonseok Oh 2017</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
HTML;
}

// Returns a modal that contains details for a product
public function getProductModal($product){
return <<<HTML
	<!-- Modal -->
    <div class="portfolio-modal modal fade" id="modal-{$product->getId()}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2>{$product->getName()}</h2>
                  <p class="item-intro text-muted">{$product->getDescription()}</p>
                  <img class="img-fluid d-block mx-auto" src="img/{$product->getImageName()}.jpg" alt="">
                  <p>{$product->getDescription()}</p>
                  <ul class="list-inline">
                    <li>Price: {$product->getPrice()}</li>
                    <li>Amount in stock: {$product->getQuantity()}</li>
                  </ul>
                  <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

HTML;
}

} // end class
?>