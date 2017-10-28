<?php 

/**
 * Contains products and quantities to be purchased.
 */
class Cart {

    private $db;
    private $cart_contents = array();

    public function __construct(){
        $db = new DB();
        $this->cart_contents = $db->get_cart_contents();
        $this->db = $db;
    }
    
    /**
     * Returns the cart array
     * @return array
     */
    public function get_contents(){
        return $this->cart_contents;
    }
    
    /**
     * Returns total price for cart
     * @return double
     */
    public function get_total(){
        $total = 0.0;
        for($i = 0; $i < count($this->cart_contents); $i++){
            $product = $this->db->get_product($this->cart_contents[$i]["ID"]);
            $price = $product->get_price();
            $quantity = $this->cart_contents[$i]["Quantity"];
            $total += ($price * $quantity);
        }
        return number_format($total,2);
    }
    
    /**
     * Insert product into the cart
     * @param int
     * @return bool
     */
    public function add(int $product_id){
        // add product to cart
        $sql_string = "INSERT INTO cart (ID, Quantity) VALUES(?, ?)";
        $params = array($product_id, 1);
        $this->db->set_data($sql_string, $params);
        return TRUE;
    }
    
    /**
     * Removes a product from the cart
     * @param int
     * @return bool
     */
    public function remove(int $product_id){
        $sql_string = "DELETE FROM cart WHERE ID = ?";
        $params = array($product_id);
        $this->db->set_data($sql_string, $params);
        return TRUE;
    }

    // public function empty(){
    //     return TRUE;
    // }
     
}