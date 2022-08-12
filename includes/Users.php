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
            header("Location:index.php?saved=true");
        }else{
            echo "Items not found";
            die();
        }
    }

    public function delete($id){
        $sql = "DELETE FROM users WHERE id=".$id;
        $result = $this->connect()->query($sql);
        if($result){
            header("Location:index.php?deleted=successfully");
        }else{
            echo "Item not found.";
        }
    }

    public function update($id){
        $this->fname = $_POST['fname'];
        $this->lname = $_POST['lname'];
        $this->email = $_POST['email'];
        $sql = "UPDATE users SET fname='$this->fname',lname='$this->lname',email='$this->email' WHERE id=".$id;
        $result = $this->connect()->query($sql);
        if($result){
            header("Location:details.php?id=$id");
        }else{
            echo "Item not found.";
        }
    }

    public function userExist($email){
        $sql = "SELECT id FROM users WHERE email = '".$email."'";
        $result = $this->connect()->query($sql);
        $row = $result->num_rows;
        if($row > 0){
            return 1;
        }else{
            return 0;
        }
    }

    public function fillData(){
        return $_POST;
    }
}
?>