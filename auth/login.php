<?php include '../assets/konektor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include '../assets/cdn.php'; ?>
    <link rel="icon" href="../assets/images/player.png" type="image/x-icon">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <center>
                            <h2 class="mb-4">
                                <img src="../assets/images/logo1.png" alt="Logo" style="width: 50px; height: 50px;">
                                Login
                            </h2>
                        </center>
                        <form action="ceklogin.php" method="POST">
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
                            <center>
                                <button type="submit" class="btn btn-primary">Login</button>
                                <br>
                                Belum Punya Akun??<a href="register.php"> Register Sekarang</a>
                            </center>
                        </form>
                    </div>
                </div>

            </div>
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