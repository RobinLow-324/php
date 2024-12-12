<!DOCTYPE html>
<html>
<body>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: new_login.php'); 
    exit();
}
?>
<h1>Welcome</h1>
<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

<a href="logout.php">Logout</a>
</body>
</html>
