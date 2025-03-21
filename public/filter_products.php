<?php
require_once __DIR__ . '/../app/controllers/ProductController.php';

header("Content-Type: application/json");

$category = $_POST['category'] ?? null;
$priceRange = $_POST['priceRange'] ?? null;
$sort = $_POST['sort'] ?? null;

$productController = new ProductController();
$filteredProducts = $productController->filterProducts($category, $priceRange, $sort);

// Trả về dữ liệu dưới dạng JSON
echo json_encode(array_map(function ($product) {
    return [
        'ID' => $product->getId(),
        'Name' => $product->getName(),
        'ThumbnailImage' => $product->getImageURL(),
        'BasePrice' => $product->getBasePrice(),
        'VariantPrice' => $product->getVariantPrice(),
    ];
}, $filteredProducts));
?>
