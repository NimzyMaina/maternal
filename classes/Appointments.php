<?php

class Appointments
{
    private $conn;
    private $table_name = "calendar";

    public $id;
    public $title;
    public $user_id;
    public $startdate;

    public function __construct($db){
        $this->conn = $db;
    }

    public function add(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    title = ?,startdate = ?,enddate = ? , allDay = false";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->startdate);
        $stmt->bindParam(3, $this->startdate);

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function edit(){
        //echo
        $query = "UPDATE
                " . $this->table_name . "
            SET
                title = '$this->title',
                user_id = '$this->user_id',
                startdate = '$this->startdate',
                enddate = '$this->startdate'
            WHERE
                id = $this->id";//exit;

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

    function readAll(){
        $query = "SELECT *
            FROM
                $this->table_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    public function countAll(){

        $query = "SELECT id FROM $this->table_name";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    public function getApp($id){
        $query = "SELECT max(startdate) as startdate
            FROM
                $this->table_name WHERE user_id = $id";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

}