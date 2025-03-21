<?php
require_once __DIR__ . '/../Repository/CategoryRepository.php';  // Đảm bảo đường dẫn chính xác
require_once __DIR__ . '/../models/CategoryModel.php'; // Đảm bảo đường dẫn chính xác

class CategoryController
{
    public function getCategories()
    {
        // Khởi tạo repository
        $categoryRepository = new CategoryRepository();

        // Lấy dữ liệu danh mục từ repository
        $categoriesData = $categoryRepository->getAllCategories();

        // Kiểm tra nếu không có danh mục
        if (empty($categoriesData)) {
            return []; // Nếu không có danh mục, trả về mảng rỗng
        }

        return $categoriesData; // Trả về dữ liệu danh mục
    }
}
?>