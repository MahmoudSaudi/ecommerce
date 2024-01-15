<?php 
class databaseConnection{
    private $host ='localhost';
    private $username ='root';
    private $password ='';
    private $database ='p1_ecommerce';
    private $connection;

    public function __construct(){
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if($this->connection->connect_error){
            die("connection failed: ".$this->connection->connect_error);
            // echo '';die;
        }
        // echo "connection successfuly";
    }

    public function runDQL($query){ //SELECT
        $result = $this->connection->query($query);
        if($result->num_rows >0 ){
            return $result;
        }else{
            return [];
        }

    }
    public function runDML($query){    // Inser, update ,...
        $result = $this->connection->query($query);
        if($result){
            return True;
        }else{
           return False;
        }
    }
}
// $test = new databaseConnection;

