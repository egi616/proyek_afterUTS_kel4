<!-- pada file ini akan di tulis fungsi-fungsi yang berisikan perintah sql -->

<?php

require_once "connection.php";

//dimulai dari query global
function query($sql){
    global $conn;

    $result = mysqli_query($conn, $sql);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

//query untuk mendapatkan semua buku 
function getBooks(){
    $sql = "SELECT * FROM books ORDER BY id DESC";
    return query($sql);
}

//query untuk mencari buku berdsarkan nama
function searchBooks($keyword){
    $keyword = trim($keyword);

    if ($keyword == "") {
        return getBooks();
    }

    $sql = "SELECT * FROM books 
            WHERE title LIKE '%$keyword%'
            ORDER BY id DESC";

    return query($sql);
}

//query unutuk menambahkan buku
function addBook($data){
    global $conn;

    $title = mysqli_real_escape_string($conn, $data['title']);
    $author = mysqli_real_escape_string($conn, $data['author']);
    $year = mysqli_real_escape_string($conn, $data['year']);
    $publisher = mysqli_real_escape_string($conn, $data['publisher']);

    $sql = "INSERT INTO books (title, author, year, publisher)
            VALUES ('$title', '$author', '$year', '$publisher')";

    return mysqli_query($conn, $sql);
}

//query untuk menghapus data buku
function deleteBook($id){
    global $conn;

    $id = intval($id); // pastikan id angka
    $sql = "DELETE FROM books WHERE id = $id";

    return mysqli_query($conn, $sql);
}

//query untuk mengedit data buku
function updateBook($data){
    global $conn;

    $id = intval($data['id']);
    $title = mysqli_real_escape_string($conn, $data['title']);
    $author = mysqli_real_escape_string($conn, $data['author']);
    $year = mysqli_real_escape_string($conn, $data['year']);
    $publisher = mysqli_real_escape_string($conn, $data['publisher']);

    $sql = "UPDATE books 
            SET title='$title', author='$author', year='$year', publisher='$publisher'
            WHERE id = $id";

    return mysqli_query($conn, $sql);
}
