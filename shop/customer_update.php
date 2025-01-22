<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Update Customer - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Customer</h1>
        </div>

        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        include 'config/database.php';

        try {
            $query = "SELECT id, username, first_name, last_name, gender, date_of_birth, account_status, password FROM customers WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
            $account_status = $row['account_status'];
            $password = $row['password'];
        } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <?php
        if ($_POST) {
            try {
                if (isset($_POST['username'])) {
                    $query = "UPDATE customers
                              SET username=:username, first_name=:first_name, last_name=:last_name, gender=:gender, date_of_birth=:date_of_birth, account_status=:account_status WHERE id = :id";
                    $stmt = $con->prepare($query);

                    $username = htmlspecialchars(strip_tags($_POST['username']));
                    $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
                    $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
                    $gender = htmlspecialchars(strip_tags($_POST['gender']));
                    $date_of_birth = htmlspecialchars(strip_tags($_POST['date_of_birth']));
                    $account_status = htmlspecialchars(strip_tags($_POST['account_status']));

                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':date_of_birth', $date_of_birth);
                    $stmt->bindParam(':account_status', $account_status);
                    $stmt->bindParam(':id', $id);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Customer record was updated.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update customer record. Please try again.</div>";
                    }
                }

                if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
                    $oldPasswordInput = htmlspecialchars(strip_tags($_POST['old_password']));
                    $newPasswordInput = htmlspecialchars(strip_tags($_POST['new_password']));

                    if ($oldPasswordInput === $password) {
                        $query = "UPDATE customers SET password=:password WHERE id = :id";
                        $stmt = $con->prepare($query);
                        $stmt->bindParam(':password', $newPasswordInput);
                        $stmt->bindParam(':id', $id);

                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Password updated successfully.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Unable to update password. Please try again.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Incorrect old password.</div>";
                    }
                }
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' value="<?php echo $username; ?>" class='form-control' required /></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='first_name' value="<?php echo $first_name; ?>" class='form-control' required /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='last_name' value="<?php echo $last_name; ?>" class='form-control' required /></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="gender" class="form-control">
                            <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type='date' name='date_of_birth' value="<?php echo $date_of_birth; ?>" class='form-control' required /></td>
                </tr>
                <tr>
                    <td>Account Status</td>
                    <td><input type='text' name='account_status' value="<?php echo $account_status; ?>" class='form-control' required /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Change Password</h3>
                    </td>
                </tr>
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="old_password" class="form-control" required /></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" class="form-control" required /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='customer_list.php' class='btn btn-danger'>Back to customer list</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>

</body>

</html>