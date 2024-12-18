<!DOCTYPE HTML>
<html>

<head>
    <title>Create Customer - PHP CRUD Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Create Customer</h1>
        </div>
        <?php
        if ($_POST) {
            include 'config/database.php';

            try {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $gender = $_POST['gender'];
                $date_of_birth = $_POST['date_of_birth'];
                $account_status = $_POST['account_status'];

                $errors = [];

                if (empty($username)) {
                    $errors[] = "Username is required.";
                }
                if (empty($password)) {
                    $errors[] = "Password is required.";
                }
                if (empty($first_name)) {
                    $errors[] = "First name is required.";
                }
                if (empty($last_name)) {
                    $errors[] = "Last name is required.";
                }
                if (empty($gender)) {
                    $errors[] = "Gender is required.";
                }
                if (empty($date_of_birth)) {
                    $errors[] = "Date of birth is required.";
                }
                if (empty($account_status)) {
                    $errors[] = "Account status is required.";
                }

                if (!empty($errors)) {
                    echo "<div class='alert alert-danger'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>{$error}</li>";
                    }
                    echo "</ul></div>";
                } else {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    $query = "INSERT INTO customers (username, password, first_name, last_name, gender, date_of_birth, account_status) 
                              VALUES (:username, :password, :first_name, :last_name, :gender, :date_of_birth, :account_status)";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password_hash);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':date_of_birth', $date_of_birth);
                    $stmt->bindParam(':account_status', $account_status);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Customer was added successfully.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save customer.</div>";
                    }
                }
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type='password' name='password' class='form-control' /></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='first_name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='last_name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="Male"> Male
                        <input type="radio" name="gender" value="Female"> Female
                        <input type="radio" name="gender" value="Other"> Other
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type='date' name='date_of_birth' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Account Status</td>
                    <td>
                        <select name="account_status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to customers list</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>