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
        input{
            height: 20px;
        }
        form{
            justify-content:center;
            gap: 10px;
            display: flex;
            border-radius: 20px;
            margin: auto;
            margin-top: 20px;
        }
        button{
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
        button:active{
            color:black;
            background-color:#ff9b9b;
        }
    </style>
</head>
<body>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <label for="user">Name: </label>
        <input type="text" name="user" required><br>
        <label for="email">Email: </label>
        <input type="email" name="email" required><br>
        <label for="contact">Contact: </label>
        <input type="number" name="contact" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" required><br>
        <label for="FILE">User Image: </label>
        <input type="file" name="FILE" id="FILE">
        <button name="submit" type="submit">Submit</button>
    </form>
    <div>
        <?php
            include_once("connection.php");
            $sql = "SELECT * FROM newdata";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>0){
        ?>
        <table width=75%>
            <tr>
            <th>User Image</th>
            <th>User Id</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Password</th>
            <th>Edit</th>
            <th>Delete</th></tr>
          <?php 
            while($row = mysqli_fetch_assoc($result))
            { 
                ?>//
                <tr>
                    <td><img src="<?php echo $row['image']; ?>" alt="User Image" width="100"></td>
                    <td><?php echo $row['Name'] ?></td>
                    <td><?php echo $row['Email'] ?></td>
                    <td><?php echo $row['Contact'] ?></td>
                    <td style="color:red !important"><?php echo $row['password'] ?></td>
                    <td><a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
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