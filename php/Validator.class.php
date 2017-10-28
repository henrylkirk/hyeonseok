<?php
	
	class Validator {
	
		/**
		 * Return whether or not param is a number.
		 * @return bool
		 */
		public static function is_numeric($value){
			$reg = "/^[0-9]+$/";
			return preg_match($reg, $value);
		}

		/**
	     * Validate a page number
	     */
	    public static function validate_page($page_num, $total_products){
	        $max_page = ceil($total_products / ProductsManager::PRODUCTS_PER_PAGE);

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
	     * Sanitize a string.
	     * @return string
	     */
	    public static function sanitize_string($string){
			$string = trim($string);
			$string = stripslashes($string);
			$string = htmlentities($string);
			$string = strip_tags($string);
			return $string;
		}

		public static function is_valid_string($string){
			return !empty($string);
		}


	
	}
	
?>