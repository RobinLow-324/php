<!DOCTYPE HTML>
<html>
<?php include 'Menu.php'; ?>

<head>
    <title>PDO - Customer List - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h1>Customer List</h1>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <?php
        include 'config/database.php';

        // Handle sorting
        $valid_columns = ['first_name', 'account_status'];
        $sort_column = isset($_GET['sort_column']) && in_array($_GET['sort_column'], $valid_columns) ? $_GET['sort_column'] : 'first_name';
        $sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'DESC' : 'ASC';

        // Fetch customers with sorting
        $query = "SELECT id, username, first_name, last_name, gender, account_status FROM customers ORDER BY $sort_column $sort_order";
        $stmt = $con->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        echo "<a href='customer_create.php' class='btn btn-primary m-b-1em'>Create New User</a>";

        if ($num > 0) {
            echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";

            // Table headers with sort links
            $first_name_sort_order = ($sort_column == 'first_name' && $sort_order == 'ASC') ? 'desc' : 'asc';
            $account_status_sort_order = ($sort_column == 'account_status' && $sort_order == 'ASC') ? 'desc' : 'asc';

            echo "<th>ID</th>";
            echo "<th>Username</th>";
            echo "<th>
                    First Name 
                    <a href='?sort_column=first_name&sort_order=$first_name_sort_order' class='ms-1'>
                        " . ($sort_column == 'first_name' ? ($sort_order == 'ASC' ? '🔼' : '🔽') : '') . "
                    </a>
                  </th>";
            echo "<th>Last Name</th>";
            echo "<th>Gender</th>";
            echo "<th>
                    Account Status 
                    <a href='?sort_column=account_status&sort_order=$account_status_sort_order' class='ms-1'>
                        " . ($sort_column == 'account_status' ? ($sort_order == 'ASC' ? '🔼' : '🔽') : '') . "
                    </a>
                  </th>";
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
                echo "<td>
                        <a href='customer_update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>
                        <a href='#' onclick='delete_customer({$id});' class='btn btn-danger'>Delete</a>
                      </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<div class='alert alert-danger'>No customers found.</div>";
        }
        ?>

    </div>

    <script>
        function delete_customer(id) {
            if (confirm('Are you sure you want to delete this customer?')) {
                window.location = 'customer_delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>