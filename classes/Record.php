<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/4/2016
 * Time: 11:09 AM
 */
class Record
{

    private $conn;
    private $table_name = "records";

    public $id;
    public $record ='';
    public $dr = 0;
    public $patient = 0;

    public function __construct($db){
        $this->conn = $db;
    }

    public function add(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    record = ?,doctor = ?,patient = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->record);
        $stmt->bindParam(2, $this->dr);
        $stmt->bindParam(3, $this->patient);

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function read($id){
        $query = "SELECT *
            FROM
                $this->table_name r
                JOIN users u on u.id = r.patient
                WHERE r.patient = $id";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    public function update($id,$update){
        //echo
        $query = "UPDATE
                " . $this->table_name . "
            SET
                record = '$update'
            WHERE
                patient = $id";//exit;

        $stmt = $this->conn->prepare($query);

        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

}