<?php
include("./includes/Db.php");

class User extends Db{
    public function getall(){
        $data = array();
        $sql = "SELECT * FROM users";
        $result = $this->connect()->query($sql);
        $row = $result->num_rows;
        if($row > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }else{
            return 0;
        }
        return $data;
    }

    public function get($id){
        $data = array();
        $sql = "SELECT * FROM users WHERE id =".$id;
        $result = $this->connect()->query($sql);
        $row = $result->num_rows;
        if($row > 0){
            $data = $result->fetch_assoc();
        }else{
            return 0;
        }
        return $data;
    }   
    public function add(){
        $this->fname = $_POST['fname'];
        $this->lname = $_POST['lname'];
        $this->email = $_POST['email'];
        $sql = "INSERT INTO users(fname, lname, email) VALUES ('$this->fname','$this->lname','$this->email')";
        $result = $this->connect()->query($sql);
        if($result){
            header("Location:index.php");
        }else{
            echo "Items not found";
            die();
        }
    }


}
?>