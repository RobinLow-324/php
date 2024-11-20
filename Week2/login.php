<!DOCTYPE html>
<html>
<body>
<?php

const username = 'Robin';
const password = '1995';

$inputUsername = 'Robin';
$inputPassword = '1995';

if ($inputUsername == username && $inputPassword == password) {

    echo "Login successful!";
    echo "<p> Welcome to this page. </p>";

} elseif ($inputUsername != username) {

    echo "<p> Correct password </p>";
    echo "Invalid username";

} else {

    echo "<p> Correct username </p>";
    echo "Invalid password";

}
?>


</body>
</html>