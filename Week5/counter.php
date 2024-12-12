<!DOCTYPE html>
<html>
<body>
<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0; 
}

$_SESSION['counter']++;

echo "<p>You have visited this page " . $_SESSION['counter'] . " times.</p>";
?>
</body>
</html>
