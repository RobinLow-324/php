<!DOCTYPE html>
<html>
<body>
<?php
session_start();

$timeout = 300;

if (isset($_SESSION['last_activity'])) {
    $duration = time() - $_SESSION['last_activity'];
    if ($duration > $timeout) {
        session_destroy(); 
        header('Location: login.php');
        exit();
    }
}

$_SESSION['last_activity'] = time();
?>
<h1>Welcome to the secured page!</h1>
<a href="logout.php">Logout</a>
</body>
</html>
