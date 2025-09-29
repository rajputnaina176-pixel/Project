   <?php
   $k= trim($_POST['id']);
    $conn= mysqli_connect("localhost","root","","database");
    $sql ="SELECT * FROM students Where S_REG_NUM like'{$k}' or First_Name like '{$k}%'or class_nm1 like '{$k}%' or Father_name like '{$k}%' ";
$result1 = mysqli_query($conn, $sql);
while($row= mysqli_fetch_array ($result1)){
?>
    <tr style="text-align:center;">
                    
                    <td><?php echo $row['S_REG_NUM'] ?></td>
                    <td><?php echo $row['First_Name'] ?></td>
                     <td><?php echo $row['class_nm1']." ".$row['Section'] ?></td>
                    <td><?php echo $row['Father_Name'] ?></td>
                     <td><?php echo $row['Birth_day']. "-" .$row['Birth_month']."-".$row['Birth_year']?></td>
                    <td><a href="Admin.php?id1=6&id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="Delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
                     <td><a href="filter.php?reg_num=<?php echo $row['S_REG_NUM']; ?>">View</a></td>
                        <td><a href="Student_information.php?re=<?php echo $row['S_REG_NUM']; ?>">View</a></td>
                </tr>
 <?php } 
// echo $sql1;
?>


