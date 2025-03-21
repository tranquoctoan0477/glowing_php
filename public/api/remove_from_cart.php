<?php
session_start();

// Kiểm tra nếu giỏ hàng có tồn tại trong session
if (!isset($_SESSION['cart'])) {
    echo json_encode(["status" => "error", "message" => "Giỏ hàng trống."]);
    exit();
}

// Kiểm tra nếu có sản phẩm cần xóa
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];

    // Kiểm tra sản phẩm có trong giỏ hàng không
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]); // Xóa sản phẩm khỏi giỏ hàng
        echo json_encode(["status" => "success", "message" => "Sản phẩm đã được xóa khỏi giỏ hàng."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Sản phẩm không có trong giỏ hàng."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Không có sản phẩm để xóa."]);
}
?>
