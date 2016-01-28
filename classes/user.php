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
                    first_name = ?,last_name = ?,email = ? , phone_number = ?, password = ?, role = 'standard'";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->first_name);
        $stmt->bindParam(2, $this->last_name);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->phone_number);
        $stmt->bindParam(5, sha1($this->password));
        //$stmt->bindParam(6, $this->role);

        //echo $stmt->queryString;exit;
 
        if($stmt->execute()){
            //echo 'good';exit;
            return true;
        }
        //echo 'bad';exit;
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
    
function readAll(){
 
    $query = "SELECT
                *
            FROM
                " . $this->table_name ;
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
public function countAll(){
 
    $query = "SELECT id FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}

function readOne(){
 
    $query = "SELECT
                id, first_name, last_name, email, phone, password
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->name = $row['first_name'];
    $this->price = $row['last_name'];
    $this->description = $row['email'];
    $this->category_id = $row['phone'];
    $this->category_id = $row['password'];
}

function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone  = :phone,
                password  = :password
            WHERE
                id = :id";
 
    $stmt = $this->conn->prepare($query);
 
    $stmt->bindParam(':first_name', $this->name);
    $stmt->bindParam(':last_name', $this->price);
    $stmt->bindParam(':email', $this->description);
    $stmt->bindParam(':phone', $this->category_id);
     $stmt->bindParam(':password', $this->id);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
}
?>