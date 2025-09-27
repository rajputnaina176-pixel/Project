 <?php
$reg_num = $_GET['re'];
$conn1 = mysqli_connect("localhost","root","","database");
$sql1="SELECT * from students where S_REG_NUM = $reg_num";
$result1 = mysqli_query($conn1,$sql1);
$rows1 = mysqli_fetch_array($result1);
$FN = $rows1["First_Name"];
$LN = $rows1["Last_Name"];
$sec = $rows1["Section"];
$class = $rows1["class_nm1"];
$st= $rows1["st_session"];  
$sql2="SELECT class_id from classes where class_name = '$class'";
$result2 = mysqli_query($conn1,$sql2);
$rows2 = mysqli_fetch_array($result2);
$class_id = $rows2['class_id'];
$sql3="SELECT * from fee_sett where class_id = {$class_id} and st_session = '{$st}'";
$result3 = mysqli_query($conn1,$sql3);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width='device-width', initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <title>Document</title>
  <style>
    button{
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      width:20%!important;
 height: 40px!important;
      font-size: 16px;
    }
  </style>
  <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <script>
    function net_fee(){
      var x = <?php echo $class_id ?>;
      var h = '<?php echo $st?>';
      var d = document.getElementById("class_nm3").value;
      var n = document.getElementById("discount_am").value;
      $.ajax({
      url: "total_net_fee1.php",
      method: "POST",
      data: {
        id:x,
        id1:h,
        id2:d,
        id3:n
      },
      success:function(data){
        $("#net_f").html(data);
      }
    });
    }
  </script>
  <style>
   .form-control{
    width:20%;
   }

  </style>
</head>
<body>
<form class="row g-3 needs-validation"  action="sinsert_transec11.php" method="post" >
  <?php
  while($rows3 = mysqli_fetch_array ($result3)){
?> 
<div>

  <h1> STUDENT INFORMATION</h1>
  <div >
    <input type="hidden"  name="re" value="<?php echo $reg_num ?> ">
    <label for="validationCustom01" class="form-label">Student Name :</label>
    <input type="text" class="form-control" id="validationCustom01" value="<?php echo $FN?>" required> <label for="validationCustomUsername" class="form-label">Class Name :</label>
      <input type="text" class="form-control" id="student" value="<?php echo $sec?>">
    
  </div>
         <div>
          <p class="fee_p">Fee Structure :</p>
          <label for="form_fee">Form Fee:</label>
          <input style="margin-left: 0px; width: 150px;" name="form_fee" type="text" value="<?php echo $rows3['Form_fee']?>"><br>
          <label for="ad_fee">Admission Fee:</label>
          <input style="margin-left: 0px; width: 130px;" name="ad_fee" type="text" value="<?php echo $rows3['AD_fee']?>"><br>
          <label for="ms_chg">Miscellaneous Charges:</label>
          <input style="margin-left: 0px; width: 150px;" name="ms_chg" type="text" value="<?php echo $rows3['Mis_fee']?>"><br>
          <label for="cm">Caution Money:</label>
          <input style="margin-left: 0px; width: 150px;" name="cm" type="text" value="<?php echo $rows3['CM_fee']?>"><br>
          <label for="e_fee">Exam Fee:</label>
          <input style="margin-left: 0px; width: 150px;" name="e_fee" type="text" value="<?php echo $rows3['Exam_fee']?>"><br>
          <label for="t_fee">Tuition Fee:</label>
          <input type="hidden" name="Tu_fee" id=" Tu_fee"value="<?php echo $rows3['Tu_fee']?> ">
        <select name="class_nm3" id="class_nm3" onchange="net_fee()">
        <option value="<?php echo $rows3['Tu_fee']?>"> Monthly</option>
        <option value="<?php echo $rows3['Tu_fee']*3?>">Quarterly</option>
        <option value="<?php echo $rows3['Tu_fee']*12?>">Yearly</option>
        </select><br>
        <label for="for_mon">For Month:</label>
       <input type=" text" name="for_mon" placeholder="Month e.g">
       <input type="text" name="des_fee"  placeholder="Description (optional)">
      </div>
         <div id="net_f"></div>
        
      </div>    
<?php }
?>
  <div>
    <label for="discount_am">Discount</label>
    <select name="discount_am" id="discount_am" onchange="net_fee()">
      <option> None (0%) </option>
      <option value="10"> Sibling Discount (10%)  </option>
      <option value="15">  Staff Child (15%)  </option>
      
  </select>
  </div>
  <button>SUBMIT </button>
  </form>

</body>


