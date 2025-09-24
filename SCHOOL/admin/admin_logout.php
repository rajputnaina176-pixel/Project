<?php
    session_start();

  $_SESSION['user_nm']="Guest";
    header("Location:admin_index.php?id=1");
?>