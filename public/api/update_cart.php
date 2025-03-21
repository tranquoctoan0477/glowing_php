<?php
session_start();

// Kiểm tra nếu giỏ hàng có tồn tại trong session
if (!isset($_SESSION['cart'])) {
    echo json_encode(["status" => "error", "message" => "Giỏ hàng trống."]);
    exit();
}

// Kiểm tra nếu có sản phẩm và số lượng cần cập nhật
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Kiểm tra số lượng hợp lệ (số lượng phải >= 1)
    if ($quantity < 1) {
        echo json_encode(["status" => "error", "message" => "Số lượng phải lớn hơn 0."]);
        exit();
    }

    // Kiểm tra sản phẩm có trong giỏ hàng không
    if (isset($_SESSION['cart'][$productId])) {
        // Cập nhật số lượng của sản phẩm trong giỏ
        $_SESSION['cart'][$productId]['quantity'] = $quantity;

        // Cập nhật subtotal trong giỏ hàng
        $subtotal = $_SESSION['cart'][$productId]['price'] * $quantity;

        echo json_encode(["status" => "success", "message" => "Cập nhật số lượng thành công.", "subtotal" => $subtotal]);
    } else {
        echo json_encode(["status" => "error", "message" => "Sản phẩm không có trong giỏ hàng."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Không có dữ liệu cần cập nhật."]);
}
?>
