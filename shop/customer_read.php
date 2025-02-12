<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read Customer - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Customer Details</h1>
        </div>

        <?php
        // Include database connection
        include 'config/database.php';

        $id = isset($_GET['id']) ? intval($_GET['id']) : die('ERROR: Customer ID not found.');

        // Fetch customer details
        $query = "SELECT id, username, first_name, last_name, gender, account_status FROM customers WHERE id = :id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<table class='table table-hover table-bordered'>";
            echo "<tr><th>ID</th><td>{$row['id']}</td></tr>";
            echo "<tr><th>Username</th><td>{$row['username']}</td></tr>";
            echo "<tr><th>First Name</th><td>{$row['first_name']}</td></tr>";
            echo "<tr><th>Last Name</th><td>{$row['last_name']}</td></tr>";
            echo "<tr><th>Gender</th><td>{$row['gender']}</td></tr>";
            echo "<tr><th>Account Status</th><td>{$row['account_status']}</td></tr>";
            echo "</table>";
        } else {
            echo "<div class='alert alert-danger'>Customer not found.</div>";
        }
        ?>

        <a href='customer_list.php' class='btn btn-primary'>Back to Customer List</a>
    </div>
</body>

</html>