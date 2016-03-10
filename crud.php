<?php

// helper function for validation


function valid($varname){
	return ( !empty($varname) && isset($varname) );
}


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

			$sql = "INSERT INTO user_address (address_fk, user_FK) values(?, ?)";
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
			$sql = "UPDATE address SET street = ?, city= ?, zip = ?, state = ?, country = ? WHERE id = ?";
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







