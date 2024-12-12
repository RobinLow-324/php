<!DOCTYPE html>
<html>
<head>
    <title>Secure Session System</title>
</head>
<body>
<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['user_ip']) || !isset($_SESSION['user_agent'])) {
    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}

if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    die("Session validation failed. Please log in again.");
}

$timeout_duration = 600;
if (isset($_SESSION['last_activity']) && 
    (time() - $_SESSION['last_activity'] > $timeout_duration)) {
    session_unset();
    session_destroy();
    die("Session timed out. Please log in again.");
}

$_SESSION['last_activity'] = time();
echo "<h1>Welcome to the Secure Session System</h1>";
echo "<p>Your session is active and secure.</p>";
?>
</body>
</html>
