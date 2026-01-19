<!-- halaman utama yang didedikasin untuk admin dengan berbagai
fitur-fiturnya -->

<?php
session_start();
require_once 'config/functions.php';

//untuk tampil buku
$books = getBooks();

//untuk tampil buku yang di cari
$keyword = $_GET['keyword'] ?? '';
$books = searchBooks($keyword);

//untuk form loanform.php
include "modules/loandetails/loanform.php";


?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perpustakaan EsepeY</title>

    <!-- Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">EsepeY Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="modules/admin/add.php">Add Book</a></li>
                    <li class="nav-item"><a class="nav-link" href="modules/auth/register.php">Registration</a></li>
                    <?php if (isset($_SESSION['login'])): ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm" href="modules/auth/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="modules/auth/login.php">Login</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-secondary text-center py-5 text-white">
        <div class="container">
            <h1 class="display-4">Welcome to EsepeY Library</h1>
        </div>
    </header>

    <!-- Search Buku -->
    <section id="search" class="py-4 bg-white">
        <div class="container">
            <h2 class="mb-4 text-center">Search Books</h2>
            <form method="GET" class="row g-2 justify-content-center">
                <div class="col-md-6">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari berdasarkan judul"
                        value="<?= $keyword; ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Koleksi Buku -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="mb-4 text-center">Books Catalogs</h2>
            <div class="row g-4">
                <!-- perulangan foreach untuk menampilkan buku -->
                <?php foreach ($books as $book): ?>
                    <div class="col-md-2 col-sm-4">
                        <div class="card h-100 shadow-sm">
                            <!-- Cover -->
                            <img src="assets/images/<?= $book['cover']; ?>" class="card-img-top" alt="<?= $book['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $book['title']; ?>
                                </h5>

                                <p class="card-text">
                                    Penulis: <?= $book['author']; ?><br>
                                    Tahun: <?= $book['year']; ?><br>
                                    Stok: <?= $book['stock']; ?><br>
                                    Sinopsis:
                                    <span id="short-<?= $book['id']; ?>">
                                        <?= substr($book['sinopsis'], 0, 15); ?>...
                                    </span>

                                    <span id="full-<?= $book['id']; ?>" style="display:none;">
                                        <?= $book['sinopsis']; ?>
                                    </span>

                                    <a href="javascript:void(0)"
                                        onclick="toggleSinopsis(<?= $book['id']; ?>, this)">
                                        See all
                                    </a>
                                </p>
                            </div>
                            <div class="card-footer text-end">
                                <a href="modules/admin/edit.php?id=<?= $book['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="modules/admin/delete.php?id=<?= $book['id']; ?>"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');"
                                    class="btn btn-sm btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            Perpustakaan EsepeY
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS Bundled -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>