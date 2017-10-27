<?php 

// session_start();

class Cart {
    private $db;
    private $cart_contents = array();
    private $total;

    public function __construct(){
        $db = new DB();
        $this->cart_contents = $db->get_cart_contents();
        $this->db = $db;
    }
    
    /**
     * Returns the cart array
     * @return array
     */
    // public function get_contents(){
    //     return $this->cart_content;
    // }
    
    /**
     * Returns number of products in cart
     * @return int
     */
    // public function get_products_count(){
    //     return $count;
    // }
    
    /**
     * Returns total price
     * @return int
     */
    // public function get_total(){
    //     return $total;
    // }
    
    /**
     * Insert product into the cart
     * @param int
     * @return bool
     */
    // public function add_to_cart(int $product_id){
    //     return TRUE;
    // }
    
    /**
     * Removes a product from the cart
     * @param int
     * @return bool
     */
    // public function remove(int $product_id){
    //     return TRUE;
    // }

    // public function empty(){
    //     return TRUE;
    // }
     
}