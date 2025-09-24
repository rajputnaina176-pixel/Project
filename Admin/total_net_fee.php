<?php 
$k= trim($_POST['id']);
$s= trim($_POST['id5']);
$l= trim($_POST['id8']);
$conn1 = mysqli_connect("localhost","root","","database");
$sql1="select * from fee_sett where class_id = {$k} and st_Session = '{$s}'";
$result1 = mysqli_query($conn1,$sql1);
if(isset($_POST['id8']))
while($rows1 = mysqli_fetch_array ($result1)){
?> 
        <span> Total Net fee: <?php
       
          $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['Mis_fee']+$rows1['CM_fee']+$rows1['Exam_fee']+$l;
          echo $to;
          
          ?></span><span style="color: #313131ff; font-size: 10px;"> *Tuition Fee included </span>
          <?php }
?>