<!DOCTYPE HTML>
<html>
<?php include 'Menu.php'; ?>

<head>
    <title>PDO - Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1>Manage Products</h1>
            <!-- Logout Button -->
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <?php
        // Include database connection
        include 'config/database.php';

        // Check if a delete request was made
        if (isset($_GET['confirm_delete']) && is_numeric($_GET['confirm_delete'])) {
            $delete_id = intval($_GET['confirm_delete']);

            // Check if record exists
            $check_query = "SELECT id FROM products WHERE id = :id";
            $check_stmt = $con->prepare($check_query);
            $check_stmt->bindParam(':id', $delete_id);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                // Record exists, perform delete
                $delete_query = "DELETE FROM products WHERE id = :id";
                $delete_stmt = $con->prepare($delete_query);
                $delete_stmt->bindParam(':id', $delete_id);

                if ($delete_stmt->execute()) {
                    echo "<div class='alert alert-success'>Record with ID {$delete_id} was deleted.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to delete record. Please try again.</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Record not found.</div>";
            }
        }

        // Handle search query and sorting
        $search_name = isset($_GET['search']) ? htmlspecialchars(strip_tags($_GET['search'])) : '';
        $valid_columns = ['name', 'price'];
        $sort_column = isset($_GET['sort_column']) && in_array($_GET['sort_column'], $valid_columns) ? $_GET['sort_column'] : 'name';
        $sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'DESC' : 'ASC';

        // Select data query with search and sorting
        $query = "SELECT id, name, description, price, expired_date, manufacture_date FROM products 
                  WHERE name LIKE :name 
                  ORDER BY $sort_column $sort_order";
        $stmt = $con->prepare($query);
        $search_term = "%$search_name%";
        $stmt->bindParam(':name', $search_term);
        $stmt->execute();

        // Generate sort links for each column
        $name_sort_order = ($sort_column == 'name' && $sort_order == 'ASC') ? 'desc' : 'asc';
        $price_sort_order = ($sort_column == 'price' && $sort_order == 'ASC') ? 'desc' : 'asc';

        // Display search and sort form
        echo "<form action='' method='GET' class='mb-3 d-flex'>";
        echo "<input type='text' name='search' class='form-control me-2' placeholder='Search product by name' value='{$search_name}'>";
        echo "<button type='submit' class='btn btn-primary me-2'>Search</button>";
        echo "</form>";

        // Get number of rows returned
        $num = $stmt->rowCount();
        echo "<p class='mb-3'>Total Products Found: <strong>{$num}</strong></p>";

        // Link to create record form
        echo "<a href='product_create.php' class='btn btn-primary mb-3'>Create New Product</a>";

        if ($num > 0) {
            echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>
                    Name 
                    <a href='?search=$search_name&sort_column=name&sort_order=$name_sort_order' class='ms-1'>
                        " . ($sort_column == 'name' ? ($sort_order == 'ASC' ? '🔼' : '🔽') : '') . "
                    </a>
                  </th>";
            echo "<th>Description</th>";
            echo "<th>
                    Price 
                    <a href='?search=$search_name&sort_column=price&sort_order=$price_sort_order' class='ms-1'>
                        " . ($sort_column == 'price' ? ($sort_order == 'ASC' ? '🔼' : '🔽') : '') . "
                    </a>
                  </th>";
            echo "<th>Manufacture Date</th>";
            echo "<th>Expired Date</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>" . htmlspecialchars($id, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($name, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($description, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($price, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($manufacture_date, ENT_QUOTES) . "</td>";
                echo "<td>" . htmlspecialchars($expired_date, ENT_QUOTES) . "</td>";
                echo "<td>
                        <a href='product_details.php?id={$id}' class='btn btn-info me-1'>Read</a>
                        <a href='product_update.php?id={$id}' class='btn btn-primary me-1'>Edit</a>
                        <a href='?confirm_delete={$id}' class='btn btn-danger'>Delete</a>
                      </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<div class='alert alert-danger'>No products found.</div>";
        }
        ?>

    </div>
</body>

</html>