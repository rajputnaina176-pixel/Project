<?php
$target_dir = "upload/"; 
$target_file = $target_dir . basename($_FILES["uploaded_file"]["upload"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}


if ($_FILES["uploaded_file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}


$allowed_types = ['jpg', 'png', 'pdf', 'txt'];
if (!in_array($fileType, $allowed_types)) {
    echo "Sorry, only JPG, PNG, PDF & TXT files are allowed.<br>";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "Your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["uploaded_file"]["upload1"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>