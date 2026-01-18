<?php
// Jika sudah login, langsung ke index
if (isset($_SESSION['login'])) {
    header("Location: ../../index.php");
    exit;
}

// Ambil pesan error
$error = isset($_GET['pesan']) ? $_GET['pesan'] : '';
?>
<!-- 
file ini didedikasin untuk form login -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EsepeY Library</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Login EsepeY Library</h3>

            <?php if($error == "gagal"): ?>
                <div class="alert alert-danger text-center" role="alert">
                    Username atau password salah!
                </div>
            <?php endif; ?>

            <form action="auth_logic.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-dark">Login</button>
                </div>
            </form>

            <p class="text-center mt-3">
                Belum punya akun? <a href="register.php">Daftar disini</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
