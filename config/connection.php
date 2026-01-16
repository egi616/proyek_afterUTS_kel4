<!-- note html dan css memakai bootstrap sehingga penjelasan persentasi akabn berfokus pada 
bagaimana pengaplikasian database nya -->
<!-- pada file ini dibuat kode untuk koneksi databasse -->

<?php
$host = "localhost";    
$user = "root";
$pass = "";
$db   = "library_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>