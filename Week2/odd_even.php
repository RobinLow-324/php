<!DOCTYPE html>
<html>
<body>
<?php

$num1 = rand(1,100);

if ($num1 % 2 == 0) {
    echo "<p>$num1</p>";
    echo "Even";  
} else {
    echo "<p>$num1</p>";
    echo "Odd"; 
}
?>

</body>
</html>