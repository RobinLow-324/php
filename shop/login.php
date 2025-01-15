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
            include 'config/database.php';
            if ($_POST) {
                $emailInput = $_POST["emailInput"];
                $passwordInput = $_POST["passwordInput"];
                $errors[] = "";

                if (empty($emailInput)) {
                    $errors[] = "Enter Username.";
                }

                if (empty($passwordInput)) {
                    $errors[] = "Enter Password.";
                }

                if (!empty($errors)) {
                    echo "<div class ='alert alert-danger'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>{$error}</li>";
                    }
                    echo "</ul></div>";
                } else {
                    $query = "SELECT username, password, account_status FROM customer WHERE username = ? LIMIT 0,1";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(1, $emailInput);
                    $stmt->execute();
                    $num = $stmt->rowCount();

                    if ($num > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $pss = $row["password"];
                        $acc = $row["account_status"];
                        if ($pss === $passwordInput) {
                            if ($acc == 1) {
                                $_SESSION['ID'] = 1;
                                $_SESSION['Name'] = $emailInput;
                                $_SESSION['Success'] = true;
                                header('Location : product_listing.php ');
                                exit();
                            } else {
                                echo "<div class='alert-danger'><ul> ";
                                echo "<li>Acc is not active. please contact customer service. </li>";
                                echo "</ul></div>";
                            }
                        } else {
                            echo "<div class='alert-danger'><ul> ";
                            echo "<li>Invalid Password </li>";
                            echo "</ul></div>";
                        }
                    } else {
                        echo "<div class='alert-danger'><ul> ";
                        echo "<li>Invalid Username </li>";
                        echo "</ul></div>";
                    }
                }
            }

            ?>
            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>
    </main>


</body>

</html>