<?php 
$conn = mysqli_connect("localhost","root","","school");
$sql = "SELECT * FROM classes";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Form</title>
  <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <script>
    function class_set(){
    var x = document.getElementById("class_nm1").value;
    $.ajax({
      url: "show_class.php",
      method: "POST",
      data: {
        id:x
      },
      success:function(data){
        $("#ans").html(data);
      }
    });
    }
  </script>
  <link rel="stylesheet" href="students.css">
</head>
<body>
  <h1>Student Admission Form</h1>
    <form action="s_insert.php" method="POST">
      <p>Student Details</p>
      <div>
        <label for="sn">Student Name:</label>
        <input type="text" name="SNf" placeholder="First"><input type="text" name="SNl" placeholder="Last"><br></div>
        <div>
        <label for="class_nm1">Class:</label>
        <select name="class_nm1" id="class_nm1" onchange="class_set()">
        <?php while($rows = mysqli_fetch_array($result)){?>
          <option value="<?php echo $rows ["class_id"];?>"><?php echo $rows ["class_name"];?> </option>
          <?php }?>
        </select>
       <?php if(isset($_GET['class_nm'])){ $c= $_GET['class_nm'];} ?>
        
       
        <label for="Section">Section:</label>
        <select name="Section" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select><br></div>
        <div>
        <label for="DOB">Student's DoB:</label>
        <input type="date" name="DOB"><br></div>
        <div>
        <label for="Gender">Student's Gender:</label>
        <input type="radio" name="Gender" value="He">He<input type="radio" name="Gender" value="She">She<br></div>
        <div>
        <label for="Father">Father Name:</label>
        <input type="text" name="Fahterf" placeholder="First"><input type="text" name="Fahterl" placeholder="Last"><br>
        </div>
        <div>
        <label for="Motherf">Mother Name:</label>
        <input type="text" name="Motherl" placeholder="First"><input type="text" name="ParentL" placeholder="Last"><br>
        </div>
        <div>
        <label for="Address">Curent Adress:</label>
        <input type="text" name="StreetAD" placeholder="Street Address">
        <input type="text" name="StreetADs" placeholder="Street Address 2"><br>
        <input type="text" name="City" placeholder="City"><input type="text" name="State" placeholder="State">
        <input type="text" name="Postal" placeholder="Postal/Zip Code"><br></div><div>
        <label for="Phone">Phone:</label>
        <input type="number" name="Phone" placeholder="#####-#####"><br></div><div>
        <label for="Email">Email:</label>
        <input name="Email" type="email"><br></div>
        <button>Submit</button>
    </form>
    <div>
        <table>
          <thread>
            <th>Subject</th>
        </thread>
        <tbody id ="ans"> </tbody>
        </table>
  </div>
</body>
</html>