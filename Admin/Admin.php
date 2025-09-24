<?php

  error_reporting(1);
 session_start();


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
</head>
<body>
  <?php
    include("Header.php");
    ?>
    <?php
    if($_GET['id1']==1){
        include("Homepage.php");  
    }
      else if($_GET['id1']==2){
         include("form.php");
      }
       else if($_GET['id1']==3){
        include("About.php");
        }
        else if($_GET['id1']==4){
            header("Location: login.php");
          
        }
         else if($_GET['id1']==5){
            header("Location:logout.php");
         }
            else if($_GET['id1']==6){

            include("Edit1.php");
           
        } else if($_GET['id1']==7){

            header("Location:Teacher.php");
          }
        
        else{
        include("Homepage.php");  
      }
    
    
    
    
    ?>
</body>
</html>