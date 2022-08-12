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

    public function pagination(){
        // find out how many rows are in the table 
        $sql = "SELECT COUNT(*) FROM users";
        $result = $this->connect()->query($sql);
        $r = $result->fetch_row();
        $numrows = $r[0];

        $rowsperpage = 3;
        // find out total pages
        $totalpages = ceil($numrows / $rowsperpage);

        // get the current page or set a default
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
        // cast var as int
        $currentpage = (int) $_GET['currentpage'];
        } else {
        // default page num
        $currentpage = 1;
        } // end if

        // if current page is greater than total pages...
        if ($currentpage > $totalpages) {
        // set current page to last page
        $currentpage = $totalpages;
        } // end if
        // if current page is less than first page...
        if ($currentpage < 1) {
        // set current page to first page
        $currentpage = 1;
        } // end if

        // the offset of the list, based on current page 
        $offset = ($currentpage - 1) * $rowsperpage;

        // get the info from the db 
        $sql = "SELECT id, fname FROM users ORDER BY id DESC LIMIT $offset, $rowsperpage";
  
        $result = $this->connect()->query($sql);

        // while there are rows to be fetched...
        while ($list = $result->fetch_assoc()) {
        // echo data
        echo "<ul>";
            //echo $list['id'] . " : ".$list['fname']."<br />";
            echo "<li>Name: <a href='details.php?id=".$list['id']."'>" .$list['fname']."</a></li>";
            echo "<hr>";
        echo "</ul>";
        } // end while


        echo "<div class='pagelinks right'>";
        //$this->pagereturn = $result;

        /******  build the pagination links ******/
        // range of num links to show
        $range = 3;

        // if not on page 1, don't show back links
        if ($currentpage > 1) {
        // show << link to go back to page 1
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'> First </a> ";
        // get previous page num
        $prevpage = $currentpage - 1;
        // show < link to go back to 1 page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'> Previous </a> ";
        } // end if 

        // loop to show links to range of pages around current page
        for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
            // if it's a valid page number...
            if (($x > 0) && ($x <= $totalpages)) {
                // if we're on current page...
                if ($x == $currentpage) {
                    // 'highlight' it but don't make a link
                    echo " [<b>$x</b>] ";
                // if not current page...
                } else {
                    // make it a link
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
                } // end else
            } // end if 
        } // end for

        // if not on last page, show forward and last page links        
        if ($currentpage != $totalpages) {
            // get next page
            $nextpage = $currentpage + 1;

            // echo forward link for next page 
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'> Next </a> ";
            // echo forward link for lastpage
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'> Last </a> ";
        } // end if
        /****** end build pagination links ******/
        echo "</div>";
    }
}
?>