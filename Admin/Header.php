<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  body{
   background: linear-gradient(to right, #e0e0e6ff, skyblue,lightgreen);
  animation:gradient:15s ease infinite;
  }
  @keyframes gradient{
    0%{
       background-position:0% 50%;
    }
     50%{
        background-position:100% 50%;
    }
     100%{
       background-position:0% 50%;
    }
  }
  a{
      margin-top:20px;
    padding:8px 10px;
    color:black;
    font-size:25px;
    text-decoration:none;
  }
a:hover{
  background-color:#e66465;
}
      </style>
</head>
<body>
   <nav>
    <a href="Admin.php? id1=1">Home</a>
    <a href="Admin.php? id1=2">User</a>
    <a href="Admin.php? id1=3">About</a>
    <?php
   
    if($_SESSION["user_nm"]=="Guest")
    {
?>
  <a href="Admin.php? id1=4">Log In</a>  
<?php
    }
    else{
  ?> 
        <a href="Admin.php?id1=5">Log Out</a>
        <?php
       
    }
   ?>  
    <a href="Admin.php?id1=7"> Teacher</a>
   
   </nav>  
</body>
</html>