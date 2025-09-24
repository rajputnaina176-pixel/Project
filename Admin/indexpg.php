<?php
 session_start();
 if (!isset($_SESSION['user_nm']) )
 {
  $_SESSION['user_nm']="Guest";
    
 }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
       header("location: login.php");

    
    
 
    ?>
</body>
</html>