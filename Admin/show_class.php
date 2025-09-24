<?php
$k= trim($_POST['id']);
 $conn1= mysqli_connect("localhost","root","","database");
 $sql1 = "SELECT distinct  t3.subject_name FROM class_subjects AS t1 INNER JOIN classes AS t2 ON t1.class_id = t2.class_id INNER JOIN subjects AS t3 ON t1.subject_id = t3.subject_id and t2.class_id={$k};";
$result1 = mysqli_query($conn1, $sql1);
while($rows1= mysqli_fetch_array ($result1)){
?>
<tr>
    <td><?php  echo $rows1['subject_name']; ?> </td>
</tr>
<?php } 
// echo $sql1;
?>