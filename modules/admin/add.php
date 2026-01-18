<!-- pada folder admin akan disi oleh kode yang memungkinkan admin untuk melakukan tambah data
hapus, data dan edit data;  -->

<?php
require_once '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data form di bawah
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $sinopsis = $_POST['sinopsis'];

    // Handle upload cover
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {

        $allowedExt = ['jpg','jpeg','png','gif'];
        $fileName = $_FILES['cover']['name'];
        $fileTmp  = $_FILES['cover']['tmp_name'];
        $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedExt)) {
            // Buat nama unik
            $newFileName = uniqid() . '.' . $fileExt;
            $destination = '../../assets/images/' . $newFileName;

            if (move_uploaded_file($fileTmp, $destination)) {
                // Simpan ke database
                $sql = "INSERT INTO books (cover, title, author, publisher, year, sinopsis)
                        VALUES ('$newFileName', '$title', '$author', '$publisher', '$year', '$sinopsis')";
                if (mysqli_query($conn, $sql)) {
                    $success = "Buku berhasil ditambahkan!";
                } else {
                    $error = "Gagal menambahkan buku: " . mysqli_error($conn);
                }
            } else {
                $error = "Gagal mengupload cover buku.";
            }

        } else {
            $error = "Format file tidak diizinkan. Hanya jpg, jpeg, png, gif.";
        }

    } else {
        $error = "Cover buku wajib diisi.";
    }
}
?>

<!-- dari sini ke bawah di peruntukan untuk form pengisian data baru yang dapat 
dilakukan admin -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Buku</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Cover Buku</label>
            <input type="file" name="cover" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="publisher" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="year" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sinopsis</label>
            <textarea name="sinopsis" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Buku</button>
        <a href="../../index_admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>