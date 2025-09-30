<?php

include_once 'conn.php'; 

$reg_num =  $_POST['re'];
$tuition_fee = $_POST['Tu_fee'];
$billing_cycle =  $_POST['class_nm3']; 
$total_amount =  $_POST['total_am'];
$discount_am =  $_POST['discount_am'];
$for_mon =  $_POST['for_mon'];
$des =  $_POST['des_fee'];
$mode =  $_POST['mode'];


$student_sql = "SELECT class_nm1, Section, st_Session FROM students WHERE S_REG_NUM = '$reg_num'";
$student_result = mysqli_query($conn, $student_sql);

if (!$student_result || mysqli_num_rows($student_result) == 0) {
    die("Error: Could not find student with Registration Number: $reg_num");
}
$student_data = mysqli_fetch_assoc($student_result);
$class_name = $student_data['class_nm1'];
$section = $student_data['Section'];
$session = $student_data['st_Session'];


$insert_transaction_sql = "INSERT INTO transcation_info (
 	 S_REG_NUM, Description, class_nm1, Section, st_session, for_month, Monthly_fee, Date, trans_amt
) VALUES (
    '$reg_num', '$des', '$class_name', '$section', '$session', '$for_mon', '$tuition_fee', NOW(), '$total_amount'
)";

if (mysqli_query($conn, $insert_transaction_sql)) {
   
   $insert_second_table_sql = "UPDATE students SET 
            Tuit_mode = '$mode', 
            Total_fee = '$total_amount', 
            Sibling_des = '$discount_am', 
            Month_fee = '$tuition_fee'
        WHERE S_REG_NUM = '$reg_num'";

    if (mysqli_query($conn, $insert_second_table_sql)) {
      
        header("Location: student_transec2.php?re=$reg_num&status=success");
        exit();
    } else {
       
        die("Error updating student data: " . mysqli_error($conn));
    }   

} else {
   
    die("Error inserting transaction data: " . mysqli_error($conn));
}


mysqli_close($conn);

?>