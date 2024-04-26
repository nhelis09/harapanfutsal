<?php include '../../assets/konektor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <?php include '../assets/cdn.php'; ?>
    <link rel="icon" href="../assets/images/player.png" type="image/x-icon">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container {
        margin-top: 100px;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card-title {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
    }

    #togglePassword {
        cursor: pointer;
    }

    button[type="submit"] {
        width: 100%;
    }

    @media (min-width: 768px) {
        .container {
            margin-top: 50px;
        }

        .card {
            max-width: 400px;
            margin: 0 auto;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 class="card-title">Login Admin</h2>
            <form action="cekloginadmin.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('bi-eye');
        togglePassword.querySelector('i').classList.toggle('bi-eye-slash');
    });
    </script>
</body>

</html>