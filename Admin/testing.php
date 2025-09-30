<?php
// Start the session at the very beginning
session_start();

if (!isset($_SESSION['form_err'])) {
    $_SESSION['form_err'] = "";
}

// --- 1. Secure Database Connection ---
$conn = mysqli_connect("localhost", "root", "", "database");

// Check the connection for errors
if (mysqli_connect_errno()) {
    // Stop the script and display a professional error message
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// --- 2. Corrected Logic to Fetch Data ---

// Get the latest registration number reliably
$reg_no = 1; // Default if table is empty
$sql1 = "SELECT MAX(s_reg_no) AS max_reg FROM setting_tb_std";
$result1 = mysqli_query($conn, $sql1);
if ($row1 = mysqli_fetch_assoc($result1)) {
    // Increment the highest existing registration number
    $reg_no = $row1['max_reg'] + 1;
}

// Fetch classes for the dropdown
$sql = "SELECT class_id, class_name FROM classes ";
$result = mysqli_query($conn, $sql);

// Fetch sessions for the dropdown
$sql2 = "SELECT DISTINCT st_session FROM fee_sett ";
$result2 = mysqli_query($conn, $sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        h1 {
            font-size: 24px;
            color: #4a148c;
            text-align: center;
            margin-bottom: 25px;
        }
        /* Modern form layout using CSS Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        fieldset {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 0;
            grid-column: span 2; /* Make each fieldset span the full width */
        }
        legend {
            font-weight: 500;
            color: #6a1b9a;
            padding: 0 10px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        label {
            font-weight: 500;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #6a1b9a;
            outline: none;
        }
        .submit-btn {
            background-color: #6a1b9a;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            width: 100%;
            grid-column: span 2;
        }
        .submit-btn:hover {
            background-color: #4a148c;
        }
        .ajax-section {
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 8px;
            min-height: 150px;
        }
        /* Responsive Design */
        @media (max-width: 800px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            fieldset, .submit-btn {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <form action="s_insert.php" method="POST" enctype="multipart/form-data">
        <h1>STUDENT INFORMATION FORM</h1>
        
        <?php 
            // Display and clear session error message securely
            if (!empty($_SESSION['form_err'])) {
                echo '<p style="color: red; text-align: center; font-weight: bold;">' . htmlspecialchars($_SESSION['form_err']) . '</p>';
                unset($_SESSION['form_err']); // Clear the error after displaying
            }
        ?>

        <div class="form-grid">
            
            <fieldset>
                <legend>Academic Details</legend>
                <div class="form-group">
                    <label for="reg_no">REGISTRATION NUMBER</label>
                    <input type="text" id="reg_no" name="REG_NO" value="<?php echo htmlspecialchars($reg_no); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="current-date-input">Registration Date</label>
                    <input type="date" id="current-date-input" name="reg_date" required>
                </div>
                <div class="form-group">
                    <label for="class_nm1">Class</label>
                    <select name="class_nm1" id="class_nm1" onchange="class_sel()" required>
                        <option value="">-- Select Class --</option>
                        <?php while ($rows = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?php echo htmlspecialchars($rows['class_id']); ?>">
                                <?php echo htmlspecialchars($rows['class_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class_nm2">Session</label>
                    <select name="ses_nm" id="class_nm2" onchange="class_sel()" required>
                        <option value="">-- Select Session --</option>
                        <?php while ($rows = mysqli_fetch_assoc($result2)) : ?>
                            <option value="<?php echo htmlspecialchars($rows['st_session']); ?>">
                                <?php echo htmlspecialchars($rows['st_session']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Personal Information</legend>
                <div class="form-group">
                    <label for="first_name">FIRST NAME</label>
                    <input type="text" id="first_name" name="First_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="last_name">LAST NAME</label>
                    <input type="text" id="last_name" name="Last_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="father_name">FATHER'S NAME</label>
                    <input type="text" id="father_name" name="Father_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="mother_name">MOTHER'S NAME</label>
                    <input type="text" id="mother_name" name="Mother_Name" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="dob">DATE OF BIRTH</label>
                    <input type="date" id="dob" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label>GENDER</label>
                    <div>
                        <input type="radio" id="male" name="Gender" value="Male" required> <label for="male">Male</label>
                        <input type="radio" id="female" name="Gender" value="Female"> <label for="female">Female</label>
                    </div>
                </div>
                <div class="form-group">
                      <input type="file" name="fileupload" id="fileupload"  class=" file"class="file_up" value="fileupload" accept="images/*" onchange="upload(event)"> <br>
      <div id="imagePreviewContainer">
          <img id ="previewImage" src="#" alt="Image Preview" style="Display:none;max-width:80px;max-height:100px;">
      </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contact Details</legend>
                <div class="form-group">
                    <label for="mobile_number">MOBILE NUMBER</label>
                    <input type="text" id="mobile_number" name="Mobile_Number" pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
                </div>
                <div class="form-group">
                    <label for="email_id">EMAIL ID</label>
                    <input type="email" id="email_id" name="Email_Id" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="address">ADDRESS</label>
                    <textarea id="address" name="Address" rows="4" required></textarea>
                </div>
            </fieldset>
            
            <div class="ajax-section">
                <h3>SUBJECTS</h3>
                <div id="ans">
                    <p>Select a class to view subjects.</p>
                </div>
            </div>

            <div class="ajax-section">
                <h3>FEE STRUCTURE</h3>
                <div id="fees">
                    <p>Select a class and session to view fees.</p>
                </div>
                <div id="net"></div>
            </div>

            <button type="submit" class="submit-btn">SUBMIT REGISTRATION</button>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
  <script src="preview.js"> </script>
<script type="text/javascript">
    // --- JAVASCRIPT FUNCTIONS - UNCHANGED AS REQUESTED ---
    function class_sel() {
       var x = document.getElementById("class_nm1").value;
       var n = document.getElementById("class_nm2").value;
        $.ajax({
            url: "show_class.php",
            method: "POST",
            data: {
                id: x
            },
            success: function(data) {
                $("#ans").html(data);
            }
        });
       $.ajax({
            url: "fee_Structure.php",
            method: "POST",
            data: {
                id: x,
                id1: n
            },
            success: function(data) {
                $("#fees").html(data);
            }
        });
    }

    function net_fee() {
       var x = document.getElementById("class_nm1").value;
       var n = document.getElementById("class_nm2").value;
       var f = document.getElementById("class_nm3").value; // Note: Ensure an element with id="class_nm3" exists for this to work
        $.ajax({
            url: "total_net_fee.php",
            method: "POST",
            data: {
                id: x,
                id5: n,
                id8: f
            },
            success: function(data) {
                $("#net").html(data);
            }
        });
    }

    // --- SCRIPT TO SET CURRENT DATE - TYPOS FIXED ---
    document.addEventListener('DOMContentLoaded', (event) => {
        const dateInput = document.getElementById("current-date-input");
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
    });
</script>
</body>
</html>
<?php
// Close the database connection at the end
mysqli_close($conn);
?>