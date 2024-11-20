<!DOCTYPE html>
<html>
<body>
<?php

$username = 'Robin';
$password = '1995';

$inputUsername = 'Robin';
$inputPassword = '1995';

if ($inputUsername == $username && $inputPassword == $password) {

    echo "<p>$username</p>";
    echo "<p>$password</p>";
    echo "Login successful!";

} elseif ($inputUsername != $username) {

    echo "<p>$password</p>";
    echo "Invalid username";

} else {

    echo "<p>$username</p>";
    echo "Invalid password";

}
?>


</body>
</html>