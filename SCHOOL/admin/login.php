<?php
$message = "";
if (isset($_GET['reply'])) {
    $message = $_GET['reply'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            background-color: white;
            color: green;
            font-family: Arial;
        }
        h1{ 
            margin-top: 100px;
            text-align: Center;
        }
        form{
            justify-content: center;
            border: 6px solid green;
            border-radius: 20px;
            width: 20%;
            margin: auto;
            margin-top: 20px;
            padding: 50px;
        }
        input{
            margin: 5px;
        }
        button{
            margin-top: 20px;
            background-color: white;
            color: green;
            border: 1px solid green;
            height: 30px;
            width: 60px;
        }
        button:hover{
            color:black;
            background-color: red;
        }
        a{
            color: black;
            text-decoration: none;
        }
        button:active{
            color:black;
            background-color:#ff9b9b;
        }
    </style>
</head>
<body>
    <h1>LOGIN</h1>
    <form action="admin_index.php" method="post">
        <label for="user">Name:  </label>
        <input type="text" name="user" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" required><br>
        <button name="submit">Submit</button>
        <p><?php echo $message; ?></p>
    </form>
</body>
</html>