<?php
// test.php

// Bao gồm file cần thiết
require_once __DIR__ .'../app/controllers/ProductController.php';  // Đảm bảo đường dẫn chính xác

// Tạo instance của ProductController và gọi phương thức index
$productController = new ProductController();
$productController->getAllProduct();
?>

