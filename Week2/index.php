<!DOCTYPE html>
<html>
<head>
    <style>
        body { background-color: blue; }
        .text1 { color: aqua; font-size: 100px; }
        .text2 { color: red; font-size: 50px; }
        .text3 { color: orange; font-size: 50px; }
    </style>
</head>
<body>
    <?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    echo "<span class='text1'>Robin Low Jian Bin</span>";
    ?>
    <br>
    <span class="text2"><?php echo date("d F Y"); ?></span>
    <br>
    <span class="text3"><?php echo date("g : i A"); ?></span>
</body>
</html>
