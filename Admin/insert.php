<?php
include("conn.php");
if (isset($_POST['submit'])){
$User= $_POST['user'];
$Pass= $_POST['password'];
$Email= $_POST['email'];
// echo $User.$Pass.$Email;
$sql1 = "INSERT INTO user (Username ,Password1, Email) VALUES('$User', '$Pass', '$Email')";
}
if (mysqli_query($conn, $sql1)) {
  echo "New record created successfully";
  header("location:form.php");
}
else {
  echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}
 header("location:Teacher.php");
?> 