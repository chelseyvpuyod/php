<?php
    include("./includes/Users.php");

    if(isset($_GET['id'])){
        $getid = $_GET['id'];
    }else{
        $getid = "";
    }
    
    $user = new User();
    $users = $user->get($getid);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User</h1>

    <div class="container">
        <ul>
            <?php
            if($users){
                echo "<li>First Name: " .$users['fname']."</li>";
                echo "<li>Last Name: " .$users['lname']."</li>";
                echo "<li>Email Address: " .$users['email']."</li>";   
            }else{
                echo "<li>No data found.</li>"; 
            }
            ?>
        </ul>
    </div>

</body>
</html>