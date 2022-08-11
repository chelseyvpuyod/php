<?php
    include("./includes/Users.php");
    $user = new User();
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
        <div class="register">
        <h1>Register Form</h1>
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
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <label for="fname">First Name: </label>
                <input type="text" name="fname">
                <label for="fname">Last Name: </label>
                <input type="text" name="lname">
                <label for="fname">Email Address: </label>
                <input type="text" name="email">
                <button type="submit" name="submit">Register</button>
            </form>
        </div>
    </div>
    </div>
</body>
</html>