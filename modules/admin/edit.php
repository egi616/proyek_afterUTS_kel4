<?php
require_once '../../config/functions.php';

if (!isset($_GET['id'])) {
    header("Location: ../../index_admin.php"); //balik ke halaman utama admin
    exit;
}

$id = $_GET['id'];
$books = getBooks(); // ambil semua buku
$book = null;
foreach ($books as $b) {
    if ($b['id'] == $id) {
        $book = $b;
        break;
    }
}

if (!$book) {
    echo "Buku tidak ditemukan";
    exit;
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coverName = $book['cover']; // default cover lama

    // cek apakah ada cover baru
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
        $allowedExt = ['jpg','jpeg','png','gif'];
        $fileName = $_FILES['cover']['name'];
        $fileTmp  = $_FILES['cover']['tmp_name'];
        $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedExt)) {
            $newFileName = uniqid() . '.' . $fileExt;
            $destination = '../../assets/images/' . $newFileName;

            if (move_uploaded_file($fileTmp, $destination)) {
                $coverName = $newFileName;

                // optional: hapus cover lama
                if ($book['cover'] && file_exists('../../assets/images/' . $book['cover'])) {
                    unlink('../../assets/images/' . $book['cover']);
                }
            }
        }
    }

    // update database
    $data = [
        'id' => $book['id'],
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'publisher' => $_POST['publisher'],
        'year' => $_POST['year'],
        'sinopsis' => $_POST['sinopsis'] ?? '',
        'cover' => $coverName
    ];

    // query update
    $sql = "UPDATE books SET 
                title='" . mysqli_real_escape_string($conn, $data['title']) . "',
                author='" . mysqli_real_escape_string($conn, $data['author']) . "',
                publisher='" . mysqli_real_escape_string($conn, $data['publisher']) . "',
                year='" . mysqli_real_escape_string($conn, $data['year']) . "',
                sinopsis='" . mysqli_real_escape_string($conn, $data['sinopsis']) . "',
                cover='" . mysqli_real_escape_string($conn, $data['cover']) . "'
            WHERE id=" . intval($data['id']);

    if (mysqli_query($conn, $sql)) {
        header("Location: ../../index_admin.php");
        exit;
    } else {
        $error = "Gagal mengupdate buku: " . mysqli_error($conn);
    }
}
?>
<!-- 
dari sini ke bawah buat form perubahan data yang 
akan dilakukan admin -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Buku</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Cover Buku Saat Ini</label><br>
            <?php if ($book['cover']): ?>
                <img src="../../assets/images/<?= $book['cover']; ?>" alt="<?= $book['title']; ?>" class="img-thumbnail mb-2" width="120">
            <?php endif; ?>
            <input type="file" name="cover" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti cover</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" value="<?= $book['title']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="author" class="form-control" value="<?= $book['author']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="publisher" class="form-control" value="<?= $book['publisher']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="year" class="form-control" value="<?= $book['year']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sinopsis</label>
            <textarea name="sinopsis" class="form-control" rows="4"><?= $book['sinopsis']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Buku</button>
        <a href="../../index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
