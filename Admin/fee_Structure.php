<?php
$k= trim($_POST['id']);
$j= trim($_POST['id1']);

 $conn1= mysqli_connect("localhost","root","","database");
 $sql1 = "SELECT * FROM fee_sett where class_id ={$k} and st_session ='{$j}'";
$result1 = mysqli_query($conn1, $sql1);
while($rows1= mysqli_fetch_array ($result1)){
?>
<style>
  h2{
    font-size:15px;
    color:purple;
    text-align:center;
  }
  .form{
    height:1000px;
    border:1px solid red;
  }
  h3{
    font-size:10px;
    color:puprle;
    margin-top:10px;
  } 
  h4{
    font-size:15px;
    color:puprle;
  }
  .button3 {padding: 14px 40px;}
</style>
 
      <h2> FEE STRUCTURE</h2>
     <label> Form Fee : </label>
      <input type="text" name="Form_fee" value="<?php echo $rows1['Form_fee']?>"><br><br>
      <label>AD Fee  :  </label>
      <input type="text" name="AD_fee" value="<?php echo $rows1['AD_fee']?>"><br><br>
      <label> MIS Fee : </label>
      <input type="text" name="Mis_fee" value="<?php echo $rows1['Mis_fee']?>"><br><br>
      <label>CM Fee : </label>
      <input type="text" name="CM_fee" value="<?php echo $rows1['CM_fee']?>"><br><br>
      <label>Tuition Fee :  </label>
       <input type="text" name="Tu_fee" value="<?php echo $rows1['Tu_fee']?>"><br><br>
      <label> Exam Fee :  </label> 
      <input type="text" name="Exam_fee"value="<?php echo $rows1['Exam_fee']?>"><br><br>  
     <h3> Total Fee: <?php
       $tf = $rows1['Form_fee']+ $rows1['AD_fee']+ $rows1['Mis_fee'] + $rows1['CM_fee']+$rows1['Exam_fee'];
    echo $tf;  
      ?>  <p>Tuition fee not including;</p>
      </h3>  
    <label> Tuition fee:</label> 
     <select name="class_nm3" id="class_nm3" onchange="net_fee()">
  <option value="<?php echo $rows1['Tu_fee']?>">Monthly</option>
  <option value="<?php echo $rows1['Tu_fee']* 3?>"> Quartely</option>
  <option value="<?php echo $rows1['Tu_fee']*12?>">Yearly</option></select><br><br>
 
  <div id="net"></div>
 <button> Submit</button>
<?php } 
// echo $sql1;
?>