<!DOCTYPE html>
<html>
<body>
<style>
    body { background-color: yellow; font-size: 80px}
    </style>
<?php
$num1 = rand(100,200);
$num2 = rand(100,200);

echo "<i style='color:green;'>$num1</i><br>"; 
echo "<i style='color:blue;'>$num2</i><br>"; 

$sum1 = $num1 + $num2;
echo "<b style='color:red;'>$sum1</b><br>";

$sum2 = $num1 * $num2;
echo "<b><i style='color:black;'>$sum2</i></b><br>";
?>

</body>
</html>