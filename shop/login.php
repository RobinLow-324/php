<!DOCTYPE html>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #f8f9fa;
        }

        .form-signin {
            max-width: 350px;
            padding: 1.5rem;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-signin img {
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .form-signin .btn-primary {
            background-color: #0000FF;
            border: none;
        }

        .form-signin .btn-primary:hover {
            background-color: #0040FF;
        }

        .form-control {
            border-radius: 8px;
            font-size: 1rem;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }

        .d-none {
            display: none;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto text-center">
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <img class="mb-4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyxgAv7kkuH0aAy2xNOtC4zMDX-jVnJmgsuw&s" alt="Logo" width="72" height="72">

            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="emailInput" name="emailInput" placeholder="Email address">
                <label for="emailInput">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="passwordInput" name="passwordInput" placeholder="Password">
                <label for="passwordInput">Password</label>
            </div>

            <?php
            session_start();
            include 'config/database.php';
            include 'Validation.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $emailInput = trim($_POST["emailInput"]);
                $passwordInput = trim($_POST["passwordInput"]);

                $validator = new Validation();

                $validator->validateRequired($emailInput, "Username");
                $validator->validateRequired($passwordInput, "Password");

                if (!$validator->isValid()) {
                    echo "<div class='alert alert-danger'><ul>";
                    foreach ($validator->getErrors() as $error) {
                        echo "<li>" . htmlspecialchars($error) . "</li>";
                    }
                    echo "</ul></div>";
                } else {
                    $query = "SELECT id, username, password, account_status FROM customers WHERE username = ? LIMIT 1";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(1, $emailInput);

                    if ($stmt->execute()) {
                        $num = $stmt->rowCount();
                        if ($num > 0) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $hashedPassword = $row["password"];
                            $accountStatus = $row["account_status"];

                            if ($passwordInput == $hashedPassword) {
                                if ($accountStatus == "Active") {
                                    $_SESSION['ID'] = $row['id'];
                                    $_SESSION['Name'] = $emailInput;
                                    $_SESSION['Success'] = true;
                                    header('Location: customer_list.php');
                                    exit();
                                } else {
                                    echo "<div class='alert alert-danger'><ul>";
                                    echo "<li>Account is not active. Please contact customer service.</li>";
                                    echo "</ul></div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'><ul>";
                                echo "<li>Invalid Password</li>";
                                echo "</ul></div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'><ul>";
                            echo "<li>Invalid Username</li>";
                            echo "</ul></div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'><ul>";
                        echo "<li>Database error. Please try again later.</li>";
                        echo "</ul></div>";
                    }
                }
            }

            session_unset();
            session_destroy();
            ?>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>



    </main>
</body>

</html>