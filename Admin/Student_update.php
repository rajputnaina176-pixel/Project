<?php
session_start();
include("conn.php"); // Assuming this file establishes $conn

// Use the registration number from the URL, which is more secure
$rg = $_GET['re'];

// File upload handling
$uploadOk = 1;
$pic_nm = ''; // Initialize pic_nm variable

// Check if a file was actually uploaded before processing
if (isset($_FILES["fileupload"]) && $_FILES["fileupload"]["error"] == 0) {
    $target_dir = "../std_pic/";
    $fileType = strtolower(pathinfo(basename($_FILES["fileupload"]["name"]), PATHINFO_EXTENSION));
    
    // Construct a new, unique filename using the registration number
    $pic_nm = $target_dir . trim($rg) . "." . $fileType;

    $allowed_types = ['jpg', 'png', 'gif', 'jpeg'];
    if (!in_array($fileType, $allowed_types)) {
        $_SESSION['form_err'] = "Sorry, only JPG, PNG, JPEG, and GIF files are allowed.";
        $uploadOk = 0;
        header("Location: Student_Edit.php?re=$rg");
        exit(); // Stop script execution
    } else {
        $_SESSION['form_err'] = "";
    }
} else {
    // No new file was uploaded, so don't try to move one.
    $uploadOk = 0; // Set to 0 to prevent the move_uploaded_file call
}


// Get data from POST request
$snf = $_POST['First_Name'];
$snl = $_POST['Last_Name'];
$snfth = $_POST['Father_Name'];
$snmth = $_POST['Mother_Name'];
$Class1 = $_POST['class_nm1'];
$section = $_POST['Section'];
$Day = $_POST['Birth_day'];
$Month = $_POST['Birth_month'];
$Year = $_POST['Birth_year'];
$email = $_POST['Email_Id'];
$phone = $_POST['Mobile_Number'];
$gender = $_POST['Gender'];
$add = $_POST['Address'];
$city = $_POST['City'];
$code = $_POST['Pin_Code'];
$state = $_POST['State'];
$country = $_POST['Country'];
$class_nm2 = $_POST['ses_nm'];
$Sib = $_POST['Sibling'];
$des = $_POST['Sibling_Des'];
// Note: Fee variables are fetched but not used in the UPDATE query below.
// $form  =  $_POST['Form_fee'];
// $AD  =  $_POST['AD_fee'];
// $MIS  =  $_POST['Mis_fee'];
// $CM  =  $_POST['CM_fee'];
// $EX =  $_POST['Exam_fee'];
// $date = $_POST['reg_date'];


// Base SQL query
$sql = "UPDATE students SET 
        First_Name='$snf', Last_Name='$snl', Father_Name='$snfth', Mother_Name='$snmth', 
        class_nm1='$Class1', Section='$section', Birth_day='$Day', Birth_month='$Month', 
        Birth_year='$Year', Email_Id='$email', Mobile_Number='$phone', Gender='$gender', 
        Address='$add', City='$city', Pin_Code='$code', State='$state', Country='$country', 
        st_session='$class_nm2', Sibling='$Sib', Sibling_Des='$des'";

// If a new picture was successfully uploaded, add it to the SQL query
if ($uploadOk == 1 && !empty($pic_nm)) {
    // We store the relative path in the DB, not the full server path
    $db_pic_path = "std_pic/" . trim($rg) . "." . $fileType;
    $sql .= ", std_pic='$db_pic_path'";
}

// CORRECTED: The WHERE clause now uses '$rg'
$sql .= " WHERE S_REG_NUM='$rg'";

// For debugging: you can uncomment this to see the final query
// echo $sql;
// exit();

if (mysqli_query($conn, $sql)) {
    // If query is successful, move the uploaded file
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["fileupload"]["tmp_name"], $pic_nm);
    }
    
    // Redirect back to the student list or a success page
    echo "Record updated successfully!";
    header("location: student_list.php"); // Redirecting to the list is good practice
    exit();

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>