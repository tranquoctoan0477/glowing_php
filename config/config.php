<?php
// config.php

// Cấu hình kết nối MySQL
define('DB_HOST', 'localhost');      // Máy chủ cơ sở dữ liệu
define('DB_USERNAME', 'root');       // Tên người dùng MySQL
define('DB_PASSWORD', '');           // Mật khẩu người dùng MySQL
define('DB_NAME', 'glowingshop');    // Tên cơ sở dữ liệu

// Tạo kết nối
try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Thiết lập chế độ báo lỗi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Không hiển thị thông báo nếu kết nối thành công
} catch (PDOException $e) {
    // Hiển thị thông báo lỗi kết nối nếu có vấn đề
    echo "Lỗi kết nối: " . $e->getMessage();
    exit();
}
?>
