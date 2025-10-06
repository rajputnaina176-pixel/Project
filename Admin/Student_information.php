
<?php
session_start();
if(!isset($_SESSION['form_err']))
{
$_SESSION['form_err']="";
}
 $conn= mysqli_connect("localhost","root","","database");
 $sql1 = "SELECT * FROM students where S_REG_NUM= {$_GET['re']}";
 $result1= mysqli_query($conn, $sql1);

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student INFFORMATION</title>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
  <script>
  function pic(event) {
    const files =event.target.files[0];
    const preview = document.getElementById('previewImage');
    const container = document.getElementById('imagePreviewContainer');

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; 
        }
        
        reader.readAsDataURL(files); 
    } 
}
  </script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 20px;
    }

    .form-container {
      max-width: 1200px;
      margin: auto;
      background-color: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
    }

    h1 {
      grid-column: span 2;
      text-align: center;
      color: #6a1b9a;
      margin-bottom: 30px;
      font-style: italic;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="file"],
    select,
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[readonly] {
      background-color: #f2f2f2;
    }

    textarea {
      resize: vertical;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .section {
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #fafafa;
    }

    .radio-group, .checkbox-group {
      display: flex;
      gap: 20px;
      margin-top: 5px;
    }

    .section-title {
      font-size: 18px;
      color: #333;
      margin-bottom: 15px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
    }

    .full-width {
      grid-column: span 2;
    }

    img#previewImage {
      display: none;
      margin-top: 10px;
      max-width: 100px;
      max-height: 100px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table th, table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    button {
      padding: 10px 20px;
      background-color: #6a1b9a;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #4a148c;
    }

    @media (max-width: 768px) {
      .form-container {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <form class="form-container">

    <h1>Student Registration Form</h1>

<?php
while($rows= mysqli_fetch_array ($result1)){?>
    <!-- Left Section -->
    <div class="section">
      <div class="section-title">Personal Details</div>

      <div class="form-group">
        <label>Registration Number</label>
       <input type="text"  name="REG_NO"value="<?php echo $rows['S_REG_NUM']?> "readonly="readonly"/>
      </div>

      <div class="form-group">
        <label>Registration Date</label>
        <input type="date" name="reg_date" value="<?php echo $rows['reg_date'] ?>" readonly="readonly"/>
      </div>

      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="<?php echo $rows['First_Name']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="<?php echo $rows['Last_Name']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Father's Name</label>
        <input type="text" name="father_name" value="<?php echo $rows['Father_Name']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Mother's Name</label>
        <input type="text" name="mother_name" value="<?php echo $rows['Mother_Name']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Date of Birth</label>
        <div style="display: flex; gap: 10px;">
          <input type="text" name="Birth_day " value="<?php echo $rows['Birth_day'] ?>" style="width: 60px;" readonly="readonly"/>
          <input type="text" name="Birth_month" value="<?php echo $rows['Birth_month'] ?>" style="width: 60px;" readonly="readonly"/>
          <input type="text" name="Birth_year" value="<?php echo $rows['Birth_year'] ?>" style="width: 80px;" readonly="readonly"/>
      
       
        </div>
      </div>

      <div class="form-group">
        <label>Gender</label>
        <input type="text" name="gender" value="<?php echo $rows['Gender']?>"readonly="readonly"/>
  
      </div>

      <div class="form-group">
        <label>Email ID</label>
        <input type="email" name="email"  value="<?php echo $rows['Email_Id']?>" maxlength="50"readonly="readonly">
      </div>

      <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobile"value="<?php echo $rows['Mobile_Number']?>" maxlength="10 "readonly="readonly">
      </div>

     <div class="form-group">
    <label>Upload Image</label>
    
    <?php
        // Check if there is an image filename in the database
        $imagePath = !empty($rows['std_pic']) ? "../". htmlspecialchars($rows['std_pic']) : '';
    ?>

  
    <div id="imagePreviewContainer">
        <img id="previewImage" 
             src="<?php echo $imagePath; ?>" 
             alt="Student Image" 
             style="display: <?php echo !empty($imagePath) ? 'block' : 'none'; ?>; max-width:100px; max-height:100px;">
    </div>
</div>
    </div>

    <!-- Right Section -->
    <div class="section">
      <div class="section-title">Academic Details

      </div>

      <div class="form-group">
        <label>Class</label>
        <input type="text" name="class" value="<?php echo $rows['class_nm1']?>" readonly>
       
      </div>

      <div class="form-group">
        <label>Session</label>
         <input type="text" name="session" value="<?php echo $rows['st_session']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Section</label>
        <input type="text" name="section" value="<?php echo $rows['Section']?>" readonly="readonly">

      </div>

      <div class="form-group">
        <label>Sibling</label>
         <input type="text" name="sibling" value="<?php echo$rows['Sibling']?>">
    
  </div>
      <div class="form-group">
        <label>Sibling Description</label>
        <input type="text" name="sibling_des" value="<?php echo $rows['Sibling_Des']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Address</label>
        <textarea name="address" rows="3" readonly><?php echo $rows['Address'] ?></textarea>
      </div>

      <div class="form-group">
        <label>City</label>
        <input type="text" name="city"value="<?php echo $rows['City']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Pin Code</label>
        <input type="text" name="pin_code" value="<?php echo $rows['Pin_Code']?>"readonly="readonly"  maxlength="6">
      </div>

      <div class="form-group">
        <label>State</label>
        <input type="text" name="state" value="<?php echo $rows['State']?>" readonly="readonly">
      </div>

      <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" value="India" readonly>
      </div>
    </div>

    <?php } ?>
  </form>
</body>
</html>