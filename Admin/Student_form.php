
<?php
session_start();
if(!isset($_SESSION['form_err']))
{
$_SESSION['form_err']="";
}
 $conn= mysqli_connect("localhost","root","","database");
 $sql1 = "SELECT s_reg_no FROM setting_tb_std";
 $result1= mysqli_query($conn, $sql1);
 while($rows1= mysqli_fetch_array ($result1)){
   $reg_no= $rows1['s_reg_no'];
 }
 $sql = "SELECT * FROM classes";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT distinct st_session FROM fee_sett";
$result2 = mysqli_query ($conn, $sql2);


?>
<html>
<head>
<title>Student Registration Form</title>
  <style>
.parent {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 8px;
}
h1{
   font-size:20px;
   color:purple;
   font-style:italic;
}
    
.div1 {
    grid-row: span 2 / span 2;
    border:1px solid red;
}

.div2{
  width:600px;
  border:1px solid red;
}
 .subject_name th {
 text-align:center;
 }
.div3 {
    grid-column-start: 2;
      width:600px;
       border:1px solid red;
}

</style>
   
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
   <script type="text/javascript">
    function class_sel(){
       var x= document.getElementById("class_nm1").value;
    var n = document.getElementById("class_nm2").value;
        $.ajax ({
        url:"show_class.php",
        method:"POST",
        data:{
            id:x
        },
        success:function(data){
            $("#ans").html(data);
        }
    });
       $.ajax ({
        url:"fee_Structure.php",
        method:"POST",
        data:{
            id:x,
            id1:n
        },
        success:function(data){
            $("#fees").html(data);
        }
    });

    }

    function net_fee(){
       var x= document.getElementById("class_nm1").value;
    var n = document.getElementById("class_nm2").value;
     var f = document.getElementById("class_nm3").value;

        $.ajax ({
        url:"total_net_fee.php",
        method:"POST",
        data:{
            id:x,id5:n,id8:f
        },
        success:function(data){
            $("#net").html(data);
        }
    });
  } 
  
  
  
    </script>
</head>
 
<body>
  <?php 
    if($_SESSION['form_err']!="" ){
        echo $_SESSION['form_err']; 
    }
    ?>
<form action="s_insert.php" method="POST" enctype="multipart/form-data">
<div class="parent">
   <div class="div1">
   
   <h1>STUDENT REGISTRATION FORM :</h1>
  <table > 
    <tr>
 <td><label for="rno">REGISTRATION NUMBER</label>
 <td><input type="text"  name="REG_NO"value="<?php
echo $reg_no +1; ?> " readonly="readonly"/><label for="sn"style="margin-left:10px;">Date:</label><input type="date" id="current-date-input" name="reg_date">

</td>
  </tr>
  <tr>
  <td>FIRST NAME</td>
  <td><input type="text" name="First_Name" maxlength="30"/>
  </td>
  </tr>
  

  <tr>
  <td>LAST NAME</td>
  <td><input type="text"  name="Last_Name" maxlength="30"/>
  </td>
  </tr>
  <tr>
    <tr>
  <td>FATHER NAME</td>
  <td><input type="text" name="Father_Name" maxlength="30"/>
  </td>
  </tr>
  

  <tr>
  <td>MOTHER NAME</td>
  <td><input type="text"  name="Mother_Name" maxlength="30"/>
  </td>
  </tr>
  <tr>
  <td>Class</td>
  
  <td>
  <select name="class_nm1" id ="class_nm1" onchange='class_sel()'>
      <?php while($rows= mysqli_fetch_array ($result)){
        ?>   
        <option value="<?php echo $rows ['class_id'];?>"> <?php  echo $rows['class_name'];?> </option>
        <?php
      }
  ?>
    </select>  
  </tr>
  <tr>
   <td>
    Session</td>
<td>
  <select name="ses_nm" id ="class_nm2"  onchange='class_sel()'>
      <?php while($rows= mysqli_fetch_array ($result2)){
        ?>   
        <option value="<?php echo $rows ['st_session'];?>"> <?php echo $rows['st_session'];?> </option>
        <?php
      }?>
    </td>
  </tr>
  <tr>
  <td>Section</td>
  
  <td>
  <select name="Section" id="class">
  <option value="-1">Section</option>
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  
  <option value="D">D</option>

  </tr>
  <tr>
  <td>DOB</td>
  <td>
  <select name="Birth_day">
  <option value="-1">Day:</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  
  <option value="31">31</option>
  </select>
  
  <select name="Birth_month" >
  <option value="-1">Month:</option>
  <option value="January">Jan</option>
  <option value="February">Feb</option>
  <option value="March">Mar</option>
  <option value="April">Apr</option>
  <option value="May">May</option>
  <option value="June">Jun</option>
  <option value="July">Jul</option>
  <option value="August">Aug</option>
  <option value="September">Sep</option>
  <option value="October">Oct</option>
  <option value="November">Nov</option>
  <option value="December">Dec</option>
  </select>
  
  <select name="Birth_year" >
  
  <option value="-1">Year:</option>
  <option value="2012">2012</option>
  <option value="2011">2011</option>
  <option value="2010">2010</option>
  <option value="2009">2009</option>
  <option value="2008">2008</option>
  <option value="2007">2007</option>
  <option value="2006">2006</option>
  <option value="2005">2005</option>
  <option value="2004">2004</option>
  <option value="2003">2003</option>
  <option value="2002">2002</option>
  <option value="2001">2001</option>
  <option value="2000">2000</option>
  </select>
  </td>
  </tr> 
   <tr>
  
  <td>EMAIL ID</td>
  <td><input type="text" name="Email_Id" maxlength="100" /></td>
  </tr>
 
  <tr>
  <td>MOBILE NUMBER</td>
  <td>
  <input type="text" name="Mobile_Number"  maxlength="10" />
  (10 digit number)
  </td>
  </tr>
  

  <tr>
  <td>GENDER</td>
  <td>
  Male <input type="radio"  name="Gender" value="Male" />
  Female <input type="radio"  name="Gender" value="Female" />
  </td>
  </tr>
  <tr>
  <td>SIBLING</td>
  <td>
  Brother <input type="radio"  name="Sibling" value="Brother" />
  Sister <input type="radio"  name="Sibling" value="Sister" />
None <input type="radio"  name="Sibling" value="None" />
  </td>
  </tr><tr>
  <td>SIBLING DESCRPTION <br /><br /><br /></td>
  <td><textarea name="Sibling_Des" rows="4" cols="20"></textarea></td>
  </tr>
  <tr>
  <td>ADDRESS <br /><br /><br /></td>
  <td><textarea name="Address" rows="4" cols="20"></textarea></td>
  </tr>

  <tr>
  <td>CITY</td>
  <td><input type="text" name="City"  />

  </td>
  </tr>
  
  <tr>
  <td>PIN CODE</td>
  <td><input type="text" name="Pin_Code" />
  (6 digit number)
  </td>
  </tr>

  <tr>
  <td>STATE</td>
  <td><input type="text" name="State">
  (max 30 characters a-z and A-Z)
  </td>
  </tr>

  <tr>
  <td>COUNTRY</td>
  <td><input type="text" name="Country" value="India" style="font-size:18px;"class-"input"  readonly="readonly" /></td>
  </tr>
   <tr> 
    <td>
      <label for="fileupload" class="custom-file-button">Upload image </label>
      <br><br>
      <input type="file" name="fileupload" id="fileupload"  class-"input" class="file_up" value="fileupload" accept="images/*" onchange="upload(event)"> <br>
      <div id="imagePreviewContainer">
          <img id ="previewImage" src="#" alt="Image Preview" style="Display:none;max-width:80px;max-height:100px;">
      </div>
    </td>
   </tr>  
</table>
</div>
<div class="div2">
   <div class="subject_name">
    <table>
 <thread>
        <th>SUBJECT NAME </th>
</thread>
<tbody id="ans">  </tbody>

</table></div>
</div>
 <div id="fees" class="div3">
  <div>
<h4 > FEE STRUCTURE </h4>
<p> Select Class!...</p> 

    </div>
 </div>
  
    </div>                                                              

    </form>
  <script src="preview.js"> </script>
  <script>
      document.addEventtListener('DOMContentLoaded', (event) =>
    {
      const dateInput = document.getElementById("current-date-input");
      const today= new Date().toISOSrting().split('T')[0];

      dateInput.value = today;
    });
        
    
    </script>
  
</body>
</html>    
