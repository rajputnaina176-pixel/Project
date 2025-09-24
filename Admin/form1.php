<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <style>
        img{
            border-radius: 10px;
        }
        th,td{
            padding: 10px;
            border: 1px solid green;
            text-align: center;
        }

        th{
            color:#006035 !important;
        }
        td{
            color:black;
        }
        table{
            margin: auto;
            margin-top: 20px;
            padding: 50px;
            border-collapse: collapse;
        }
        body{
            background-color: white;
            color: green;
            font-family: Arial;
        }
        label{
            margin-top:8px;
            font-size:20px;
        }
        input{
            height: 20px;
            background-color:transparent;
            border-radius:10px;
            padding:5px 8px;
        }
        form{
            justify-content:center;
            gap: 10px;
            display: flex;
            border-radius: 20px;
            margin: auto;
            margin-top: 50px;
        }
        button{
            background-color:green;
            color: white;
             font-size:20px;    
            height: 30px;
            width: 80px;
        }
        
    </style>
</head>
<body>
    <form action="Admin.php" method="post" enctype="multipart/form-data">
        <label for="user">Name: </label>
        <input type="text" name="user" required><br>
        <label for="email">Email: </label>
        <input type="email" name="email" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" required><br>
    
        <button name="submit" type="submit">Submit</button>
    </form>
    <div>
        <?php
            include_once("conn.php");
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
        ?>
        <table width=75%>
            <tr>
    
            <th>User Id</th>
            <th>Email</th>
            <th>Password</th>
            <th>Edit</th>
            <th>Delete</th></tr>
          <?php 
            while($row = mysqli_fetch_assoc($result))
            { 
                ?>
                <tr>
                    
                    <td><?php echo $row['Username'] ?></td>
                    <td><?php echo $row['Email'] ?></td>
                    <td style="color:black !important"><?php echo $row['Password1'] ?></td>
                    <td><a href="Admin.php?id1=6&id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="Delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
                </tr>
                <?php
                }
            ?>
            </table>
            <?php
        }
       else{
            echo "Record Is Not Exist";
       }
        ?>
        </div>
</body>
</html>
