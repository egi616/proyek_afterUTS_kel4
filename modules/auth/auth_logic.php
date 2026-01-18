<!-- disini ditulis logika di mulai logika register dan login
yang memungkinkan masuk ke dalan dua index berbeda terngantung role ketika login -->

<?php
session_start();

// Pastikan path ke koneksi database benar
require_once "../../config/connection.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect berdasarkan role
            if ($row['role'] === 'admin') {  //disini dilakukan pengecekan role
                header("Location: ../../index_admin.php");
            } else {
                header("Location: ../../index.php");
            }
            exit;
        }
    }

    // Login gagal
    header("Location: login.php?pesan=gagal");
    exit;
}


if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']); // <-- tangkap role

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password_hashed', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location='login.php';
              </script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}
