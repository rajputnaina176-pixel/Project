<?php
include("conn.php");
error_reporting(0);

    $id = $_POST['id'];
    $user = $_POST['name']; // matches input name="name"
    $email = $_POST['email'];
    $password = $_POST['password']; // only if plain password is entered

    // Prepare and execute update
   $sql = "UPDATE user SET Username='$user',Password1='$password',Email='$email' WHERE id=".$id;
echo $sql;
if (mysqli_query($conn, $sql)) {
  header("Location: Admin.php?id=5");
} else {
  header("Location: Admin.php?id=6&e=1");
}

mysqli_close($conn);
    // Optional: Redirect or confirmation
   // 
    //exit();

?>

