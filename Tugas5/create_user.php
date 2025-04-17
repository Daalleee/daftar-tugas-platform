<?php
require_once 'db_config.php';

$username = 'admin';
$password_plain = '235314071';
$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=tugas5", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password_hashed]);

    echo "User berhasil ditambahkan!";
} catch (PDOException $e) {
    echo "Gagal: " . $e->getMessage();
}
?>
