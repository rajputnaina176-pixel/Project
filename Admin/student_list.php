<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
   <script type="text/javascript">
    function class_sel(){
       var x= document.getElementById("class_nm1").value;
    //   var n= document.getElementById("class_nm2").value;
     
        $.ajax ({
        url:"test_qery.php",
        method:"POST",
        data:{
            id:x
        },
        success:function(data){
            $("#ans").html(data);
        }
    });

    }

    

    </script>
</head>
<body>

    <form action="#" method="post" enctype="multipart/form-data">
        <label for="user">Search: </label>
        <input type="text" name="class_nm1" id ="class_nm1" onchange="class_sel()">
            <button name="submit" type="submit">Submit</button>
        <div>

        <table width=75%>
            <tr>
    
            <th>REGISTRATION NUMBER</th>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Father Name</th>
            <th>DOB</th>
            <th>Edit</th>
            <th>Delete</th>
           <th> Transaction History </th></tr>
          <tbody id="ans">  </tbody>
            
         </table>
        </div>
        
</body>
</html>