
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --background-color: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            background-color: var(--background-color);
            min-height: 100vh;
            padding-bottom: 2rem;
        }

        .main-header {
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card {
            background: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            color: #0d6efd;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-submit {
            padding: 0.5rem 2rem;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 1rem;
            margin-top: 2rem;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .alert {
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }

            .page-header {
                padding: 1.5rem 0;
            }

            .btn-submit {
                width: 100%;
            }
        }
    </style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --background-color: #f1f5f9;
            --card-background: #ffffff;
            --text-color: #1e293b;
            --border-color: #e2e8f0;
            --input-background: #f8fafc;
            --error-color: #ef4444;
            --success-color: #22c55e;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
        }

        .page-wrapper {
            padding: 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--card-background);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .form-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .form-content {
            padding: 2rem;
        }

        /* Form Grid Layout */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-section {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        /* Labels */
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-size: 0.875rem;
        }

        /* Form Controls */
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            background: var(--input-background);
            color: var(--text-color);
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Select Controls */
        select.form-control {
            cursor: pointer;
            padding-right: 2rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .alert-error {
            background-color: #fef2f2;
            color: var(--error-color);
            border: 1px solid #fee2e2;
        }

        .alert-success {
            background-color: #f0fdf4;
            color: var(--success-color);
            border: 1px solid #dcfce7;
        }

        /* Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 1.5rem 0;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        th {
            background: var(--input-background);
            padding: 1rem;
            font-weight: 600;
            color: var(--text-color);
            border-bottom: 2px solid var(--border-color);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: top;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .form-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 0.5rem;
            }

            .container {
                border-radius: 0.5rem;
            }

            .form-header {
                padding: 1rem;
            }

            .form-content {
                padding: 1rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .form-section {
                padding: 1rem;
            }

            .btn {
                width: 100%;
            }

            .form-actions {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .page-wrapper {
                padding: 0;
            }

            .container {
                border-radius: 0;
            }

            .form-header h1 {
                font-size: 1.25rem;
            }

            td, th {
                padding: 0.75rem;
                font-size: 0.75rem;
            }
        }

        /* Print Styles */
        @media print {
            .page-wrapper {
                padding: 0;
            }

            .container {
                box-shadow: none;
            }

            .form-actions {
                display: none;
            }
        }
</style>

        h1, h2 {
            color: #1a73e8;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* Form styles */
        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .form-section {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c3e50;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #1a73e8;
            outline: none;
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
            background-color: #fff;
        }

        /* Button styles */
        button,
        input[type="submit"] {
            background-color: #1a73e8;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: #1557b0;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Table styles */
        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #1a73e8;
            color: white;
            font-weight: 500;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f0f7ff;
        }

        /* Alert messages */
        .alert {
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #dcfce7;
        }

        /* Responsive design */
        @media screen and (max-width: 1024px) {
            .container {
                padding: 15px;
            }

            form {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            h1, h2 {
                font-size: 20px;
                margin-bottom: 20px;
            }

            .form-section {
                padding: 15px;
            }

            input[type="text"],
            input[type="number"],
            input[type="date"],
            select {
                padding: 10px;
                font-size: 14px;
            }

            button,
            input[type="submit"] {
                width: 100%;
                padding: 12px;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 5px;
            }

            .container {
                padding: 10px;
            }

            .table-wrapper {
                margin-top: 15px;
            }

            th, td {
                padding: 8px 10px;
                font-size: 14px;
            }
        }
</style>
   
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
    <div class="container">
        <h1>Student Registration Form</h1>
        
        <?php 
        if($_SESSION['form_err']!="" ){
            echo '<div class="alert alert-error">' . $_SESSION['form_err'] . '</div>'; 
        }
        ?>
        
        <form action="s_insert.php" method="POST" enctype="multipart/form-data" class="registration-container">
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
