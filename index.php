<?php
    include("./includes/Users.php");
    
    $user = new User();
    $allUsers = $user->getall();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
    <div class="container">
    <h1>List of all users:</h1>
        <div class="message">
            <?php 
                if(isset($_GET['deleted'])){
                    echo "<p class='red'><span id='deleted'>Item successfully deleted.</span>&nbsp;</p>";
                }

                if(isset($_GET['saved'])){
                    echo "<p class='red'><span id='deleted'>Item successfully added.</span>&nbsp;</p>";
                }
            ?>
            
        </div>
        <ul>
            <?php
                foreach($allUsers as $key => $alluser){
                    echo "<li>Name: <a href='details.php?id=".$alluser['id']."'>" .$alluser['fname']."</a></li>";
                    echo "<hr>";
                }
            ?>
        </ul>
    </div>

    <div class="addnewusers">
        <h1>Add Users</h1>
        
            <?php
                $gfname = "";
                $glname = "";
                $gemail = "";

                $action = "index.php";
                if(isset($_POST['submit'])){
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'];

                    $fildata = $user->fillData();
                    if(count($fildata)>0){
                        $gfname = $fildata['fname'];
                        $glname = $fildata['lname'];
                        $gemail = $fildata['email'];
                    }

                    if(!empty($fname && $lname && $email)){
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            $userExist = $user->userExist($_POST['email']);
                            if($userExist){

                                echo "<p class='red'>Email is already in used.</p>";
                            }else{
                                $user->add(); 
                            }
                            
                        }else{
                            echo "<p class='red'>Email format is not valid.</p>";
                        }  
                    }else{
                        echo "<p class='red'>Input not be empty.</p>";
                    }
                    // Validate if errors found

                }
            ?>
            <form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
            <?php
            
            
            ?>
                <label for="fname">First Name: </label>
                <input type="text" value="<?php echo $gfname;?>" name="fname">
                <label for="fname">Last Name: </label>
                <input type="text" value="<?php echo $glname;?>" name="lname">
                <label for="fname">Email Address: </label>
                <input type="text" value="<?php echo $gemail;?>" name="email">
                <button type="submit" name="submit">Add</button>
            </form>
        </div>
        <div class="footer">Copyright 2022</div>
</div>

<script>
    var s = document.getElementById('deleted').style;
    s.opacity = 1;
    (function fade(){(s.opacity-=.1)<0?s.display="none":setTimeout(fade,800)})();
</script>
</body>
</html>