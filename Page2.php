<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Page2</title>
    <style>
        .dashboard {
            width: 100%;
            height: 100%;
            background-color: rgb(184, 176, 176);
        }

        .dashboard div {
      
            width: 300px;
            height: 800px;
            background-color: skyblue
        }
        div.red{
               width: 100%;
               height: 100px;
               border:1px solid blue;
               
                
       
        }div.red{
            display:grid;
            grid-template-columns: auto auto;
        }
        .red div{
            border:1px solid red;
            width: 50px;
            height: 50px;
            margin-top:  20px;
        
        }
    .icon a {
            position: relative;
            left: 10px;
            top: 20px;
            padding:2px 5px ;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div >
            <div class="red">
                <div><img src="images.jpg"style="width: 100px;height: 80px;position: relative;left:5px;top: -10px;">
                </div>
                <div class="icon" style="position:relative; left: 100px;margin-right: 15px;"><a href="#"><i class="fa-solid fa-bars "></i></a></div>
            <!-- <div > </div>-->
               <!--<div ></div>--> 
            </div>
        </div>
    </div>
</body>

</html>