<!DOCTYPE html>
<html>
<body>
<?php
session_start();

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $validUsername = 'admin';
    $validPassword = '1234';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['username'] = $username; 
        header('Location: welcome.php'); 
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<h1>Login</h1>
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>
</body>
</html>
