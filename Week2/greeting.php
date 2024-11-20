<!DOCTYPE html>
<html>
<body>
<?php

date_default_timezone_set('Asia/Kuala_Lumpur');
$hour = date('G'); 

if ($hour >= 5 && $hour <= 11) {

    echo "<p>$hour</p>";
    echo "Good morning!";
    
} elseif ($hour >= 12 && $hour <= 17) {

    echo "<p>$hour</p>";
    echo "Good afternoon!";

} elseif ($hour >= 18 && $hour <= 21) {

    echo "<p>$hour</p>";
    echo "Good evening!";

} else {

    echo "<p>$hour</p>";
    echo "Good night!";

}

?>
</body>
</html>