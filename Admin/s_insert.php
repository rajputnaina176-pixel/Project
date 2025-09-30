<?php
session_start();
include("conn.php");
$target_dir = "../std_pic/"; 
$target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowed_types = ['jpg', 'png','gif'];
if (!in_array($fileType, $allowed_types)) {
   $_SESSION['form_err']= "Sorry, only JPG, PNG and GIF  files are allowed.<br>";
    $uploadOk = 0;
    header("Location:Student_form.php");
}
else{
  $_SESSION['form_err']="";
}

$reg_num= $_POST['REG_NO'];
 $snf = $_POST['First_Name'];
 $snl = $_POST['Last_Name'];
 $snfth= $_POST['Father_Name'];
 $snmth= $_POST['Mother_Name'];
 $Class1= $_POST['class_nm1'];
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
 $form  =  $_POST['Form_fee'];
 $AD  =  $_POST['AD_fee'];
$MIS  =  $_POST['Mis_fee'];
$CM  =  $_POST['CM_fee'];
$EX =  $_POST['Exam_fee'];
$class_nm2 = $_POST['ses_nm'];
$Sib  = $_POST['Sibling'];
$date = $_POST['reg_date'];
$des   = $_POST['Sibling_Des'];
$conn1= mysqli_connect("localhost","root","","database");
 $sql3 = "SELECT class_name FROM classes  WHERE class_id= $Class1";
$result1 = mysqli_query($conn1, $sql3);
$rows1= mysqli_fetch_array ($result1);
$class_n = $rows1['class_name'];
  $pic_nm=$target_dir.trim($_POST['REG_NO']).".".$fileType;
  $sql = "INSERT INTO students (First_Name, Last_Name,Father_Name,Mother_Name,class_nm1, Section, Birth_day,Birth_month,Birth_year, Email_Id,Mobile_Number, Gender,  Address,  City,  Pin_Code,State, Country,S_REG_NUM,std_pic,st_session,Sibling,reg_date,Sibling_Des)
  VALUES ('$snf', '$snl','$snfth','$snmth', '$class_n', '$section', '$Day', '$Month','$Year','$email','$phone','$gender','$add', '$city','$code', '$state', '$country',$reg_num,'$pic_nm' ,'$class_nm2','$Sib','$date','$des')";
 
  echo $sql;

  if (mysqli_query($conn, $sql)) {
     $sql2="UPDATE fee_sett SET form_fee=$form, AD_fee=$AD, Mis_fee=$MIS, CM_fee=$CM, Exam_fee=$EX WHERE class_id=$Class1 AND st_session='$class_nm2';";
     echo $sql2;
    $sql1="update setting_tb_std set s_reg_no= $reg_num";
    mysqli_query($conn, $sql1);
     mysqli_query($conn, $sql2);
    if ($uploadOk == 1) {
    move_uploaded_file($_FILES["fileupload"]["tmp_name"],$pic_nm); 
     }
  
     echo $class_nm2;
//  header("location:Student_transaction.php re=$reg_num");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>