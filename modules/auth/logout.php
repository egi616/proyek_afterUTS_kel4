<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Redirect ke login
header("Location: login.php"); //kalo logout kembali nya ke loginform
exit;
