<?php
session_start();
include("conn.php"); // Include your DB connection file

if(isset($_POST['submit'])) {
    $username = ($_POST['username']);
    $password = $_POST['password'];
$sql = "SELECT * FROM user WHERE Username ='".$username."'";
//echo $sql;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)){
       if ($password == $row['Password1']) {
            $_SESSION["user_nm"] = $username;
         header("Location: Admin.php?id=" . urlencode($username));
        
        } else {
          
            $_SESSION["user_nm"] = "Guest";
            $error = "Invalid username or password";
            header("Location: login.php?error=" . urlencode($error));
            
        }
    }


} else {
  
    $_SESSION["user_nm"] = "Guest";
        $error = "Invalid username or password";
        header("Location: login.php?error=" . urlencode($error));
    


}

mysqli_close($conn);

}
?>
