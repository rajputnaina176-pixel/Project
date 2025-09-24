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
            width: 150px
        }
        form{
            justify-content:center;
            gap: 10px;
            width: 500px;
            display: flex;
            border-radius: 20px;
            margin: auto;
            padding: 100px;
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
</div>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <label for="user">username: </label>
        <input type="text" username="user" required><br>
        <label for="email">Email: </label>
        <input type="email" username="email" required><br>
        <label for="password">Password: </label>
        <input type="password" username="password" required><br>
        <label for="privilege">Privilege</label>
        <select name="privilege" id="privilege" required>
            <option value="Teacher">Teacher</option>
            <option value="student">Student</option>
        </select>
        <button username="submit" type="submit">Submit</button>
    </form>
    <div>
        <?php
            include_once("connection.php");
            $sql = "SELECT * FROM users";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res)>0){
        ?>
        <table width=75%>
            <tr>
            <th>User Id</th>
            <th>Email</th>
            <th>Password</th>
            <th>Privilege</th>
            <th>Edit</th>
            <th>Delete</th></tr>
            <?php 
            while($ro = mysqli_fetch_assoc($res))
            { 
                ?>
                <tr>
                    <td><?php echo $ro['username'] ?></td>
                    <td><?php echo $ro['email'] ?></td>
                    <td style="color:red !important"><?php echo $ro['password'] ?></td>
                    <td style="color:magenta !important"><?php echo $ro['privilege'] ?></td>
                    <td><a href="edit.php?id=<?php echo $ro['id']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $ro['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
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