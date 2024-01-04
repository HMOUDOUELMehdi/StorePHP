<?php 


class Database
{
    private $servername = "localhost";
    private $username = "root";       
    private $password = "";       
    public $connect ='' ;
    public function __construct()
    {
        try {

            $this->connect = new PDO("mysql:host=$this->servername;dbname=mystore",$this->username , $this->password);
            // set the PDO error mode to exception
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected successfully <br> <br> <br>  ";
        } catch (PDOException $T) {
            echo "Connection failed :".$T->getMessage();
        }
    }   
}



?>