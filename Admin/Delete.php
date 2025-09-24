<?php
include("conn.php");

$id = $_GET['id'];
$sql1 = "DELETE FROM user WHERE ID=$id";
mysqli_query($conn, $sql1);

header("Location: admin.php?id1=2");
?>