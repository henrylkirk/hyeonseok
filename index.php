<?php require_once("php/page_start.php"); ?>

<!-- Head -->
<?php echo Library::get_head("Hyeonseok"); ?>

<!-- Navigation -->
<?php echo Library::get_nav(); ?>

<!-- Header/Intro Section -->
<?php echo Library::get_header(); ?>

<!-- Sales Section -->
<?php echo Library::get_sales($db); ?>

<!-- Catalog of All Products -->
<?php echo Library::get_catalog($db); ?>

<!-- Get product modals -->
<?php
  foreach($products as $product){
    echo Library::get_product_modal($product);
  }
?>

    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Contact</h2>
            <h3 class="section-subheading text-muted">Need a custom piece a furniture?</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-xl" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<!-- Footer -->
<?php echo Library::get_footer(); ?>