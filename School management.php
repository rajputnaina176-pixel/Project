<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Page1 </title>
    <style>
        .mydiv {
            height: 100vh;
            background-image: url("download2.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center;
        }

        .mydiv div {
            border: 1px solid black !important;
            border-radius: 40px;
            width: 500px;
            height: 480px;
            margin: auto;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: lch(100% 0.01 296.81 / 0.026);
            backdrop-filter: blur(5px);


        }

        .mydiv div h1 {
            text-align: center;
            margin-top: 18px;
            font-family: "Jacques Francois Shadow", serif;
            font-size: 50px;
            color: black;
            font-weight: 400;
            font-style: normal;
            text-shadow: 2px 3px 4px black;
            linear-gradient:(0deg, blue, green 40%, red);
        }

        div input {
            position: relative;
            left: 100px;
            border-radius: 12px;
            width: 60%;
            margin-top: 20px;
            padding: 8px 10px;
            background-color: transparent;
            font-size: 25px;
            font-weight:400px;
        }
         div input::placeholder{
            color:black;
         }

        div button {
            position: relative;
            left: 100px;
            border-radius: 15px;
            margin-top: 30px;
            width: 60%;
            padding: 5px;
            background-color: transparent;
            display: block;
            font-size: 30px;
            font-family: "Jacques Francois Shadow", serif;
        }

        div button:hover {
            background-color: #00b3b3 !important;
        }

        div h2 {
            position: relative;
            left: 100px;
            top: 50px;
            font-size: 45px;
            font-family: "Jacques Francois Shadow", serif;
            color: black !important;
             text-shadow: 2px 3px 4px black;
              linear-gradient:(0deg, blue, green 40%, red);
        }


        @media screen and (max-width: 720px) {
            .mydiv {
    
                background-image: url("download2.jpg");
            
            }

            .mydiv div {
                border: 1px solid black;
                border-radius: 30px;
                width: 250px !important;
                height: 250px !important;
                margin: auto;


            }

            .mydiv div h1 {
                text-align: center;
                margin-top: 5px;
                font-family: "Jacques Francois Shadow", serif;
                font-size: 20px;
                color: black;
                font-weight: 400;
                font-style: normal;
                position: relative;
                left: -10px;
            }

            div input {
                position: relative;
                left: 35px;
                border-radius: 12px;
                width: 70%;
                margin-top: 5px;
                padding: 2px 8px;
                background-color: transparent;
                font-size: 20px;
            }

            div button {
                position: relative;
                left: 40px;
                border-radius: 12px;
                margin-top: 20px;
                width: 60%;
                padding: 2px;
                background-color: transparent;
                display: block;
                font-size: 20px;
                font-family: "Jacques Francois Shadow", serif;
            }



            div h2 {
                position: relative;
                left: 100px;
                top: 20px;
                left: 40px;
                font-size: 20px;
                font-family: Courier New;
                color: black !important;
                 text-shadow: 2px 3px 4px black!important;


            }
        }
    </style>
</head>

<body>

    <div class="mydiv">
        <div>
            <h1> LOGIN</h1>
            <input  type="text" placeholder="Username"><br>
            <input type="text" placeholder="Password">
            <button>Login </button>
            <h2>School Web Panel</h2>

        </div>

    </div>
</body>

</html>