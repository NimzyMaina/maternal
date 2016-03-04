<?php
class User {
	private $conn;
    private $table_name = "users";

    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;
    public $role;
    public $status;
    public $id;

    public function __construct($db){
        $this->conn = $db;
    }

    public function register(){
    	$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    first_name = ?,last_name = ?,email = ? , phone = ?, password = ?, role = ?,status = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->first_name);
        $stmt->bindParam(2, $this->last_name);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->phone);
        $stmt->bindParam(5, sha1($this->password));
        $stmt->bindParam(6, $this->role);
        $stmt->bindParam(7, $this->status);
 
        if($stmt->execute()){
            $record = new Record($this->conn);
            $record->patient = $this->conn->lastInsertId();
            //echo
            $record->add();//exit;
            return true;
        }
            return false;
    }

    public function login()
    {
        $query = "SELECT * FROM $this->table_name WHERE email = '$this->email' AND password = '".sha1($this->password)."' ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num != 0 && $num < 2) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                if ($this->email == $email && sha1($this->password) == $password) {
                    session_start();
                    $_SESSION['full_name'] = $first_name . " " . $last_name;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = $role;
                    $_SESSION['user_id'] = $id;
                    return true;
                }
                return false;

            }//while
        }
    }

        function readAll(){
            $query = "SELECT *
            FROM
                $this->table_name
                WHERE role = 'patient'";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            return $stmt;
        }

    function readOne(){
        $query = "SELECT *
            FROM
                $this->table_name
                WHERE role = 'patient' AND id = $this->id";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    function readAllDocs(){
        $query = "SELECT *
            FROM
                $this->table_name
                WHERE role = 'doctor'";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

        function update($field_name,$value,$id){
            $query = "UPDATE
                " . $this->table_name . "
            SET
                $field_name = '$value'
            WHERE
                id = $id";//exit;

            $stmt = $this->conn->prepare($query);

            // $stmt->bindParam(':value', $value);
            //$stmt->bindParam(':id', $id);

            // execute the query
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function countAllPatients(){

            $query = "SELECT id FROM $this->table_name WHERE role = 'patient'";

            $stmt = $this->conn->prepare( $query );
            $stmt->execute();

            $num = $stmt->rowCount();

            return $num;
        }

    public function countAllDocss(){

        $query = "SELECT id FROM $this->table_name WHERE role = 'doctor'";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

        public function delete($id){
            $query = "UPDATE
                " . $this->table_name . "
            SET
                status = 0
            WHERE
                id = $id";//exit;

            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

    public function toogle($id,$status){
        $query = "UPDATE
                " . $this->table_name . "
            SET
                status = $status
            WHERE
                id = $id";//exit;

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }else{
            return false;
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