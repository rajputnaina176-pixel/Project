<?php
 
?>
 <!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
   <style>
     body{
        background: #2A7B9B;
background: linear-gradient(90deg,rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);
}
.grid{
    border:1px solid black;
    width:100%;
    height:1500px;
    display: grid;
    grid-template-columns: auto auto;
    column-gap:70px;

}
   .grid .div{
   border:1px solid purple;
   border-radius:30px;
   width:350px;
   height: 500px;
   margin:auto;
   position:absolute;
  left:50%;
   top:50%;
   transform:translate(-50%,-50%);
    }
     
     .div h2{
        position:relative;
        left: 80px;
        font-size:35px;
        font-weight:21px;
        filter: blur(1px);
     
     } 
      label{
        font-size:25px;
        margin-left:10px;
      }   
     input{
    display: block;
    height: 40px;
    width: 90%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    position:relative;
    left:10px;
    margin-top: 8px;

     }  input::placeholder{
            color:black;
         }
      
  .red{
   border:1px solid red;
   border-radius:50px;
   width:350px;
   height: 500px;
   margin:auto;
   position:absolute;
  left:50%;
   top:50%;
   transform:translate(-50%,-50%);
   padding:8px 5px;
  
    }
     
    .red h2{
        position:relative;
        left: 80px;
        font-size:35px;
        font-weight:21px;
        filter: blur(1px);
     
     } 
      label{
        font-size:25px;
        margin-left:10px;
      }   
     input{
    display: block;
    height: 40px;
    width: 90%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    position:relative;
    left:10px;
    margin-top: 8px;

     }  input::placeholder{
            color:black;
         }
 
    </style>
    </style> 
</head>
<body>

<?php
 if (isset($_GET['error'])) {
    echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
}
?>
<div class="grid">
    <div class= "div">
<form action="login_process.php" method="POST">

    <h2> Student Login</h2>
    <label>Username</label><br>
    <input type="text" name="username"placeholder="Enter the username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" placeholder="Enter the password" required><br><br>

    <input type="submit" name="submit" value="Login"style="font-size:30px;">
</form>
</div> 
</div>
</body>
</html>















