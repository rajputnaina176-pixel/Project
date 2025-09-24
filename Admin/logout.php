<?php
session_start();
$_SESSION['user_nm']="Guest";
header("location:Admin.php?id=1");
print("ok");
?>