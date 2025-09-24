<?php
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
        if(isset($_SESSION['user_nm']))
        {
            echo "<h2> User:".$_SESSION['user_nm'];
        }
    ?>
    <nav>
        <a href="admin_index.php?id=1"> HOME</a>
        <a href="admin_index.php?id=2"> USER</a>
        <a href="admin_index.php?id=3"> ABOUT</a>
        <?php
            if($_SESSION["user_nm"]=="Guest"){
        ?>
        <a href="admin_index.php?id=4"> LOGIN</a>
        <?php
            }
            else
            {
            ?>
        <a href="admin_index.php?id=5"> LOGOUT</a>
          <?php 
            }
            ?>      
    </nav>
</body>
</html>