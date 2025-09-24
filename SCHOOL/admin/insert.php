<?php
include("connection.php");
$target_dir = "files/";
$target_file = $target_dir . baseusername($_FILES["FILE"]["username"]);
$uploadOK = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["FILE"]["tmp_username"]);
  if($check !== false) {
    echo "File is image - " . $check["mime"] . "." ."<br>";
    $uploadOk = 1;
  } else {
    echo "File is not image."."<br>";
    $uploadOk = 0;
  }
}
if (file_exists($target_file)) {
  if (move_uploaded_file($_FILES["FILE"]["tmp_username"], $target_file)) {
    echo "File ". htmlspecialchars( baseusername( $_FILES["FILE"]["username"])). " uploaded."."<br>";
  } else {
    echo "Error!!"."<br>";
  }
}
if ($_FILES["FILE"]["size"] > 500000) {
  echo "File Is Too Large !!"."<br>";
  $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "only JPEG , JPG, PNG & GIF allowed!!"."<br>";
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Your file has not uploaded!!"."<br>";
} else {
  if (move_uploaded_file($_FILES["FILE"]["tmp_username"], $target_file)) {
    echo "File ". htmlspecialchars( baseusername( $_FILES["FILE"]["username"])). " uploaded."."<br>";
  }
}
 $uid = $_POST['user'];
 $em = $_POST['email'];
 $ph = $_POST['contact'];
 $pa = $_POST['password'];
 $sql = "INSERT INTO school (username, Email, Contact, password, image)
VALUES ('$uid', '$em', '$ph', '$pa', '$target_file')";
if (mysqli_query($conn, $sql)) {
  header("location:form.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>