<?php
class User {
	private $conn;
    private $table_name = "users";

    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone_number;
    public $role;

    public function __construct($db){
        $this->conn = $db;
    }

    public function register(){
    	$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    first_name = ?,last_name = ?,email = ? , phone_number = ?, password = ?, role = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->first_name);
        $stmt->bindParam(2, $this->last_name);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->phone_number);
        $stmt->bindParam(5, sha1($this->password));
        $stmt->bindParam(6, $this->role);
 
        if($stmt->execute()){
            return true;
        }
            return false;
    }

    public function login(){
    	$query = "SELECT * FROM $this->table_name WHERE email = '$this->email' AND password = '".sha1($this->password)."' ";
//echo $query;
//exit;
    	$stmt = $this->conn->prepare( $query );
	    $stmt->execute();
	 
	    $num = $stmt->rowCount();

	    if($num != 0 && $num < 2){
	    	 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 			extract($row);

 			if($this->email == $email && sha1($this->password) ==  $password){
 				$_SESSION['full_name'] = $first_name ." ". $last_name;
 				$_SESSION['logged_in'] = true;
 				return true;
 			}
 				return false;

        }//while
	    }
 
    }
     public function check_email ($email){
        $query = "SELECT * FROM $this->table_name WHERE email = '$email' ";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num > 0){
            return false;
        }
        return true;
    }
    public function check_phone ($phone){
        $query = "SELECT * FROM $this->table_name WHERE phone LIKE '%$phone%' ";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num > 0){
            return false;
        }
        return true;
    }
}
