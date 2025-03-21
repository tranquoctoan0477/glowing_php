<?php

// Đảm bảo đường dẫn chính xác đến config.php
require_once __DIR__ . '/../../config/config.php';

// CategoryRepository.php

class CategoryRepository
{
    public function getAllCategories()
    {
        global $pdo;
        // Chuẩn bị câu truy vấn SQL để lấy tất cả các danh mục
        $query = "SELECT * FROM categories";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Kiểm tra nếu có dữ liệu trả về
        if ($stmt->rowCount() > 0) {
            $categories = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Khởi tạo CategoryModel và gán giá trị cho các thuộc tính
                $category = new CategoryModel();
                $category->setId($row['ID']);
                $category->setCategoryName($row['CategoryName']);
                $category->setDescription($row['Description']);

                // Thêm category vào mảng
                $categories[] = $category;
            }
            return $categories;
        }

        return []; // Nếu không có danh mục, trả về mảng rỗng
    }
}

?>