
<?php

include_once 'conn.php'; 
$reg_num = $_POST['re'];
$form_fee = $_POST['form_fee'];
$admission_fee = $_POST['ad_fee'];
$misc_charges = $_POST['ms_chg'];
$caution_money = $_POST['cm'];
$exam_fee = $_POST['e_fee'];
$tuition_fee = $_POST['t_fee'];
$billing_cycle = $_POST['billing_cycle'];
$discount_percent = $_POST['discount_percent'];

$total_amount = $_POST['total_amount'];
$discount_amount = $_POST['discount_amount'];
$net_amount = $_POST['net_amount'];

$student_sql = "SELECT Class, Section, st_Session FROM students WHERE S_REG_NUM = $reg_num";
$student_result = mysqli_query($conn, $student_sql);
if (!$student_result || mysqli_num_rows($student_result) == 0) {
    die("Error: Could not find student with Registration Number: $reg_num");
}
$student_data = mysqli_fetch_assoc($student_result);
$class_name = $student_data['Class'];
$section = $student_data['Section'];
$session = $student_data['st_Session'];

$insert_transaction_sql = "INSERT INTO `transcation_info` (
    `student_id`,
    `class`,
    `section`,
    `session`,
    `form_fee`,
    `admission_fee`,
    `misc_charges`,
    `caution_money`,
    `exam_fee`,
    `tuition_fee`,
    `billing_cycle`,
    `discount_percentage`,
    `discount_amount`,
    `total_amount`,
    `net_amount`,
    `transaction_date`
) VALUES (
    '$reg_num',
    '$class_name',
    '$section',
    '$session',
    '$form_fee',
    '$admission_fee',
    '$misc_charges',
    '$caution_money',
    '$exam_fee',
    '$tuition_fee',
    '$billing_cycle',
    '$discount_percent',
    '$discount_amount',
    '$total_amount',
    '$net_amount',
    NOW()
)";

if (mysqli_query($conn, $insert_transaction_sql)) {
    $insert_second_table_sql = "INSERT INTO `students` (
        `column_1`, 
        `column_2`
    ) VALUES (
        '$reg_num', 
        'your_value'
    )";
    header("Location: student_transec.php?re=$reg_num&status=success");
    exit();
} else {
    die("Error inserting transaction data: " . mysqli_error($conn));
}

$conn->close();
?>
