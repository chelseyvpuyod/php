<?php
    include("./includes/Users.php");

    if(isset($_GET['id'])){
        $getid = $_GET['id'];
    }else{
        $getid = "";
    }

    $user = new User();
    $users = $user->get($getid);

    if(isset($_GET['delete'])){
       echo $user->delete($_GET['delete']);
    }

    
    

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script>
        function deleteitem(id){
            var con = confirm("Are you sure you want to delete this item?");
            if(con){
                document.location="details.php?id="+id+"&delete="+id+"";
            }else{
                document.location="details.php?id="+id+"";
            }
        }
    </script>


    <title>Document</title>
</head>
<body>
    
    <div class="wrapper">
    <div class="container">
        <div class="details">
        <h1>Account</h1>
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
            <button onClick="document.location='edit.php?id=<?php echo $getid; ?>'" class="update left">Update</button>&nbsp;
            <button onClick="deleteitem(<?php echo $getid; ?>)" class="delete">Delete</button>
            <button onClick="document.location='index.php'" class="list right">Back</button>
        </div>
    </div>
    </div>

</body>

</html>