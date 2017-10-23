<?php

class Library {

    /**
     * get_head: Returns the site's head
     * @param    string
     * @return    string
     */
    public static function get_head(string $page_title){
        return <<<HTML
          <!DOCTYPE html>
          <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <meta name="description" content="A furniture e-commerce site.">
              <meta name="author" content="Henry Kirk">
              <title>$page_title</title>
              <!-- Bootstrap core CSS -->
              <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
              <!-- Custom fonts for this template -->
              <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
              <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
              <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
              <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
              <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
              <!-- Custom styles for this template -->
              <link href="css/hyeonseok.min.css" rel="stylesheet">
            </head>
            <body id="page-top">
HTML;
    }

    /**
     * get_nav: Returns the site's navigation
     * @return    string
     */
    public static function get_nav(){
        return <<<HTML
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
              <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">Hyeonseok</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  Menu
                  <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="#sales">Sales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="#catalog">Catalog</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="php/admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="php/cart.php"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
HTML;
    }

    /**
     * Returns the header/intro section
     * @return string
     */
    public static function get_header(){
        return <<<HTML
            <header class="masthead">
              <div class="container">
                <div class="intro-text">
                  <div class="intro-lead-in">Welcome to Hyeonseok's Furniture Store</div>
                  <div class="intro-heading">Custom furniture &amp; Woodworking</div>
                </div>
              </div>
            </header>
HTML;
    }

    /**
     * Returns the section of products
     * @param DB
     * @return string
     */
    public static function get_catalog($db){
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
              $catalog .= $db->get_products_as_items($db->get_catalog_products());
        $catalog .= <<<HTML
                </div>
              </div>
            </section>
HTML;
            return $catalog;
    }

    /**
     * get_sales: Returns the section of products on sale
     * @param DB
     * @return string
     */
    public static function get_sales($db){
        $sales = <<<HTML
            <section id="sales">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                          <h2 class="section-heading">Sales</h2>
                          <h3 class="section-subheading text-muted">Products currently on sale.</h3>
                        </div>
                    </div>
                    <div class="row">
                    <!-- Products on Sale -->
HTML;
        $sales .= $db->get_products_as_items($db->get_sale_products());
        $sales .= <<<HTML
                    </div>
                </div>
            </section>
HTML;
        return $sales;
    }

    /**
     * get_product_modal: Returns a string for a modal for a product
     * @param    Product
     * @return    string
     */
    public static function get_product_modal($product){
        return <<<HTML
        	<!-- Modal -->
            <div class="portfolio-modal modal fade" id="modal-{$product->get_id()}" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <h2>{$product->get_name()}</h2>
                          <p class="item-intro text-muted">{$product->get_description()}</p>
                          <img class="img-fluid d-block mx-auto" src="img/products-full/{$product->get_image_name()}.jpg" alt="{$product->get_image_name()}">
                          <p>{$product->get_description()}</p>
                          <ul class="list-inline">
                            <li>Price: &#36;{$product->get_price()}</li>
                            <li>Amount in stock: {$product->get_quantity()}</li>
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

    /**
     * get_footer: Returns the site's footer section
     * @return    string
     */
    public static function get_footer(){
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

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/popper/popper.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
            <!-- Plugin JavaScript -->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <!-- Contact form JavaScript -->
            <script src="js/jqBootstrapValidation.js"></script>
            <script src="js/contact_me.js"></script>
            <!-- Custom scripts -->
            <script src="js/hyeonseok.min.js"></script>
          </body>
        </html>
HTML;
    }

} // end class
?>