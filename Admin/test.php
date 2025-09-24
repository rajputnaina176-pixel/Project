<?php 
      include("conn.php");
       $sel= "SELECT c.class_name, s.subject_name FROM class_subjects cs JOIN classes c ON cs.class_id=c.class_id JOIN subjects s ON cs.subject_id = s.subject_id where c.class_name = '10th'";
       $result = $conn->query($sel);
       if ($result->num_rows >0){

         while ($row= $result->fetch_assoc()){
             echo $row['subject_name']."<br>";
         }
       }
    


?>