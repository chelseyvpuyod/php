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
    <title>Document</title>
</head>
<body>
    <h1>List of all users;</h1>

    <div class="container">
        <ul>
            <?php
                foreach($allUsers as $key => $user){
                    echo "<li>First Name: <a href='details.php?id=".$user['id']."'>" .$user['fname']."</a></li>";
                    echo "<hr>";
                }
            ?>
        </ul>
    </div>

</body>
</html>