<?php
class Db {
    private $servername;
    private $user;
    private $pass;
    private $dbname; 

    private $fname;
    private $lname;
    private $email;

    public function connect(){
        $this->servername = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbname = "chelseyphp";
        $con = new mysqli($this->servername,$this->user,$this->pass, $this->dbname);
        return $con;
    } 
}
?>