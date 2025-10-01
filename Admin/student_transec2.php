<?php
$reg_num = $_GET['re'];
$conn1 = mysqli_connect("localhost","root","","database");
$sql1="SELECT * from students where S_REG_NUM = $reg_num";
$result1 = mysqli_query($conn1,$sql1);
$rows1 = mysqli_fetch_array($result1);
$FN = $rows1["First_Name"];
$LN = $rows1["Last_Name"];
$sec = $rows1["Section"];
$class = $rows1["class_nm1"];
$st= $rows1["st_session"];  
$sql2="SELECT class_id from classes where class_name = '$class'";
$result2 = mysqli_query($conn1,$sql2);
$rows2 = mysqli_fetch_array($result2);
$class_id = $rows2['class_id'];
$sql3="SELECT * from fee_sett where class_id = {$class_id} and st_session = '{$st}'";
$result3 = mysqli_query($conn1,$sql3);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Transaction</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
  <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>

  <script>
    function net_fee(){
      var x = <?php echo $class_id ?>;
      var h = '<?php echo $st?>';
      var d = document.getElementById("class_nm3").value;
      var n = document.getElementById("discount_am").value;
      $.ajax({
      url: "total_net_fee1.php",
      method: "POST",
      data: {
        id:x,
        id1:h,
        id2:d,
        id3:n
      },
      success:function(data){
        $("#net_f").html(data);
      }
    });
    }
  </script>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 900px;
    }
    .card {
      border: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color:purple ;
      color: white;
      font-style: italic;
    }
    #net_f {
        font-size: 1.5rem;
        font-weight: bold;
        color: #198754;
    }.d-grid button{
background-color: purple;
    }
    .d-grid button:hover{
background-color: #4B0082;
    }
    label{
      font-size:20px;
      font-weight: bold;
      color: purple;
    }
    h4{
      color: purple;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header text-center">
            <h1>Student Transaction Form</h1>
        </div>
        <div class="card-body p-4">
            <form action="sinsert_transec11.php" method="post">
                <?php
                while($rows3 = mysqli_fetch_array ($result3)){
                ?>
                <input type="hidden" name="re" value="<?php echo $reg_num ?>">
                
                <h4 class="mb-3">Student Details</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="student_name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="student_name" value="<?php echo $FN . ' ' . $LN ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="class_name" class="form-label">Class</label>
                        <input type="text" class="form-control" id="class_name" value="<?php echo $class . ' - ' . $sec ?>" readonly>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Fee Structure</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="form_fee" class="form-label">Form Fee</label>
                        <input type="text" class="form-control" name="form_fee" id="form_fee" value="<?php echo $rows3['Form_fee']?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="ad_fee" class="form-label">Admission Fee</label>
                        <input type="text" class="form-control" name="ad_fee" id="ad_fee" value="<?php echo $rows3['AD_fee']?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="ms_chg" class="form-label">Miscellaneous Charges</label>
                        <input type="text" class="form-control" name="ms_chg" id="ms_chg" value="<?php echo $rows3['Mis_fee']?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="cm" class="form-label">Caution Money</label>
                        <input type="text" class="form-control" name="cm" id="cm" value="<?php echo $rows3['CM_fee']?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="e_fee" class="form-label">Exam Fee</label>
                        <input type="text" class="form-control" name="e_fee" id="e_fee" value="<?php echo $rows3['Exam_fee']?>" readonly>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Payment Details</h4>
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="class_nm3" class="form-label">Tuition Fee Plan</label>
                        <input type="hidden" name="Tu_fee" id="Tu_fee" value="<?php echo $rows3['Tu_fee']?>">
                        <select name="class_nm3" id="class_nm3" class="form-select" onchange="net_fee()">
                            <option value="<?php echo $rows3['Tu_fee']?>">Monthly</option>
                            <option value="<?php echo $rows3['Tu_fee']*3?>">Quarterly</option>
                            <option value="<?php echo $rows3['Tu_fee']*12?>">Yearly</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="discount_am" class="form-label">Apply Discount</label>
                        <select name="discount_am" id="discount_am" class="form-select" onchange="net_fee()">
                            <option value="0">None (0%)</option>
                            <option value="10">Sibling Discount (10%)</option>
                            <option value="15">Staff Child (15%)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="for_mon" class="form-label">For Month(s)</label>
                        <input type="text" name="for_mon" class="form-control" id="for_mon" placeholder="e.g., October or Q2">
                    </div>
                     <div class="col-12">
                        <label for="des_fee" class="form-label">Description (Optional)</label>
                        <input type="text" name="des_fee" class="form-control" id="des_fee" placeholder="Any notes or details">
                    </div>
                </div>

                <hr class="my-4">

                <div class="text-center mb-4">
                    <h4>Net Payable Amount</h4>
                    <div id="net_f">
                        </div>
                </div>
                
                <?php 
                } // End of while loop
                ?>

                <div class="d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">SUBMIT TRANSACTION</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    // Initial calculation on page load
    $(document).ready(function() {
        net_fee();
    });
</script>
</body>
</html>