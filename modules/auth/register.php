<?php
// Jika sudah login, langsung ke index
if (isset($_SESSION['login'])) {
    header("Location: ../../index.php");
    exit;
}
?>
<!-- 
didedikasikan untuk pembuatan akun dan pemilihan role nya -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EsepeY Library</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Register EsepeY Library</h3>

        <form action="auth_logic.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <!-- pemilihan role dilakukan dibawah -->
            <div class="mb-3">
                <label for="role" class="form-label">Pilih Role</label>
                <select name="role" id="role" class="form-select" required> 
                    <option value="">-- Pilih Role --</option>
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" name="register" class="btn btn-dark">Daftar</button>
            </div>
        </form>

        <p class="text-center mt-3">
            Sudah punya akun? <a href="login.php">Login disini</a>
        </p>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
