<?php
    include("./includes/Users.php");
    $user = new User();
    $id = $_GET['id'];
    $users = $user->get($id);
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
        <h1>Edit</h1>
            <?php
                if(isset($_POST['submit'])){
                    if(!empty($_POST['fname']) && $_POST['lname'] && $_POST['email']){
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            $user->update($id);
                        }else{
                            echo "<p>Email format is not accepted.</p>";
                        }  
                    }else{
                        echo "<p>Input not be empty.</p>";
                    }
                }
            ?>
            <form action="edit.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
                <label for="fname">First Name: </label>
                <input value="<?php echo $users['fname']?>" type="text" name="fname">
                <label for="fname">Last Name: </label>
                <input value="<?php echo $users['lname']?>" type="text" name="lname">
                <label for="fname">Email Address: </label>
                <input value="<?php echo $users['email']?>" type="text" name="email">
                <button type="submit" name="submit">Update</button> 
            </form>
            <button onClick="document.location='details.php?id=<?php echo $id;?>'" class="list upbutton right">Back</button>
        </div>
    </div>
    </div>
</body>
</html>