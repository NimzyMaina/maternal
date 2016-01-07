<?php
require(dirname(__FILE__).'/../vendor/autoload.php');//autoload packages

class Database{
 
    public $conn;
 
    // get the database connection
    public function getConnection(){

    	$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
		$dotenv->load();

		$host = getenv('DB_HOST');
		$db_name = getenv('DB_DATABASE');
		$username = getenv('DB_USERNAME');
		$password = getenv('DB_PASSWORD');
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}

// $db = new Database();
// $db->getConnection();
