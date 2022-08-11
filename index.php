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
                if(isset($_POST['submit'])){
                    if(!empty($_POST['fname']) && $_POST['lname'] && $_POST['email']){
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            $user->add();
                        }else{
                            echo "<p class='red'>Email format is not accepted.</p>";
                        }  
                    }else{
                        echo "<p class='red'>Input not be empty.</p>";
                    }
                }
            ?>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <label for="fname">First Name: </label>
                <input type="text" name="fname">
                <label for="fname">Last Name: </label>
                <input type="text" name="lname">
                <label for="fname">Email Address: </label>
                <input type="text" name="email">
                <button type="submit" name="submit">Add</button>
            </form>
        </div>
</div>
</body>
</html>