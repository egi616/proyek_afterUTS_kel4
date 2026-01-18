<!-- kode yang di peruntukan untuk admin sehingga 
dapat menghapus data -->

<?php
require_once '../../config/functions.php'; // include fungsi

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (deleteBook($id)) {
        header("Location: ../../index_admin.php"); // kembali ke halaman utama yang di peruntukan admin
        exit;
    } else {
        echo "Gagal menghapus buku.";
    }
} else {
    header("Location: ../../index_admin.php");
    exit;
}
?>
