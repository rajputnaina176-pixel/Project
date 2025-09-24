<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            
            .main{
                overflow: clip;
                height: 100vh;
                background-image: url("images/school-login.png");
                background-repeat: no-repeat;
                background-size: 100% 100%;
                margin-top: 0px !important;
                display: flex;
            }

            *{
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-style: normal;
            }

            h3{
                font-weight: 900;
                color: #ff6600ff;
                text-shadow: 1px 2px 5px black;
            }

            input{
                border-radius: 5px;
                height: 40px;
                padding-left: 10px;
                border: 2px solid #ff4800ff;
                background-color: #ffaf54ff;
                opacity: 0.6;
            }
            form{
                background-color: #ffb7659d;
                backdrop-filter: blur(8px);
                box-shadow: 5px 15px 20px #363636ff;
                text-align: center !important;
                position: relative;
                margin-top: 60px !important;
                border: 0px solid black;
                border-radius: 20px;
                display: flex;
                flex-direction: column;
                width: 350px;
                margin: auto;
                padding: 20px;
            }
            input::placeholder{
                color: #000000ff;
            }
            input:hover {
                border: 2px solid #ff9f32ff;
                background-color: #f0f8ff;
                outline: none; 
                opacity: 1;
            }
            input:focus {
                border: 2px solid #ff9f32ff;
                background-color: #f0f8ff;
                outline: none; 
                color: #333;
                opacity: 1;
            }

            button{
                border: 1px solid #944f00ff;
                border-radius: 5px;
                background-color: #ffba6cff;
            }
            button:hover{
                border-radius: 5px;
                background-color: #ff8800ff;
            }
            button:active{
                border-radius: 5px;
                background-color: #ffba6cff;
            }
            p{
                text-align: center;
                font-weight: 500;
                color: black;
            }
            @media screen and (max-width: 576px) {
             body{
             overflow: hidden;
             }
            h3{
                font-size: 25px !important;
            }

            input{
                height: 40px;
                padding-left: 10px;
                border: 0.8px solid black;
            }
            form{
                margin-top: 220px !important;
                border: 0.8px solid black;
                border-radius: 20px;
                font-size: 13px;
                height: 280px;
                width: 280px;
                padding: 20px;
            }
            input:hover {
                border: 0.8px solid #ff9f32ff;
            }
            input:focus {
                border: 0.8px solid #ff9f32ff;
            }

            button{
                border: 0.8px solid black;
                border-radius: 5px;
                height: 40px;
            }
            button:hover{
                border-radius: 5px;
            }
            button:active{
                border-radius: 5px;
            }
            p{
                font-weight: 500;
            }
            } 
            @media screen and (min-width: 576px) and (max-width: 767px) {
            h3{
                font-size: 20px !important;
            }

            input{
                height: 40px;
                padding-left: 10px;
                border: 0.8px solid black;
            }
            form{
                top: 150px;
                border: 0.8px solid black;
                border-radius: 20px;
                font-size: 12px;
                height: 200px;
                width: 260px;
                padding: 20px;
            }
            input:hover {
                border: 0.8px solid #ff9f32ff;
            }
            input:focus {
                border: 0.8px solid #ff9f32ff;
            }

            button{
                border: 0.8px solid black;
                border-radius: 5px;
            }
            button:hover{
                border-radius: 5px;
            }
            button:active{
                border-radius: 5px;
            }
            p{
                font-weight: 500;
                color: green;
            }
            } 
        </style>
</head>
<body>
    <div class="main">
    <form class="form">
    <h3>LOGIN</h3>
    <input type="text "id="user" name="user" placeholder="Username"><br>
    <input type="text "id="Password" name="Password" placeholder="Password"><br>
    <button>Login</button> <br>
    <p>School Web Panel ©2025</p>
    </form>
    <div>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>