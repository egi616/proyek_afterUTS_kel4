CREATE TABLE books (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cover VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    title VARCHAR(150) COLLATE utf8mb4_general_ci NOT NULL,
    author VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    publisher VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    year YEAR(4) DEFAULT NULL,
    sinopsis TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    stock INT(11) DEFAULT NULL
);

CREATE TABLE categories (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL
);

CREATE TABLE loans (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) DEFAULT NULL,
    book_id INT(11) DEFAULT NULL,
    loan_date DATE DEFAULT NULL,
    return_date DATE DEFAULT NULL,
    status ENUM('dipinjam', 'kembali') COLLATE utf8mb4_general_ci DEFAULT NULL
);

CREATE TABLE members (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    member_code VARCHAR(20) COLLATE utf8mb4_general_ci NOT NULL,
    name VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    address TEXT COLLATE utf8mb4_general_ci DEFAULT NULL,
    phone VARCHAR(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
    email VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    join_date DATE DEFAULT NULL
);

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) COLLATE utf8mb4_general_ci NOT NULL UNIQUE,
    password VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    full_name VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    role ENUM('admin', 'member') COLLATE utf8mb4_general_ci NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
