<?php
require_once('session.php');
error_reporting(E_ALL);
// helper function for validation


function valid($varname){
	return ( !empty($varname) && isset($varname) );
}




// USER CRUD




class UserCrud {	

public $user_id;


        public function __construct($user_id){
                $this->user_id = $user_id;
        }



	public function create($username, $email, $password, $permission){
		if (!valid($username) || !valid($email) || !valid($password)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO users (username,email,password,permission) values(?, ?, ?, 2)";
			$q = $pdo->prepare($sql);
			$q->execute(array($username,$email,$password));


			Database::disconnect();
			return $pdo->lastInsertId();
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM users WHERE id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        	Database::disconnect();
	        	return $data;
			} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}

    }

	public function update($username,$email,$password){
		if (!valid($username) || !valid($email) || !valid($password)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($username,$email,$password,$id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($user_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM users WHERE id = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($user_id));
        Database::disconnect();
        return true;

	}

}
// END USER CRUD







// ADDRESS CRUD
class UserAddress {	


	public $user_id;


	public function __construct($user_id){
		$this->user_id = $user_id;
	}

	public function create($street, $city, $zip, $state, $country){
		if (!valid($street) || !valid($city) || !valid($zip) || !valid($state) || !valid($country)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO address (street,city,zip,state,country) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($street,$city,$zip,$state,$country));
			$address_id = $pdo->lastInsertId();

			$sql = "INSERT INTO user_address (address_FK, user_FK) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($address_id, $this->user_id)); 

			Database::disconnect();
			return true;
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM address WHERE id IN (SELECT address_FK FROM user_address WHERE user_FK = ?) ORDER BY id DESC';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        return $data;
		} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
			

		}

    }

	public function update($street, $city, $zip, $state, $country, $address_id){
		if (!valid($street) || !valid($city) || !valid($zip) || !valid($state) || !valid($country) ) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE address SET street = ?, city = ?, zip = ?, state = ?, country = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($street,$city,$zip,$state,$country,$address_id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($address_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM user_address WHERE address_FK = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($address_id));
        Database::disconnect();
        return true;

	}
}




//USER CREDIT CRUD
class UserCredit {	


	public $user_id;


	public function __construct($user_id){
		$this->user_id = $user_id;
	}

	public function create($name, $number, $expiration, $securitycode, $type, $address_FK){
		if (!valid($name) || !valid($number) || !valid($expiration) || !valid($securitycode) || !valid($type) || !valid($address_FK)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO creditcard (name,number,expiration,securitycode,type,address_FK) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$number,$expiration,$securitycode,$type,$address_FK));
			$credit_id = $pdo->lastInsertId();

			$sql = "INSERT INTO user_creditcard(credit_FK, user_FK) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($credit_id, $this->user_id)); 

			Database::disconnect();
			return true;
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM creditcard WHERE id IN (SELECT credit_FK FROM user_creditcard WHERE user_FK = ?) ORDER BY id DESC';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        return $data;
		} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
			

		}

    }

	public function update($name,$number,$expiration,$securitycode,$type,$address_FK,$credit_id){
		if (!valid($name) || !valid($number) || !valid($expiration) || !valid($securitycode) || !valid($type) || !valid($address_FK)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE creditcard SET name = ?, number = ?, expiration = ?, securitycode = ?, type = ?, address_FK = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$number,$expiration,$securitycode,$type,$address_FK,$credit_id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($credit_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM user_creditcard WHERE credit_FK = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($credit_id));
        Database::disconnect();
        return true;

	}

}


//ADMIN SHIPMENET CENTER CRUD

class ShipmentCenter {	
	public $user_id;
	public function __construct($user_id){
		$this->user_id = $user_id;
	}
	public function create($name,$address_FK){
		if (!valid($name) || !valid($address_FK)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "INSERT INTO shipmentcenter (name,address_FK) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$address_FK));
			$shipment_id = $pdo->lastInsertId();
		


			Database::disconnect();
			return true;

			}
		}


	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM shipmentcenter ORDER BY name';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        return $data;
		} catch (PDOException $error){
			header( "Location: 500.php" );
			//echo $error->getMessage();
			
		}
    }
	public function update($name,$address_FK){
		if (!valid($name) || !valid($address_FK)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE shipmentcenter SET name = ?, address_FK = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$address_FK,$shipment_id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($shipment_id){
        $pdo = Database::connect();
        $sql = "DELETE FROM `ecomm`.`shipmentcenter` WHERE `shipmentcenter`.`id` = ?"; 
        $q = $pdo->prepare($sql);
        $q->execute(array($shipment_id));
        Database::disconnect();
        return true;
	}
}




// ADMIN BIN CRUD
class BinCrud {	
	public $user_id;
	public function __construct($user_id){
		$this->user_id = $user_id;
	}
	public function create($name, $location, $shipmentcenter_FK){
		if (!valid($name) || !valid($location) || !valid($shipmentcenter_FK)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "INSERT INTO bin (name,location,shipmentcenter_FK) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$location,$shipmentcenter_FK));
			$bin_id = $pdo->lastInsertId();
			$sql = "INSERT INTO bin_shipment(bin_FK, shipmentcenter_FK) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($bin_id, $shipmentcenter_FK)); 
			Database::disconnect();
			return true;
		}
	}
	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM bin ORDER BY id DESC';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        return $data;
		} catch (PDOException $error){
			header( "Location: 500.php" );
			//echo $error->getMessage();
			
		}
    }
	public function update($name, $location, $shipmentcenter_FK){
		if (!valid($name) || !valid($location) || !valid($shipmentcenter_FK)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE bin SET name = ?, location = ?, shipmentcenter_FK = ?  WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$location,$shipmentcenter_FK,$bin_id));
			Database::disconnect();
			return true;
		}
	}
	public function delete($bin_id){
        $pdo = Database::connect();
        $sql = "DELETE FROM `ecomm`.`bin` WHERE `bin`.`id` = ?"; 
        $q = $pdo->prepare($sql);
        $q->execute(array($bin_id));
        Database::disconnect();
        return true;
	}
}


//PRODUCT CRUD
class ProductCrud {


	public $user_id;
	public function __construct($user_id){
		$this->user_id = $user_id;
	}
	
	public function create($name,$description,$price,$bin_FK,$category_FK){
		if (!valid($name) || !valid($description) || !valid($price) || !valid($bin_FK) || !valid($category_FK)) {
			return false;
		} else {
			try{
			$pdo = Database::connect();
			$sql = "INSERT INTO product (name,description,price,bin_FK,category_FK) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$description,$price,$bin_FK,$category_FK));
			$product_id = $pdo->lastInsertId();
			
			$sql = "INSERT INTO product_bin (product_FK,bin_FK) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($product_id,$bin_FK));

			Database::disconnect();
			return true;
			} catch(PDOException $error) {
			echo $error->getMessage();
			}
		}	

	}
	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM product ORDER BY id';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	         Database::disconnect();
	        return $data;
		} catch (PDOException $error){
			header( "Location: 500.php" );
			//echo $error->getMessage();
			
		}
    }
	public function update($name,$description,$price,$bin_FK,$category_FK,$product_id){
		if (!valid($name) || !valid($description) || !valid($price) || !valid($bin_FK) || !valid($category_FK)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE product SET name = ?, description = ?, price = ?, bin_FK = ?, category_FK = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$description,$price,$bin_FK,$category_FK,$product_id));
			Database::disconnect();
			return true;
		}
	}
	public function delete($product_id){
try {	 $pdo = Database::connect();
        $sql = "DELETE FROM product_bin WHERE product_FK = ?"; 
        $q = $pdo->prepare($sql);
        $q->execute(array($product_id));
        Database::disconnect();
        return true;
	} catch (PDOException $e) {
	echo $e->getMessage();
	return false;
	}
	
}
}





//CATEGORY CRUD
class CategoryCrud {	
	public $user_id;
	public function __construct($user_id){
		$this->user_id = $user_id;
	}
	public function create($name){
		if (!valid($name)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "INSERT INTO category (name) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name));
			$category_id = $pdo->lastInsertId();
			Database::disconnect();
			return true;
		}	
	}
	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM category ORDER BY id';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	         Database::disconnect();
	        return $data;
		} catch (PDOException $error){
			header( "Location: 500.php" );
			//echo $error->getMessage();
			
		}
    }
	public function update($name,$category_id){
		if (!valid($name)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE category SET name = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$category_id));
			Database::disconnect();
			return true;
		}
	}
	public function delete($category_id){
        $pdo = Database::connect();
        $sql = "DELETE FROM category WHERE id = ?"; 
        $q = $pdo->prepare($sql);
        $q->execute(array($category_id));
        Database::disconnect();
        return true;
	
	}
}








//CART CRUD


class Cart {
	public $user_id;
	public $cart_id; 
		
	public function __construct($user_id) {
		$this->user_id = $user_id;
	}	
		

	public function getCartID() {
		try {
		$pdo = Database::connect();
		
		$sql = 'SELECT * FROM transaction WHERE user_FK = ? AND cart = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($this->user_id,1));
		$cart = $q->fetch(PDO::FETCH_ASSOC);
		$this->cart_id = $cart['id'];
		return $this->cart_id;
		} catch (PDOException $e) {
		echo $e->getMessage();
	}
Database::disconnect();
}

public function createCart() {
	try{
		$pdo = Database::connect();
		$sql = "INSERT INTO transaction (user_FK,cart) values(?, 1)";
		$q = $pdo->prepare($sql);
		$q->execute(array($this->user_id));
	//	Database::disconnect();
		return $pdo->lastInsertId();
	} catch (PDOException $e) {
		echo $e->getMessage();
}
Database::disconnect();
}


public function getCart($cart_id) {
		$shoppingBag = array();
		$pdo = Database::connect();
		$sql = 'SELECT * FROM transaction_product WHERE trans_FK = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($cart_id));
		$shoppingBag_id = $q->fetchAll(PDO::FETCH_ASSOC);
		foreach ($shoppingBag_id as $item) {
			$sql = 'SELECT * FROM product WHERE id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($item['product_FK']));
			$product = $q->fetch(PDO::FETCH_ASSOC);
		
			$transaction = array("id"=>$item['id'], "product_FK"=>$item['product_FK'], "quantity"=>$item['quantity'], "name"=>$product['name'], "price"=>$product['price']);
			
			array_push($shoppingBag, $transaction);
		}
		Database::disconnect();
		return $shoppingBag;
		}




public function addToCart($cart_id,$product_FK) {
			echo $cart_id;
			echo $product_FK;
		try {
		$pdo = Database::connect();
		$sql = "INSERT INTO transaction_product (trans_FK,product_FK,quantity) values(?, ?, 1)";
		$q = $pdo->prepare($sql);
		$q->execute(array($cart_id,$product_FK));	
		Database::disconnect();
                return true;
		} catch (PDOException $e) {

		echo $e->getMessage();
		}
		}

public function updateQ($quantity,$productTransactionID) {
		if (!valid($quantity)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE transaction_product SET quantity = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
        	$q->execute(array($quantity,$productTransactionID));
			Database::disconnect();
			return true;
		}
	}


public function deleteFromCart($productTransactionID) {
        $pdo = Database::connect();
        $sql = "DELETE FROM `ecomm`.`transaction_product` WHERE `id` = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($productTransactionID));
        Database::disconnect();
        return true;
	}



public function Checkout($cart_id) {
	try {
	$pdo = Database::connect();
	
	$sql = "UPDATE transaction SET cart = ? WHERE id = ?";
	$q = $pdo->prepare($sql);
//	$q->execute(array(0,$cart_id);
//	Database::disconnect();
	} catch (PDOException $e) {
	echo $e->getMessage();
	}
	Database::disconnect();
//	return $this->createCart();

}


}


