<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>


<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto text-center">
        <form id="signInForm" onsubmit="return validateForm()">
            <img class="mb-4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyxgAv7kkuH0aAy2xNOtC4zMDX-jVnJmgsuw&s" alt="Logo" width="72" height="72">

            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="emailInput" placeholder="Email address">
                <label for="emailInput">Email address</label>
                <small id="emailError" class="text-danger d-none">Email is required.</small>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="passwordInput" placeholder="Password">
                <label for="passwordInput">Password</label>
                <small id="passwordError" class="text-danger d-none">Password is required.</small>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>
    </main>

    <script>
        function validateForm() {
            const email = document.getElementById('emailInput');
            const password = document.getElementById('passwordInput');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            let isValid = true;

            if (!email.value.trim()) {
                emailError.classList.remove('d-none');
                isValid = false;
            } else {
                emailError.classList.add('d-none');
            }
            if (!password.value.trim()) {
                passwordError.classList.remove('d-none');
                isValid = false;
            } else {
                passwordError.classList.add('d-none');
            }

            return isValid;
        }
    </script>
</body>

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