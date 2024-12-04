<?php
session_start();
?>

<!DOCTYPE html>
<html>

<body>
    <?php
        echo "<p>Username: " . $_SESSION['username'] . "</p>";
        echo "<p>Email: " . $_SESSION['email'] . "</p>";
    ?>
</body>
</html>
