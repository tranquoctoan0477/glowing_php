<?php
require_once __DIR__ . '/../../app/controllers/ProductController.php';

header('Content-Type: application/json');

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    echo json_encode(["error" => "Vui lòng nhập từ khóa tìm kiếm."]);
    exit;
}

$keyword = trim($_GET['q']);

$productController = new ProductController();
$products = $productController->searchProducts($keyword);

if (empty($products)) {
    echo json_encode(["error" => "Không tìm thấy sản phẩm nào."]);
} else {
    echo json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>
