

<?php
session_start();
if(!isset($_SESSION['form_err']))
{
    $_SESSION['form_err']="";
}

$conn = mysqli_connect("localhost","root","","database");
$sql1 = "SELECT s_reg_no FROM setting_tb_std";
$result1 = mysqli_query($conn, $sql1);
while($rows1 = mysqli_fetch_array($result1)){
    $reg_no = $rows1['s_reg_no'];
}

$sql = "SELECT * FROM classes";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT distinct st_session FROM fee_sett";
$result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .form-header {
            background-color: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
        }

        .form-content {
            padding: 30px;
        }

        /* Alert Messages */
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

        /* Form Grid Layout */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #3498db;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #2c3e50;
            font-size: 0.9rem;
        }

        /* Form Controls */
        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="email"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
            background-color: white;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Radio Button Groups */
        .radio-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .radio-item input[type="radio"] {
            width: auto;
            margin: 0;
        }

        .radio-item label {
            margin: 0;
            font-weight: normal;
        }

        /* Date Selector Grid */
        .date-selector {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        /* File Upload */
        .file-upload {
            position: relative;
        }

        .image-preview {
            margin-top: 10px;
            text-align: center;
        }

        .image-preview img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 6px;
            border: 2px solid #e0e0e0;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        button {
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Subject and Fee Display Sections */
        .display-section {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .display-section h3 {
            color: #3498db;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            margin-top: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 500px;
            background: white;
        }

        table th {
            background-color: #3498db;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Mobile Collapsible Sections */
        .section-header {
            display: none; /* Hidden by default, shown only in mobile */
            position: relative;
            cursor: pointer;
            padding: 15px 20px;
            background: #3498db;
            color: white;
            margin-bottom: 0;
            border-radius: 8px 8px 0 0;
            user-select: none;
            transition: all 0.3s ease;
        }

        .section-header:hover {
            background: #2980b9;
        }

        .section-header.active {
            border-radius: 8px 8px 0 0;
        }

        .dropdown-arrow {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%) rotate(0deg);
            transition: transform 0.3s ease;
            font-size: 1.2rem;
        }

        .dropdown-arrow.rotated {
            transform: translateY(-50%) rotate(180deg);
        }

        .section-content {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .section-content.collapsed {
            max-height: 0;
            opacity: 0;
            padding: 0;
            margin: 0;
        }

        .section-content.expanded {
            max-height: 1000px;
            opacity: 1;
        }

        /* Desktop view - ensure normal display */
        @media screen and (min-width: 769px) {
            .section-header {
                display: none !important; /* Force hide on desktop */
            }
            
            .section-title {
                display: block !important; /* Force show on desktop */
                font-size: 1.1rem;
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 15px;
                padding-bottom: 8px;
                border-bottom: 2px solid #3498db;
            }
            
            .section-content {
                /* Reset all mobile styles for desktop */
                max-height: none !important;
                opacity: 1 !important;
                padding: 0 !important;
                margin: 0 !important;
                overflow: visible !important;
            }
            
            .form-section {
                background: #f8f9fa !important;
                padding: 20px !important;
                border-radius: 8px !important;
                border: 1px solid #e0e0e0 !important;
            }
            
            /* Desktop Grid Layout - Left Right Layout */
            .form-grid {
                grid-template-columns: 2fr 1fr; /* Left side wider for details, right side for photo/subjects/fees */
                grid-template-areas: 
                    "student-details right-panel";
                gap: 25px;
                align-items: start;
            }
            
            /* Hide individual mobile sections on desktop */
            .form-section[data-section="personal"],
            .form-section[data-section="academic"],
            .form-section[data-section="dob"],
            .form-section[data-section="contact"],
            .form-section[data-section="family"],
            .form-section[data-section="address"],
            .form-section[data-section="photo"] {
                display: none;
            }
            
            /* Student Details Section - Left Side */
            .student-details-section {
                grid-area: student-details;
                background: #f8f9fa !important;
                padding: 25px !important;
                border-radius: 8px !important;
                border: 1px solid #e0e0e0 !important;
            }
            /*df*/
            .details-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 25px;
            }
            
            .details-full-width {
                grid-column: 1 / -1;
            }
            
            .details-section {
                margin-bottom: 25px;
            }
            
            .details-section:last-child {
                margin-bottom: 0;
            }
            
            .details-section-title {
                font-size: 1.1rem;
                font-weight: 600;
                color: #3498db;
                margin-bottom: 15px;
                padding-bottom: 8px;
                border-bottom: 1px solid #e0e0e0;
            }
            
            /* Right Panel Section */
            .right-panel-section {
                grid-area: right-panel;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            
            /* Photo Upload Section - Top Right */
            .photo-section-desktop {
                background: #f8f9fa !important;
                padding: 20px !important;
                border-radius: 8px !important;
                border: 1px solid #e0e0e0 !important;
                text-align: center;
                min-height: 200px;
            }
            
            .photo-section-desktop .section-title {
                text-align: center;
                margin-bottom: 15px;
            }
            
            .photo-upload-area {
                border: 2px dashed #3498db;
                border-radius: 8px;
                padding: 20px;
                background: #f8fafc;
                min-height: 150px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            
            .photo-upload-area img {
                max-width: 120px;
                max-height: 120px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            
            /* Subjects Section - Middle Right */
            .subjects-section-desktop {
                background: #f8f9fa !important;
                padding: 20px !important;
                border-radius: 8px !important;
                border: 1px solid #e0e0e0 !important;
                min-height: 200px;
            }
            
            .subjects-section-desktop .section-title {
                margin-bottom: 15px;
            }
            
            .subjects-content {
                background: white;
                border-radius: 6px;
                padding: 15px;
                border: 1px solid #e0e0e0;
                min-height: 150px;
            }
            
            /* Fee Section - Bottom Right */
            .fee-section-desktop {
                background: #f8f9fa !important;
                padding: 20px !important;
                border-radius: 8px !important;
                border: 1px solid #e0e0e0 !important;
                min-height: 200px;
            }
            
            .fee-section-desktop .section-title {
                margin-bottom: 15px;
            }
            
            .fee-content {
                background: white;
                border-radius: 6px;
                padding: 15px;
                border: 1px solid #e0e0e0;
                min-height: 150px;
            }
            
            /* Form controls styling */
            .form-group {
                margin-bottom: 15px;
            }
            
            /* Date selector inline for desktop */
            .date-inline {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 10px;
            }
            
            /* Radio groups inline */
            .radio-group {
                display: flex;
                gap: 15px;
                flex-wrap: wrap;
            }
            
            /* Address section optimization */
            .address-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                gap: 15px;
            }
            
            .address-full {
                grid-column: 1 / -1;
            }
        }

        /* Responsive Design */
        @media screen and (max-width: 1024px) {
            body {
                padding: 15px;
            }
            
            .form-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        /* Desktop Layout - Hide mobile sections */
        @media screen and (min-width: 769px) {
            .mobile-section {
                display: none !important;
            }
            
            .section-header {
                display: none !important;
            }
        }

        @media screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            .form-content {
                padding: 20px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            /* Hide desktop sections on mobile */
            .student-details-section,
            .right-panel-section {
                display: none !important;
            }

            /* Hide the standalone photo section that appears on top */
            .form-section:not(.mobile-section) {
                display: none !important;
            }

            /* Show mobile sections */
            .mobile-section {
                display: block !important;
                padding: 0;
                background: white;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                overflow: hidden;
                margin-bottom: 10px;
            }

            /* Show section headers only in mobile */
            .mobile-section .section-header {
                display: flex !important;
                align-items: center;
                justify-content: space-between;
                padding: 15px;
                background: #3498db;
                color: white;
                font-weight: 500;
                cursor: pointer;
                user-select: none;
            }

            .mobile-section .section-content {
                padding: 15px;
                background: #f8f9fa;
            }

            .mobile-section .section-content.expanded {
                display: block !important;
                max-height: 2000px;
                opacity: 1;
                padding: 15px;
                transition: all 0.3s ease-in-out;
            }

            .mobile-section .section-content.collapsed {
                display: block !important;
                max-height: 0;
                opacity: 0;
                padding: 0 15px;
                overflow: hidden;
                transition: all 0.3s ease-in-out;
            }

            .dropdown-arrow {
                font-size: 12px;
                transition: transform 0.3s ease;
            }

            .dropdown-arrow.rotated {
                transform: rotate(180deg);
            }

            .form-header h1 {
                font-size: 1.4rem;
            }

            .radio-group {
                flex-direction: column;
                gap: 10px;
            }

            .form-actions {
                flex-direction: column;
            }

            button {
                width: 100%;
            }

            /* Mobile specific date selector */
            .date-selector {
                display: grid;
                grid-template-columns: 1fr;
                gap: 8px;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 5px;
            }

            .container {
                border-radius: 4px;
            }

            .form-content {
                padding: 15px;
            }

            .form-section {
                padding: 12px;
            }

            .form-header {
                padding: 15px;
            }

            .form-header h1 {
                font-size: 1.2rem;
            }

            input[type="text"],
            input[type="number"],
            input[type="date"],
            input[type="email"],
            select,
            textarea {
                padding: 8px 12px;
                font-size: 0.9rem;
            }

            .date-selector {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            table th,
            table td {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
        }
    </style>
    <script type="text/javascript">
        // Set current date on page load
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            
            var currentDate = yyyy + '-' + mm + '-' + dd;
            
            // Set for desktop
            var desktopDateInput = document.getElementById('current-date-input');
            if (desktopDateInput) {
                desktopDateInput.value = currentDate;
            }
            
            // Set for mobile
            var mobileDateInput = document.getElementById('current-date-input-mobile');
            if (mobileDateInput) {
                mobileDateInput.value = currentDate;
            }
            
            // Initialize mobile sections - first one expanded, others collapsed
            var mobileSections = document.querySelectorAll('.mobile-section .section-content');
            mobileSections.forEach(function(section, index) {
                if (index === 0) {
                    section.classList.add('expanded');
                    section.classList.remove('collapsed');
                } else {
                    section.classList.add('collapsed');
                    section.classList.remove('expanded');
                }
            });
        });

        function class_sel(){
            var x = document.getElementById("class_nm1").value;
            var n = document.getElementById("class_nm2").value;
            
            $.ajax({
                url:"show_class.php",
                method:"POST",
                data:{
                    id:x
                },
                success:function(data){
                    $("#ans").html(data);
                    // Show subject section when data is loaded
                    if(data.trim() !== '') {
                        var subjectSection = document.getElementById('subject-section');
                        if(subjectSection) {
                            subjectSection.style.display = 'block';
                        }
                    }
                }
            });
            
            $.ajax({
                url:"fee_Structure.php",
                method:"POST",
                data:{
                    id:x,
                    id1:n
                },
                success:function(data){
                    $("#fees").html(data);
                    // Show fee section when data is loaded
                    if(data.trim() !== '') {
                        var feeSection = document.getElementById('fee-section');
                        if(feeSection) {
                            feeSection.style.display = 'block';
                        }
                    }
                }
            });
        }

        function net_fee(){
            var x = document.getElementById("class_nm1").value;
            var n = document.getElementById("class_nm2").value;
            var f = document.getElementById("class_nm3").value;

            $.ajax({
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

        function upload(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                // Update all preview images
                var previews = ['previewImage', 'previewImageDesktop', 'previewImageMobile'];
                
                previews.forEach(function(previewId) {
                    var preview = document.getElementById(previewId);
                    if (preview) {
                        preview.src = dataURL;
                        preview.style.display = 'block';
                    }
                });
            };
            reader.readAsDataURL(input.files[0]);
        }

        // Mobile version of class_sel function
        function class_sel_mobile(){
            var x = document.getElementById("class_nm1_mobile").value;
            var n = document.getElementById("class_nm2_mobile").value;
            
            // Sync with desktop values
            document.getElementById("class_nm1").value = x;
            document.getElementById("class_nm2").value = n;
            
            // Call the main function
            class_sel();
        }

        // Toggle mobile sections
        function toggleSection(sectionName) {
            console.log('Toggling section:', sectionName); // Debug log
            
            // First collapse all other sections
            var allSections = document.querySelectorAll('.mobile-section');
            
            allSections.forEach(function(section) {
                var content = section.querySelector('.section-content');
                var arrow = section.querySelector('.dropdown-arrow');
                var currentSectionName = section.getAttribute('data-section');
                
                if (currentSectionName !== sectionName) {
                    // Collapse other sections
                    content.classList.remove('expanded');
                    content.classList.add('collapsed');
                    arrow.classList.remove('rotated');
                } else {
                    // Toggle the clicked section
                    if (content.classList.contains('collapsed')) {
                        content.classList.remove('collapsed');
                        content.classList.add('expanded');
                        arrow.classList.add('rotated');
                    } else {
                        content.classList.remove('expanded');
                        content.classList.add('collapsed');
                        arrow.classList.remove('rotated');
                    }
                }
            });
        }

        // Sync form data between desktop and mobile versions before submit
        function syncFormData() {
            if (window.innerWidth <= 768) {
                // Copy mobile values to desktop form fields
                var fieldMappings = {
                    'REG_NO_mobile': 'REG_NO',
                    'reg_date_mobile': 'reg_date', 
                    'First_Name_mobile': 'First_Name',
                    'Last_Name_mobile': 'Last_Name',
                    'Father_Name_mobile': 'Father_Name',
                    'Mother_Name_mobile': 'Mother_Name',
                    'class_nm1_mobile': 'class_nm1',
                    'ses_nm_mobile': 'ses_nm',
                    'Section_mobile': 'Section',
                    'Birth_day_mobile': 'Birth_day',
                    'Birth_month_mobile': 'Birth_month', 
                    'Birth_year_mobile': 'Birth_year',
                    'Email_Id_mobile': 'Email_Id',
                    'Mobile_Number_mobile': 'Mobile_Number',
                    'Gender_mobile': 'Gender',
                    'Sibling_mobile': 'Sibling',
                    'Sibling_Des_mobile': 'Sibling_Des',
                    'Address_mobile': 'Address',
                    'City_mobile': 'City',
                    'Pin_Code_mobile': 'Pin_Code',
                    'State_mobile': 'State',
                    'Country_mobile': 'Country'
                };
                
                for (var mobileFieldName in fieldMappings) {
                    var mobileElements = document.getElementsByName(mobileFieldName);
                    var desktopElements = document.getElementsByName(fieldMappings[mobileFieldName]);
                    
                    if (mobileElements.length > 0 && desktopElements.length > 0) {
                        var mobileElement = mobileElements[0];
                        var desktopElement = desktopElements[0];
                        
                        if (mobileElement.type === 'radio') {
                            // Handle radio buttons
                            for (var i = 0; i < mobileElements.length; i++) {
                                if (mobileElements[i].checked) {
                                    for (var j = 0; j < desktopElements.length; j++) {
                                        if (desktopElements[j].value === mobileElements[i].value) {
                                            desktopElements[j].checked = true;
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                        } else {
                            // Handle other input types
                            desktopElement.value = mobileElement.value;
                        }
                    }
                }
            }
        }

    </script>
</head>

<body>
    <div class="container">
        <div class="form-header">
            <h1>Student Registration Form</h1>
        </div>
        
        <div class="form-content">
            <?php 
            if($_SESSION['form_err'] != "") {
                echo '<div class="alert alert-error">' . $_SESSION['form_err'] . '</div>'; 
            }
            ?>
            
            <form action="s_insert.php" method="POST" enctype="multipart/form-data" onsubmit="syncFormData()">
                <div class="form-grid">
                    <!-- Left Side - Student Details -->
                    <div class="student-details-section">
                        <div class="section-title">Student Registration Details</div>
                        
                        <!-- Personal Information -->
                        <div class="details-section">
                            <div class="details-section-title">Personal Information</div>
                            <div class="details-grid">
                                <div class="form-group">
                                    <label for="reg_no">Registration Number</label>
                                    <input type="text" name="REG_NO" value="<?php echo $reg_no + 1; ?>" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="reg_date">Registration Date</label>
                                    <input type="date" id="current-date-input" name="reg_date">
                                </div>
                                
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="First_Name" maxlength="30" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="Last_Name" maxlength="30" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="father_name">Father Name</label>
                                    <input type="text" name="Father_Name" maxlength="30" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="mother_name">Mother Name</label>
                                    <input type="text" name="Mother_Name" maxlength="30" required>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="details-section">
                            <div class="details-section-title">Academic Information</div>
                            <div class="details-grid">
                                <div class="form-group">
                                    <label for="class_nm1">Class</label>
                                    <select name="class_nm1" id="class_nm1" onchange='class_sel()' required>
                                        <option value="">Select Class</option>
                                        <?php 
                                        mysqli_data_seek($result, 0);
                                        while($rows = mysqli_fetch_array($result)){ ?>   
                                            <option value="<?php echo $rows['class_id'];?>"><?php echo $rows['class_name'];?></option>
                                        <?php } ?>
                                    </select>  
                                </div>
                                
                                <div class="form-group">
                                    <label for="class_nm2">Session</label>
                                    <select name="ses_nm" id="class_nm2" onchange='class_sel()' required>
                                        <option value="">Select Session</option>
                                        <?php 
                                        mysqli_data_seek($result2, 0);
                                        while($rows = mysqli_fetch_array($result2)){ ?>   
                                            <option value="<?php echo $rows['st_session'];?>"><?php echo $rows['st_session'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <select name="Section" required>
                                        <option value="">Select Section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="details-section">
                            <div class="details-section-title">Date of Birth</div>
                            <div class="date-inline">
                                <div class="form-group">
                                    <label>Day</label>
                                    <select name="Birth_day" required>
                                        <option value="">Day</option>
                                        <?php for($i = 1; $i <= 31; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Month</label>
                                    <select name="Birth_month" required>
                                        <option value="">Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="Birth_year" required>
                                        <option value="">Year</option>
                                        <?php for($year = 2000; $year <= 2012; $year++) { ?>
                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="details-section">
                            <div class="details-section-title">Contact Information</div>
                            <div class="details-grid">
                                <div class="form-group">
                                    <label for="email">Email ID</label>
                                    <input type="email" name="Email_Id" maxlength="100">
                                </div>
                                
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" name="Mobile_Number" maxlength="10" pattern="[0-9]{10}" title="Please enter 10 digit mobile number">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" name="Gender" value="Male" id="male" required>
                                        <label for="male">Male</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="Gender" value="Female" id="female" required>
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Family Information -->
                        <div class="details-section">
                            <div class="details-section-title">Family Information</div>
                            <div class="form-group">
                                <label>Sibling</label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" name="Sibling" value="Brother" id="brother">
                                        <label for="brother">Brother</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="Sibling" value="Sister" id="sister">
                                        <label for="sister">Sister</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="Sibling" value="None" id="none">
                                        <label for="none">None</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="sibling_desc">Sibling Description</label>
                                <textarea name="Sibling_Des" rows="3" placeholder="Enter sibling details if any"></textarea>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="details-section">
                            <div class="details-section-title">Address Information</div>
                            <div class="form-group address-full">
                                <label for="address">Address</label>
                                <textarea name="Address" rows="3" required></textarea>
                            </div>
                            
                            <div class="address-grid">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="City" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="pin_code">PIN Code</label>
                                    <input type="text" name="Pin_Code" maxlength="6" pattern="[0-9]{6}" title="Please enter 6 digit PIN code" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="State" maxlength="30" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="Country" value="India" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Photo, Subjects, Fees -->
                    <div class="right-panel-section">
                        <!-- Photo Upload Section -->
                        <div class="photo-section-desktop">
                            <div class="section-title">Photo Upload</div>
                            <div class="photo-upload-area">
                                <div class="form-group file-upload">
                                    <label for="fileupload-desktop">Choose Photo</label>
                                    <input type="file" name="fileupload" id="fileupload-desktop" accept="image/*" onchange="upload(event)">
                                    <div class="image-preview">
                                        <img id="previewImageDesktop" src="#" alt="Photo Preview" style="display:none;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subjects Section -->
                        <div class="subjects-section-desktop">
                            <div class="section-title">Subject List</div>
                            <div class="subjects-content">
                                <div id="ans">
                                    <p>Select Class and Session to view subjects...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Fee Structure Section -->
                        <div class="fee-section-desktop">
                            <div class="section-title">Fee Structure</div>
                            <div class="fee-content">
                                <div id="fees">
                                    <p>Select Class and Session to view fee structure...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Upload Section -->
                    <div class="form-section" data-section="photo">
                        <div class="section-header" onclick="toggleSection('photo')">
                            <span>Photo Upload</span>
                            <span class="dropdown-arrow">▼</span>
                        </div>
                        <div class="section-title">Photo Upload</div>
                        <div class="section-content collapsed">
                            <div class="form-group file-upload">
                                <label for="fileupload">Upload Photo</label>
                                <input type="file" name="fileupload" id="fileupload" accept="image/*" onchange="upload(event)">
                                <div class="image-preview">
                                    <img id="previewImage" src="#" alt="Photo Preview" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subject Display Section -->
                <div class="display-section" id="subject-section" style="display: none;">
                    <h3>Subjects</h3>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                </tr>
                            </thead>
                            <tbody id="ans"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Fee Structure Display Section -->
                <div class="display-section" id="fee-section" style="display: none;">
                    <h3>Fee Structure</h3>
                    <div id="fees">
                        <p>Select Class and Session to view fee structure...</p>
                    </div>
                </div>

                <!-- Mobile Sections (Hidden on Desktop, Shown on Mobile) -->
                <!-- Personal Information Section -->
                <div class="form-section mobile-section" data-section="personal">
                    <div class="section-header" onclick="toggleSection('personal')">
                        <span>Personal Information</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content expanded">
                        <div class="form-group">
                            <label for="reg_no_mobile">Registration Number</label>
                            <input type="text" name="REG_NO_mobile" value="<?php echo $reg_no + 1; ?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_date_mobile">Registration Date</label>
                            <input type="date" id="current-date-input-mobile" name="reg_date_mobile">
                        </div>
                        
                        <div class="form-group">
                            <label for="first_name_mobile">First Name</label>
                            <input type="text" name="First_Name_mobile" maxlength="30" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name_mobile">Last Name</label>
                            <input type="text" name="Last_Name_mobile" maxlength="30" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="father_name_mobile">Father Name</label>
                            <input type="text" name="Father_Name_mobile" maxlength="30" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="mother_name_mobile">Mother Name</label>
                            <input type="text" name="Mother_Name_mobile" maxlength="30" required>
                        </div>
                    </div>
                </div>

                <!-- Academic Information Section -->
                <div class="form-section mobile-section" data-section="academic">
                    <div class="section-header" onclick="toggleSection('academic')">
                        <span>Academic Information</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content collapsed">
                        <div class="form-group">
                            <label for="class_nm1_mobile">Class</label>
                            <select name="class_nm1_mobile" id="class_nm1_mobile" onchange='class_sel_mobile()' required>
                                <option value="">Select Class</option>
                                <?php 
                                mysqli_data_seek($result, 0);
                                while($rows = mysqli_fetch_array($result)){ ?>   
                                    <option value="<?php echo $rows['class_id'];?>"><?php echo $rows['class_name'];?></option>
                                <?php } ?>
                            </select>  
                        </div>
                        
                        <div class="form-group">
                            <label for="class_nm2_mobile">Session</label>
                            <select name="ses_nm_mobile" id="class_nm2_mobile" onchange='class_sel_mobile()' required>
                                <option value="">Select Session</option>
                                <?php 
                                mysqli_data_seek($result2, 0);
                                while($rows = mysqli_fetch_array($result2)){ ?>   
                                    <option value="<?php echo $rows['st_session'];?>"><?php echo $rows['st_session'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="section_mobile">Section</label>
                            <select name="Section_mobile" required>
                                <option value="">Select Section</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Date of Birth Section -->
                <div class="form-section mobile-section" data-section="dob">
                    <div class="section-header" onclick="toggleSection('dob')">
                        <span>Date of Birth</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content collapsed">
                        <div class="date-selector">
                            <div class="form-group">
                                <label>Day</label>
                                <select name="Birth_day_mobile" required>
                                    <option value="">Day</option>
                                    <?php for($i = 1; $i <= 31; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Month</label>
                                <select name="Birth_month_mobile" required>
                                    <option value="">Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Year</label>
                                <select name="Birth_year_mobile" required>
                                    <option value="">Year</option>
                                    <?php for($year = 2000; $year <= 2012; $year++) { ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section mobile-section" data-section="contact">
                    <div class="section-header" onclick="toggleSection('contact')">
                        <span>Contact Information</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content collapsed">
                        <div class="form-group">
                            <label for="email_mobile">Email ID</label>
                            <input type="email" name="Email_Id_mobile" maxlength="100">
                        </div>
                        
                        <div class="form-group">
                            <label for="mobile_mobile">Mobile Number</label>
                            <input type="text" name="Mobile_Number_mobile" maxlength="10" pattern="[0-9]{10}" title="Please enter 10 digit mobile number">
                        </div>
                        
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="radio-group">
                                <div class="radio-item">
                                    <input type="radio" name="Gender_mobile" value="Male" id="male_mobile" required>
                                    <label for="male_mobile">Male</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" name="Gender_mobile" value="Female" id="female_mobile" required>
                                    <label for="female_mobile">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Information Section -->
                <div class="form-section mobile-section" data-section="family">
                    <div class="section-header" onclick="toggleSection('family')">
                        <span>Family Information</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content collapsed">
                        <div class="form-group">
                            <label>Sibling</label>
                            <div class="radio-group">
                                <div class="radio-item">
                                    <input type="radio" name="Sibling_mobile" value="Brother" id="brother_mobile">
                                    <label for="brother_mobile">Brother</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" name="Sibling_mobile" value="Sister" id="sister_mobile">
                                    <label for="sister_mobile">Sister</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" name="Sibling_mobile" value="None" id="none_mobile">
                                    <label for="none_mobile">None</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="sibling_desc_mobile">Sibling Description</label>
                            <textarea name="Sibling_Des_mobile" rows="3" placeholder="Enter sibling details if any"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Address Information Section -->
                <div class="form-section mobile-section" data-section="address">
                    <div class="section-header" onclick="toggleSection('address')">
                        <span>Address Information</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content collapsed">
                        <div class="form-group">
                            <label for="address_mobile">Address</label>
                            <textarea name="Address_mobile" rows="3" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="city_mobile">City</label>
                            <input type="text" name="City_mobile" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pin_code_mobile">PIN Code</label>
                            <input type="text" name="Pin_Code_mobile" maxlength="6" pattern="[0-9]{6}" title="Please enter 6 digit PIN code" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="state_mobile">State</label>
                            <input type="text" name="State_mobile" maxlength="30" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="country_mobile">Country</label>
                            <input type="text" name="Country_mobile" value="India" readonly>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="form-section mobile-section" data-section="photo">
                    <div class="section-header" onclick="toggleSection('photo')">
                        <span>Photo Upload</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="section-content collapsed">
                        <div class="form-group file-upload">
                            <label for="fileupload_mobile">Upload Photo</label>
                            <input type="file" name="fileupload" id="fileupload_mobile" accept="image/*" onchange="upload(event)">
                            <div class="image-preview">
                                <img id="previewImageMobile" src="#" alt="Photo Preview" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit">Submit Registration</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>    
