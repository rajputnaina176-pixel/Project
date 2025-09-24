<?php
error_reporting(0);
session_start();
include("connection.php");
if (isset($_POST['submit'])){
 $user1 = $_POST['user'];
 $password1 = $_POST['password'];

 $sel = "SELECT * FROM users where username='$user1' and password='$password1'";
$result = mysqli_query($conn, $sel);

if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_nm']="[".$row['username']."] ".$row['email'];
    echo $_SESSION['user_nm'];
    header("Location:admin_index.php?id=1");    
}
    else{
        echo "not correct";
        $reply = "Invalid Credentials !!";
        header("Location: login.php?reply=" .urlencode($reply));
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include("header.php") ?>

    <?php
        if($_GET['id']==1){
            include("homepage.php");
        }
        else if($_GET['id']==2){
            include("user_func.php");
        }
        else if($_GET['id']==3){
            include("admin_about.php");
        }
        else if($_GET['id']==4){
            header("Location: login.php");
            exit();
        }
        else if($_GET['id']==5){
            header("Location: admin_logout.php");
            exit();
        } else{
            include("homepage.php");
        }
    ?>
</body>
</html>