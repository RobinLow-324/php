<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Read Products</h1>
        </div>

        <?php
        // Include database connection
        include 'config/database.php';

        // Check if a delete request was made
        if (isset($_GET['delete_id'])) {
            $delete_id = htmlspecialchars(strip_tags($_GET['delete_id']));

            // Prepare delete query
            $delete_query = "DELETE FROM products WHERE id = :id";
            $delete_stmt = $con->prepare($delete_query);
            $delete_stmt->bindParam(':id', $delete_id);

            // Execute delete query
            if ($delete_stmt->execute()) {
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            } else {
                echo "<div class='alert alert-danger'>Unable to delete record. Please try again.</div>";
            }
        }

        // Select all data
        $query = "SELECT id, name, description, price ,expired_date, manufacture_date FROM products ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // Get number of rows returned
        $num = $stmt->rowCount();

        // Link to create record form
        echo "<a href='product_create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";

        // Check if more than 0 record found
        if ($num > 0) {

            // Start table
            echo "<table class='table table-hover table-responsive table-bordered'>";

            // Creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
            echo "<th>manufacture_date</th>";
            echo "<th>expired_date</th>";
            echo "<th>Action</th>";

            echo "</tr>";

            // Retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Extract row
                extract($row);

                // Creating new table row per record
                echo "<tr>";
                echo "<td>" . htmlspecialchars($id, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($name, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($description, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($price, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($manufacture_date, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($expired_date, ENT_QUOTES) . "</td>";
                echo "<td>";
                // Read one record
                echo "<a href='product_details?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

                // Edit record
                echo "<a href='product_update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                // Delete record
                echo "<a href='delete.php?delete_id={$id}' class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            // End table
            echo "</table>";
        } else {
            // If no records found
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
    </div> <!-- end .container -->
</body>

</html>