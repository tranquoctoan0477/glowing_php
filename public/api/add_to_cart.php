<?php
session_start();

// Kiểm tra nếu giỏ hàng đã được tạo ra trong session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lấy dữ liệu sản phẩm từ yêu cầu POST
$productId = $_POST['id'];
$productName = $_POST['name'];
$productPrice = $_POST['price'];
$productQuantity = $_POST['quantity'];

// Kiểm tra nếu sản phẩm đã có trong giỏ hàng
if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] += $productQuantity; // Cộng thêm số lượng
} else {
    $_SESSION['cart'][$productId] = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => $productQuantity,
        'image' => '',  // Thêm image vào nếu có (có thể thêm từ CSDL)
        'variant' => '' // Thêm biến thể nếu có
];
}

// Trả về thông báo thành công
echo json_encode(['status' => 'success', 'message' => 'Đã thêm vào giỏ hàng!']);
?>
