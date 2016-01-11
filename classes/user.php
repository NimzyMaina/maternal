<?php
class User {
	private $conn;
    private $table_name = "users";

    public $username;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    public function register(){
    	$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username = ?, password = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}