<?php

/**
 * A class that contains functions to get sections of this site.
 */
class Library {

    private $db;

    /**
     * Constructor
     */
    function __construct(){
        $this->db = new DB();
    }

    /**
     * A utility function to validate a page number
     */
    private function validate_page($page_num){
        $max_page = ceil($this->db->get_catalog_products_count() / $this->db::PRODUCTS_PER_PAGE);

        // make sure a number
        if(is_numeric($page_num)){
            $page_num = (int)$page_num;
        } else {
            $page_num = 1;
        }
        // make sure within valid page range
        if($page_num > $max_page){
            $page_num = $max_page;
        } elseif($page_num < 1) {
            $page_num = 1;
        }
        return $page_num;
    }

    /**
     * get_head: Returns the site's head
     * @param    string
     * @return    string
     */
    public function get_head(string $page_title){
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
    public function get_nav(){
        return <<<HTML
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
              <div class="container">
                  <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">Hyeonseok</a>
                  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                  </button>
                <div class="collapse navbar-collapse navbar-left" id="navbarResponsive">
                  <!-- <ul class="navbar-nav ml-auto"> -->
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="#sales">Sales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="#catalog">Catalog</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
                    </li>
                  </ul>
                </div>
                  <!-- Login Form -->
                  <form class="navbar-form navbar-right" role="search" style="width:100%;">
                    <div class="form-group row">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Sign In</button>
                  </form>
              </div>
            </nav>
HTML;
    }

    /**
     * Returns the header/intro section
     * @return string
     */
    public function get_header($intro_leadin, $intro_heading){
        return <<<HTML
            <header class="masthead">
              <div class="container">
                <div class="intro-text">
                  <div class="intro-lead-in">{$intro_leadin}</div>
                  <div class="intro-heading">{$intro_heading}</div>
                </div>
              </div>
            </header>
HTML;
    }

    /**
     * Returns the html for given products.
     * @param array
     * @return string
     */
    private function get_products_as_items($products){
        $items = "";
        foreach($products as $product){
            $items .= <<<HTML
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#modal-{$product->get_id()}">
                      <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                          <i class="fa fa-eye fa-3x"></i>
                        </div>
                      </div>
                      <img class="img-fluid" src="img/products-thumb/{$product->get_image_name()}.jpg" alt="">
                    </a>
                    <div class="portfolio-caption">
                      <h4>{$product->get_name()}</h4>
                      <p class="text-muted">&#36;{$product->get_price()}</p>
                      <a href="index.php?action=addToCart&id={$product->get_id()}"><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i></a>
                    </div>
                </div>
HTML;
            $items .= $this->get_product_modal($product);
        }
        return $items;
    }

    /**
     * Returns the section of products
     * @param int
     * @return string
     */
    public function get_catalog($page_num){
        $page_num = $this->validate_page($page_num);

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
              $catalog .= $this->get_products_as_items($this->db->get_catalog_products($page_num));
              $catalog .= <<<HTML
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example" style="margin:auto;width: 164px;">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="index.php?page=1#catalog">1</a></li>
                    <li class="page-item"><a class="page-link" href="index.php?page=2#catalog">2</a></li>
                    <li class="page-item"><a class="page-link" href="index.php?page=3#catalog">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </section>
HTML;
            return $catalog;
    }

    /**
     * get_sales: Returns the section of products on sale
     * @return string
     */
    public function get_sales(){
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
        $sales .= $this->get_products_as_items($this->db->get_sale_products());
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
    private function get_product_modal($product){
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
    public function get_footer(){
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