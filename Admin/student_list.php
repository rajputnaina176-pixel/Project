<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

        /* Search form styles */
        .search-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        label {
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"] {
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
            min-width: 200px;
        }

        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 1000px;
            background: white;
        }

        table th {
            background-color: #3498db;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Action buttons in table */
        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
            display: inline-block;
            margin: 2px;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .history-btn {
            background-color: #17a2b8;
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        /* Responsive design */
        @media screen and (max-width: 1024px) {
            body {
                padding: 15px;
            }

            .search-box {
                padding: 15px;
            }
        }

        @media screen and (max-width: 768px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="text"],
            button {
                width: 100%;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 10px;
            }

            .search-box {
                padding: 12px;
            }

            table th,
            table td {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>
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

    <div class="search-box">
        <form action="#" method="post" enctype="multipart/form-data" class="search-form">
            <label for="class_nm1">Search: </label>
            <input type="text" name="class_nm1" id="class_nm1" onchange="class_sel()" placeholder="Enter search term...">
            <button name="submit" type="submit">Submit</button>
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
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