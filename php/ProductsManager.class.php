<?php

class ProductsManager {

	private $db;
	const PRODUCTS_PER_PAGE = 5;
	const SALES_PRODUCTS_MIN = 3;
	const SALES_PRODUCTS_MAX = 5;

	public function __construct(){
        $this->db = new DB();
    }

	public function update_product($id, $name, $description, $price, $sale_price, $quantity, $image_name){
		$sql_string = "UPDATE products SET Name = ?, Price = ?, Description = ?, Quantity = ?, SalePrice = ?, ImageName = ? WHERE ID = ?";
		$params = array($id, $name, $description, $price, $sale_price, $quantity, $image_name);
		$this->db->set_data($sql_string, $params);
	}

	public function get_product_quantity(int $id){
		$product = $this->db->get_product($id);
		$quantity = $product->get_quantity();
		return $quantity;
	}

	/**
	 * Returns the product with given id.
	 * @param int
	 * @return Product
	 */
	public get_product(int $id){
		$sql_string = "SELECT * FROM products WHERE id = ?";
		$params = array($id);
		$this->db->get_data($sql_string, $params, "Product");
		return $product;
	}
	

	/**
	 *
	 */
	public function remove_product($id, int $num_to_remove){
		$product = $this->db->get_product($id);
		$quantity = 3;
		// $quantity = (int)$product->get_quantity() - $num_to_remove;
		$name = $product->get_name();
		$description = $product->get_description();
		$price = $product->get_price();
		$sale_price = $product->get_sale_price();
		$image_name = $product->get_image_name();
		// $this->update_product($id, $name, $description, $price, $sale_price, $quantity, $image_name);

		// $sql_string = "UPDATE products SET Name = ?, Price = ?, Description = ?, Quantity = ?, SalePrice = ?, ImageName = ? WHERE ID = ?";
		// $params = array($id, $name, $description, $price, $sale_price, $quantity, $image_name);
		// $this->db->set_data($sql_string, $params);
	}
}



?>