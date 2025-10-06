<!DOCTYPE html>
<html>
<body onload="myFunction()">
<h1>JavaScript Variables</h1>

<p>In this example, x, y, and z are variables.</p>

<p id="demo"></p>

<script>
   function myFunction(){
let x = 5;
const y = 6;
 y = x + y;

document.getElementById("demo").innerHTML = "The value of z is " + y ;
}
</script>

</body>
</html>
