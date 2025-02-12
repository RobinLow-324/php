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

        // Handle delete request
        if (isset($_GET['confirm_delete']) && is_numeric($_GET['confirm_delete'])) {
            $delete_id = intval($_GET['confirm_delete']);
            $check_query = "SELECT id FROM customers WHERE id = :id";
            $check_stmt = $con->prepare($check_query);
            $check_stmt->bindParam(':id', $delete_id);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                $delete_query = "DELETE FROM customers WHERE id = :id";
                $delete_stmt = $con->prepare($delete_query);
                $delete_stmt->bindParam(':id', $delete_id);

                if ($delete_stmt->execute()) {
                    echo "<div class='alert alert-success'>Customer with ID {$delete_id} was deleted.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to delete customer. Please try again.</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Customer not found.</div>";
            }
        }

        // Handle sorting
        $valid_columns = ['first_name', 'account_status', 'date_of_birth'];
        $sort_column = isset($_GET['sort_column']) && in_array($_GET['sort_column'], $valid_columns) ? $_GET['sort_column'] : 'first_name';
        $sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'DESC' : 'ASC';

        // Fetch customers with sorting
        $query = "SELECT id, username, first_name, last_name, gender, date_of_birth, account_status FROM customers ORDER BY $sort_column $sort_order";
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
            $dob_sort_order = ($sort_column == 'date_of_birth' && $sort_order == 'ASC') ? 'desc' : 'asc';

            echo "<th>ID</th>";
            echo "<th>Username</th>";
            echo "<th>
                    First Name 
                    <a href='?sort_column=first_name&sort_order=$first_name_sort_order' class='ms-1'>
                        " . ($sort_column == 'first_name' ? ($sort_order == 'ASC' ? '▲' : '▼') : '') . "
                    </a>
                  </th>";
            echo "<th>Last Name</th>";
            echo "<th>Gender</th>";
            echo "<th>
                    Date of Birth 
                    <a href='?sort_column=date_of_birth&sort_order=$dob_sort_order' class='ms-1'>
                        " . ($sort_column == 'date_of_birth' ? ($sort_order == 'ASC' ? '▲' : '▼') : '') . "
                    </a>
                  </th>";
            echo "<th>
                    Account Status 
                    <a href='?sort_column=account_status&sort_order=$account_status_sort_order' class='ms-1'>
                        " . ($sort_column == 'account_status' ? ($sort_order == 'ASC' ? '▲' : '▼') : '') . "
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
                echo "<td>{$date_of_birth}</td>";
                echo "<td>{$account_status}</td>";
                echo "<td>
                        <a href='customer_read.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>
                        <a href='customer_update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>
                        <a href='?confirm_delete={$id}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this customer?\");'>Delete</a>
                      </td>";
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