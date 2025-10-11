<?php
session_start();
if (!isset($_SESSION['form_err'])) {
    $_SESSION['form_err'] = "";
}
$reg = $_GET['re'];
$conn = mysqli_connect("localhost", "root", "", "database");
$sql1 = "SELECT * FROM students where S_REG_NUM = $reg";
$result1 = mysqli_query($conn, $sql1);
// echo mysqli_error($conn);
// echo $sql1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student INFORMATION UPDATE</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
    function pic(event) {
      const file = event.target.files[0];
      const preview = document.getElementById('previewImage');

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
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
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
      box-sizing: border-box;
    }
    input[readonly] {
      background-color: #f2f2f2;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .section {
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .section-title {
      font-size: 18px;
      margin-bottom: 15px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
    }
    img#previewImage {
      margin-top: 10px;
      max-width: 100px;
      max-height: 100px;
      border: 1px solid #ddd;
      padding: 4px;
      border-radius: 4px;
    }
    button {
      padding: 10px 20px;
      background-color: #6a1b9a;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      grid-column: span 2;
      justify-self: center;
    }
    @media (max-width: 768px) {
      .form-container {
        grid-template-columns: 1fr;
      }
       button {
        grid-column: 1;
       }
    }
  </style>
</head>
<body>

  <form class="form-container" action="Student_update.php?re=<?php echo $reg; ?>" method="post" enctype="multipart/form-data">
    <h1>Student Registration Form</h1>

    <?php while ($rows = mysqli_fetch_array($result1)) { ?>
      <div class="section">
        <div class="section-title">Personal Details</div>

        <div class="form-group">
          <label>Registration Number</label>
          <input type="text" name="REG_NO" value="<?php echo $rows['S_REG_NUM'] ?>" readonly/>
        </div>

        <div class="form-group">
          <label>Registration Date</label>
          <input type="date" name="reg_date" value="<?php echo $rows['reg_date'] ?>" />
        </div>

        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="First_Name" value="<?php echo $rows['First_Name'] ?>">
        </div>

        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="Last_Name" value="<?php echo $rows['Last_Name'] ?>">
        </div>

        <div class="form-group">
          <label>Father's Name</label>
          <input type="text" name="Father_Name" value="<?php echo $rows['Father_Name'] ?>">
        </div>

        <div class="form-group">
          <label>Mother's Name</label>
          <input type="text" name="Mother_Name" value="<?php echo $rows['Mother_Name'] ?>">
        </div>

        <div class="form-group">
          <label>Date of Birth</label>
          <div style="display: flex; gap: 10px;">
            <input type="text" name="Birth_day" value="<?php echo $rows['Birth_day'] ?>" style="width: 60px;" />
            <input type="text" name="Birth_month" value="<?php echo $rows['Birth_month'] ?>" style="width: 60px;" />
            <input type="text" name="Birth_year" value="<?php echo $rows['Birth_year'] ?>" style="width: 80px;" />
          </div>
        </div>

        <div class="form-group">
          <label>Gender</label>
          <input type="text" name="Gender" value="<?php echo $rows['Gender'] ?>" />
        </div>

        <div class="form-group">
          <label>Email ID</label>
          <input type="email" name="Email_Id" value="<?php echo $rows['Email_Id'] ?>">
        </div>

        <div class="form-group">
          <label>Mobile Number</label>
          <input type="text" name="Mobile_Number" value="<?php echo $rows['Mobile_Number'] ?>">
        </div>

        <div class="form-group">
          <label>Upload New Image</label>
          <input type="file" name="fileupload" onchange="pic(event)">
          <?php $imagePath = !empty($rows['std_pic']) ? "../" . htmlspecialchars($rows['std_pic']) : ''; ?>
          <div>
            <p>Current Image:</p>
            <img id="previewImage" src="<?php echo $imagePath; ?>" alt="Student Image" style="display: <?php echo !empty($imagePath) ? 'block' : 'none'; ?>;">
          </div>
        </div>
      </div>

      <div class="section">
        <div class="section-title">Academic & Address Details</div>

        <div class="form-group">
          <label>Class</label>
           <input type="text" name="class_nm1" value="<?php echo $rows['class_nm1'] ?>">
        </div>

        <div class="form-group">
          <label>Session</label>
          <input type="text" name="ses_nm" value="<?php echo $rows['st_session'] ?>">
        </div>

        <div class="form-group">
          <label>Section</label>
          <input type="text" name="Section" value="<?php echo $rows['Section'] ?>">
        </div>

        <div class="form-group">
          <label>Sibling</label>
          <input type="text" name="Sibling" value="<?php echo $rows['Sibling'] ?>">
        </div>
        <div class="form-group">
          <label>Sibling Description</label>
          <input type="text" name="Sibling_Des" value="<?php echo $rows['Sibling_Des'] ?>">
        </div>

        <div class="form-group">
          <label>Address</label>
          <textarea name="Address" rows="3"><?php echo $rows['Address'] ?></textarea>
        </div>

        <div class="form-group">
          <label>City</label>
          <input type="text" name="City" value="<?php echo $rows['City'] ?>">
        </div>

        <div class="form-group">
          <label>Pin Code</label>
          <input type="text" name="Pin_Code" value="<?php echo $rows['Pin_Code'] ?>">
        </div>

        <div class="form-group">
          <label>State</label>
          <input type="text" name="State" value="<?php echo $rows['State'] ?>">
        </div>

        <div class="form-group">
          <label>Country</label>
          <input type="text" name="Country" value="India">
        </div>
      </div>
    <?php } ?>
    
    <input type="hidden" name="Form_fee" value="0">
    <input type="hidden" name="AD_fee" value="0">
    <input type="hidden" name="Mis_fee" value="0">
    <input type="hidden" name="CM_fee" value="0">
    <input type="hidden" name="Exam_fee" value="0">
    
    <button type="submit">Update Student</button>
  </form>
</body>
</html>