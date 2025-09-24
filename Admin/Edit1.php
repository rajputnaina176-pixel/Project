<?php
include("conn.php");

    $id = $_GET['id'];
    $sql1 = "SELECT * FROM user WHERE id =".$id;

    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
  // output data of each row
  $row1 = mysqli_fetch_assoc($result1);
 
?>
 <style>
     form{
            justify-content:center;
            gap: 10px;
            display: flex;
            border-radius: 20px;
            margin: auto;
            margin-top: 80px;
        }
        label{
            margin-top:10px;
            color:green;
        }
        input{
                
            height: 20px;
            background-color:transparent;
            border-radius:10px;
            padding:5px 8px;
       
        }
        button{
            background-color:green;
            color: white;
             font-size:20px;    
            height: 30px;
            width: 80px;
        }
        table{
            margin: auto;
            margin-top: 20px;
            padding: 50px;
            border-collapse: collapse;
        }
        th,td{
            padding: 10px;
            border: 1px solid green;
            text-align: center;
        }

        th{
            color:green;
        }
        td{
            color:black;
        }
 </style>

<form  action="Edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
    <label for="user">Name: </label>
    <input type="text" name="name" value="<?php echo $row1['Username']; ?>"><br>
      <label for="password">Password: </label>
       <input type="text" name="password" value="<?php echo $row1['Password1']; ?>"><br>
   <label for="email">Email: </label>
   <input type="text" name="email" value="<?php echo $row1['Email']; ?>"><br>
   
    
        <button name="submit" type="submit">Submit</button>
</form>
<div>
        <?php
    }
            include_once("conn.php");
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) 
            {
            
        ?>
 

                <table border="1" width="75%" >
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
                <td><?php echo $row['Username']; ?></td>
                <td><?php echo $row['Password1']; ?></td>
                <td><?php echo $row['Email']; ?></td>
               <td><a href="Edit1.php?id1=6&id=<?php echo $row['id']; ?>">Edit</a></td>
               <td><a href="Delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
            </tr>
            <?php 
               if($_GET['e']==1)
               {
                echo "Not Updated";
               }
            
        } 
            ?>

        </table>
        <?php
            }
            else
            {
                echo "Record is not Exist....";
            }
        ?>
        
    </div>