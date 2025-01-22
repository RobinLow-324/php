<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Customer List - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Customer List</h1>
        </div>

        <?php
        include 'config/database.php';

        $query = "SELECT id, username, first_name, last_name, gender, account_status FROM customers ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        echo "\n <a href='customer_create.php' class='btn btn-primary m-b-1em'>Create New User</a>";

        if ($num > 0) {

            echo "<table class='table table-hover table-responsive table-bordered'>";

            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Username</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Gender</th>";
            echo "<th>Account Status</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$gender}</td>";
                echo "<td>{$account_status}</td>";
                echo "<td>";
                echo "<a href='customer_update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
                echo "<a href='#' onclick='delete_customer({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<div class='alert alert-danger'>No customers found.</div>";
        }
        ?>

    </div>
</body>

</html>