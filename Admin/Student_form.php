<?php
session_start();
if (!isset($_SESSION['form_err'])) {
    $_SESSION['form_err'] = "";
}
$conn = mysqli_connect("localhost", "root", "", "database");
$sql1 = "SELECT s_reg_no FROM setting_tb_std";
$result1 = mysqli_query($conn, $sql1);
$reg_no = 0; // Default value
if ($result1) {
    while ($rows1 = mysqli_fetch_array($result1)) {
        $reg_no = $rows1['s_reg_no'];
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
        }
        .ajax-section {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.375rem;
            min-height: 200px;
        }
        label{
font-size:15px;
color:black;
font-weight:200;
font-style:bold;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
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
            var f = document.getElementById("class_nm3").value;

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
    </script>
</head>
<body>

<div class="container my-5width: 50%;">
    <div class="card">
        <div class="card-header text-center">
            <h2 style="color:white;font-size:20px;">STUDENT REGISTRATION FORM</h2>
        </div>
        <div class="card-body p-4">

            <?php
            if ($_SESSION['form_err'] != "") {
                echo '<div class="alert alert-danger">' . $_SESSION['form_err'] . '</div>';
                $_SESSION['form_err'] = ""; // Clear error after displaying
            }
            ?>

            <form action="s_insert.php" method="POST" enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <h4>Student Information</h4>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="REG_NO" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" name="REG_NO" id="REG_NO" value="<?php echo $reg_no + 1; ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="current-date-input" class="form-label">Registration Date</label>
                                <input type="date" class="form-control" id="current-date-input" name="reg_date">
                            </div>
                            <div class="col-md-6">
                                <label for="First_Name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="First_Name" id="First_Name" maxlength="30">
                            </div>
                            <div class="col-md-6">
                                <label for="Last_Name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="Last_Name" id="Last_Name" maxlength="30">
                            </div>
                            <div class="col-md-6">
                                <label for="Father_Name" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" name="Father_Name" id="Father_Name" maxlength="30">
                            </div>
                            <div class="col-md-6">
                                <label for="Mother_Name" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" name="Mother_Name" id="Mother_Name" maxlength="30">
                            </div>
                             <div class="col-md-6">
                                <label for="class_nm1" class="form-label">Class</label>
                                <select name="class_nm1" id="class_nm1" class="form-select" onchange='class_sel()'>
                                    <?php while ($rows = mysqli_fetch_array($result)) { ?>
                                        <option value="<?php echo $rows['class_id']; ?>"> <?php echo $rows['class_name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="class_nm2" class="form-label">Session</label>
                                <select name="ses_nm" id="class_nm2" class="form-select" onchange='class_sel()'>
                                    <?php while ($rows = mysqli_fetch_array($result2)) { ?>
                                        <option value="<?php echo $rows['st_session']; ?>"> <?php echo $rows['st_session']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="Section" class="form-label">Section</label>
                                <select name="Section" id="Section" class="form-select">
                                    <option value="-1">Select Section</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <select name="Birth_day" class="form-select">
                                        <option value="-1">Day</option>
                                        <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
                                    </select>
                                    <select name="Birth_month" class="form-select">
                                        <option value="-1">Month</option>
                                        <option value="January">Jan</option><option value="February">Feb</option><option value="March">Mar</option><option value="April">Apr</option><option value="May">May</option><option value="June">Jun</option><option value="July">Jul</option><option value="August">Aug</option><option value="September">Sep</option><option value="October">Oct</option><option value="November">Nov</option><option value="December">Dec</option>
                                    </select>
                                    <select name="Birth_year" class="form-select">
                                        <option value="-1">Year</option>
                                        <?php for ($i = 2012; $i >= 2000; $i--) echo "<option value='$i'>$i</option>"; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="Email_Id" class="form-label">Email ID</label>
                                <input type="email" class="form-control" name="Email_Id" id="Email_Id" maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label for="Mobile_Number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="Mobile_Number" id="Mobile_Number" maxlength="10">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Gender" id="genderMale" value="Male">
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Gender" id="genderFemale" value="Female">
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-block">Sibling</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Sibling" id="sibBrother" value="Brother">
                                    <label class="form-check-label" for="sibBrother">Brother</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Sibling" id="sibSister" value="Sister">
                                    <label class="form-check-label" for="sibSister">Sister</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Sibling" id="sibNone" value="None">
                                    <label class="form-check-label" for="sibNone">None</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="Sibling_Des" class="form-label">Sibling Description</label>
                                <textarea name="Sibling_Des" id="Sibling_Des" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="Address" class="form-label">Address</label>
                                <textarea name="Address" id="Address" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4"><label for="City" class="form-label">City</label><input type="text" class="form-control" name="City" id="City"></div>
                            <div class="col-md-4"><label for="State" class="form-label">State</label><input type="text" class="form-control" name="State" id="State"></div>
                            <div class="col-md-4"><label for="Pin_Code" class="form-label">Pin Code</label><input type="text" class="form-control" name="Pin_Code" id="Pin_Code"></div>
                            <div class="col-md-12">
                                <label for="Country" class="form-label">Country</label>
                                <input type="text" class="form-control" name="Country" id="Country" value="India" readonly>
                            </div>
                             <div class="col-md-12">
                                <label for="fileupload" class="form-label">Upload Student Image</label>
                                <input type="file" name="fileupload" id="fileupload" class="form-control" accept="image/*">
                                <div id="imagePreviewContainer" class="mt-2">
                                    <img id="previewImage" src="#" alt="Image Preview" style="display:none; max-width:100px; border-radius: 5px;">
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-4">
                            <h4>Subjects</h4>
                            <hr>
                            <div class="ajax-section">
                                <table class="table">
                                    <thead>
                                        <tr><th>SUBJECT NAME</th></tr>
                                    </thead>
                                    <tbody id="ans">
                                        <tr><td><small class="text-muted">Select class and session to view subjects...</small></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                             <h4>Fee Structure</h4>
                             <hr>
                            <div id="fees" class="ajax-section">
                                <p class="text-muted">Select class and session to view fees...</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary btn-lg w-100">SUBMIT HERE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="preview.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const dateInput = document.getElementById("current-date-input");
        if(dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        }
        
        // Image preview logic from your preview.js can also be placed here
        const fileInput = document.getElementById('fileupload');
        if(fileInput) {
            fileInput.onchange = function(event) {
                const preview = document.getElementById('previewImage');
                preview.style.display = 'block';
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.onload = function() {
                  URL.revokeObjectURL(preview.src) // free memory
                }
            };
        }
    });
</script>

</body>
</html>