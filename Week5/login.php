<!DOCTYPE html>
<html>
<body>

<h2>Login Form</h2>

<form method="POST" action="login.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    
    <input type="submit" value="Login">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == '1234') {
        echo "Welcome!";
    } else {
        if (empty($username) || empty($password)) {
            echo "Please enter your username and password.";
        } else {
            echo "Please login again.";
        }
    }
}
?>

</body>
</html>

