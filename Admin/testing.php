<?php
// Start the session at the very beginning
session_start();

// --- 1. Database Connection ---
// Define database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'database');

// Create a database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection for errors
if (mysqli_connect_errno()) {
    // Stop the script and display a connection error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// --- 2. Fetch Initial Data ---

// Get the latest registration number securely
$reg_no = 1; // Default value
$sql_reg = "SELECT MAX(s_reg_no) AS max_reg FROM setting_tb_std";
$result_reg = mysqli_query($conn, $sql_reg);
if ($row_reg = mysqli_fetch_assoc($result_reg)) {
    $reg_no = $row_reg['max_reg'] + 1;
}

// Fetch classes for the dropdown
$sql_classes = "SELECT class_id, class_name FROM classes ORDER BY class_name ASC";
$result_classes = mysqli_query($conn, $sql_classes);

// Fetch sessions for the dropdown
$sql_sessions = "SELECT DISTINCT st_session FROM fee_sett ORDER BY st_session DESC";
$result_sessions = mysqli_query($conn, $sql_sessions);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4a148c;
            text-align: center;
            border-bottom: 2px solid #4a148c;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        fieldset {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            grid-column: span 2; /* Make fieldsets span both columns */
        }
        legend {
            font-weight: 700;
            color: #6a1b9a;
            padding: 0 10px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
            font-weight: 500;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Important for padding */
            font-size: 1rem;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #6a1b9a;
            outline: none;
        }
        .dob-group {
            display: flex;
            gap: 10px;
        }
        .dob-group select {
            flex: 1;
        }
        .radio-group label {
            margin-right: 15px;
        }
        .submit-btn {
            background-color: #6a1b9a;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 500;
            width: 100%;
            grid-column: span 2;
        }
        .submit-btn:hover {
            background-color: #4a148c;
        }
        .ajax-content {
            padding: 15px;
            border: 1px dashed #ccc;
            border-radius: 5px;
            min-height: 100px;
            background-color: #fafafa;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .submit-btn {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <form action="s_insert.php" method="POST" enctype="multipart/form-data">
        <h1>Student Registration Form</h1>
        
        <?php 
            // Display session-based error messages if they exist
            if (isset($_SESSION['form_err']) && $_SESSION['form_err'] != "") {
                echo '<p style="color: red; text-align: center;">' . htmlspecialchars($_SESSION['form_err']) . '</p>';
                // Unset the error message so it doesn't show again
                unset($_SESSION['form_err']); 
            }
        ?>

        <div class="form-grid">

            <fieldset>
                <legend>Academic Information</legend>
                <div class="form-group">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" id="reg_no" name="REG_NO" value="<?php echo htmlspecialchars($reg_no); ?>" readonly>
                </div>
                 <div class="form-group">
                    <label for="reg_date">Registration Date</label>
                    <input type="date" id="reg_date" name="reg_date" required>
                </div>
                <div class="form-group">
                    <label for="class_nm1">Class</label>
                    <select name="class_nm1" id="class_nm1" onchange="fetchClassData()" required>
                        <option value="">-- Select Class --</option>
                        <?php while ($row = mysqli_fetch_assoc($result_classes)) : ?>
                            <option value="<?php echo htmlspecialchars($row['class_id']); ?>">
                                <?php echo htmlspecialchars($row['class_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class_nm2">Session</label>
                    <select name="ses_nm" id="class_nm2" onchange="fetchClassData()" required>
                        <option value="">-- Select Session --</option>
                        <?php while ($row = mysqli_fetch_assoc($result_sessions)) : ?>
                            <option value="<?php echo htmlspecialchars($row['st_session']); ?>">
                                <?php echo htmlspecialchars($row['st_session']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Student Information</legend>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="First_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="Last_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <label><input type="radio" name="Gender" value="Male" required> Male</label>
                        <label><input type="radio" name="Gender" value="Female"> Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" id="dob" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="fileupload">Student Photo</label>
                    <input type="file" name="fileupload" id="fileupload" accept="image/*">
                </div>
            </fieldset>

            <fieldset>
                <legend>Parent & Contact Information</legend>
                <div class="form-group">
                    <label for="father_name">Father's Name</label>
                    <input type="text" id="father_name" name="Father_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="mother_name">Mother's Name</label>
                    <input type="text" id="mother_name" name="Mother_Name" maxlength="30" required>
                </div>
                 <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" name="Mobile_Number" pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
                </div>
                 <div class="form-group">
                    <label for="email_id">Email ID</label>
                    <input type="email" id="email_id" name="Email_Id" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="Address" rows="3" required></textarea>
                </div>
            </fieldset>

            <div class="ajax-container">
                <h3>Subjects</h3>
                <div id="subjects-output" class="ajax-content">
                    <p>Please select a class to see subjects.</p>
                </div>
            </div>

            <div class="ajax-container">
                <h3>Fee Structure</h3>
                <div id="fees-output" class="ajax-content">
                    <p>Please select a class and session.</p>
                </div>
            </div>

            <button type="submit" class="submit-btn">Register Student</button>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    // Set the registration date to today by default
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('reg_date');
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
    });

    // Function to fetch class-related data via AJAX
    function fetchClassData() {
        const classId = $("#class_nm1").val();
        const sessionId = $("#class_nm2").val();

        // Only proceed if a class is selected
        if (classId) {
            // AJAX call for subjects
            $.ajax({
                url: "show_class.php", // PHP file to get subjects
                method: "POST",
                data: { id: classId },
                success: function(data) {
                    $("#subjects-output").html(data);
                },
                error: function() {
                    $("#subjects-output").html("<p>Error loading subjects.</p>");
                }
            });
        } else {
            $("#subjects-output").html("<p>Please select a class to see subjects.</p>");
        }
        
        // Only proceed if both class and session are selected
        if (classId && sessionId) {
            // AJAX call for fee structure
            $.ajax({
                url: "fee_Structure.php", // PHP file to get fees
                method: "POST",
                data: { id: classId, id1: sessionId },
                success: function(data) {
                    $("#fees-output").html(data);
                },
                error: function() {
                    $("#fees-output").html("<p>Error loading fee structure.</p>");
                }
            });
        } else {
             $("#fees-output").html("<p>Please select a class and session.</p>");
        }
    }
</script>

</body>
</html>
<?php
// Close the database connection at the end of the script
mysqli_close($conn);
?>