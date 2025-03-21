<?php

// Đảm bảo đường dẫn chính xác đến config.php
require_once __DIR__ . '/../../config/config.php';


class ProductRepository
{
    // Phương thức lấy tất cả sản phẩm
    public function getAllProducts()
    {
        $query = "SELECT p.ID, p.Name, p.Description, p.BasePrice, p.CategoryID, pv.VariantName, pv.VariantPrice, p.ThumbnailImage , pv.StockQuantity
                  FROM products p
                  LEFT JOIN product_variants pv ON p.ID = pv.ProductID";

        global $pdo;
        $stmt = $pdo->query($query);

        // Kiểm tra nếu có dữ liệu
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];  // Trả về mảng rỗng nếu không có sản phẩm
        }
    }

    // Hàm lấy 7 sản phẩm có số lượt bán cao nhất
    public function getTopSellingProducts($limit = 7)
    {
        global $pdo;
        // Chuẩn bị câu truy vấn SQL để lấy các sản phẩm bán chạy nhất
        $query = "SELECT p.ID, p.Name, p.BasePrice, pv.VariantName, pv.VariantPrice, p.ThumbnailImage, pv.SalesCount
                  FROM products p
                  JOIN product_variants pv ON p.ID = pv.ProductID
                  ORDER BY pv.SalesCount DESC
                  LIMIT :limit";

        // Sử dụng prepared statement để tránh SQL injection
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        // Kiểm tra nếu có dữ liệu trả về
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về dữ liệu sản phẩm bán chạy nhất
        }

        return []; // Trả về mảng rỗng nếu không có sản phẩm bán chạy
    }

    public function getProductsByPriceLimit($priceLimit = 300000)
    {
        global $pdo;
        // Chuẩn bị câu truy vấn SQL để lấy các sản phẩm có VariantPrice < 300,000
        $query = "SELECT p.ID, p.Name, p.BasePrice, pv.VariantName, pv.VariantPrice, p.ThumbnailImage, pv.SalesCount
              FROM products p
              JOIN product_variants pv ON p.ID = pv.ProductID
              WHERE pv.VariantPrice < :priceLimit
              ORDER BY pv.VariantPrice ASC";  // Sắp xếp sản phẩm theo giá tăng dần

        // Sử dụng prepared statement để tránh SQL injection
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':priceLimit', $priceLimit, PDO::PARAM_INT);
        $stmt->execute();

        // Kiểm tra nếu có dữ liệu trả về
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về dữ liệu sản phẩm có giá dưới 300,000
        }

        return []; // Trả về mảng rỗng nếu không có sản phẩm nào thỏa mãn điều kiện
    }


    public function findById($id)
    {
        global $pdo;

        $query = "SELECT  
                p.ID,  
                p.Name,   
                p.Description,  
                p.BasePrice, 
                p.CategoryID,
                pv.VariantName, 
                pv.VariantPrice, 
                p.ThumbnailImage, 
                pv.StockQuantity,  -- Đảm bảo lấy dữ liệu tồn kho
                pv.SalesCount       -- Đảm bảo lấy dữ liệu đã bán
              FROM products p
              LEFT JOIN product_variants pv ON p.ID = pv.ProductID
              WHERE p.ID = :id
              LIMIT 1";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về một mảng dữ liệu
    }

    public function getProductsBySameIsDefault($productId)
    {
        global $pdo;

        // Lấy giá trị `is_default` của sản phẩm hiện tại
        $query = "SELECT is_default FROM product_variants WHERE ProductID = :productId LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return []; // Trả về mảng rỗng nếu không có dữ liệu
        }

        $isDefaultValue = $result['is_default'];

        // Lấy tất cả sản phẩm có cùng `is_default`
        $query = "SELECT 
                p.ID, 
                p.Name, 
                p.BasePrice, 
                pv.VariantPrice, 
                pv.ImageURL, 
                pv.StockQuantity, 
                pv.SalesCount 
              FROM products p
              JOIN product_variants pv ON p.ID = pv.ProductID
              WHERE pv.is_default = :isDefault
              GROUP BY p.ID";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':isDefault', $isDefaultValue, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm
    }

    public function getProductImagesByProductId($productId)
    {
        global $pdo;

        $query = "SELECT pv.ImageURL, pv.VariantName, pv.VariantPrice, pv.StockQuantity, pv.SalesCount 
                  FROM product_variants pv
                  WHERE pv.ProductID = :productId";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách ảnh và thông tin sản phẩm
    }

    public function filterProducts($category = null, $priceRange = null, $sort = null)
    {
        global $pdo;

        // Bắt đầu câu truy vấn SQL
        $query = "SELECT p.ID, p.Name, p.BasePrice, p.ThumbnailImage, pv.VariantPrice, pv.StockQuantity 
              FROM products p
              LEFT JOIN product_variants pv ON p.ID = pv.ProductID 
              WHERE 1=1"; // Luôn đúng để dễ dàng thêm điều kiện lọc

        // Mảng để lưu các tham số ràng buộc
        $params = [];

        // 🔹 Lọc theo danh mục (nếu có)
        if (!empty($category)) {
            $query .= " AND p.CategoryID = :category";
            $params[':category'] = $category;
        }

        // 🔹 Lọc theo khoảng giá (nếu có)
        if (!empty($priceRange)) {
            $rangeParts = explode('-', $priceRange);
            if (count($rangeParts) == 2) {
                $query .= " AND pv.VariantPrice BETWEEN :minPrice AND :maxPrice";
                $params[':minPrice'] = $rangeParts[0];
                $params[':maxPrice'] = $rangeParts[1];
            } elseif ($rangeParts[0] !== '') {
                $query .= " AND pv.VariantPrice >= :minPrice";
                $params[':minPrice'] = $rangeParts[0];
            }
        }

        // 🔹 Sắp xếp sản phẩm (nếu có)
        if ($sort === 'asc') {
            $query .= " ORDER BY pv.VariantPrice ASC";
        } elseif ($sort === 'desc') {
            $query .= " ORDER BY pv.VariantPrice DESC";
        }

        // Chuẩn bị câu truy vấn và thực thi
        $stmt = $pdo->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_INT);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsPaginated($limit, $offset)
    {
        global $pdo;

        // Truy vấn lấy danh sách sản phẩm với phân trang
        $query = "SELECT p.ID, p.Name, p.Description, p.BasePrice, p.CategoryID, 
                     pv.VariantName, pv.VariantPrice, p.ThumbnailImage, pv.StockQuantity
              FROM products p
              LEFT JOIN product_variants pv ON p.ID = pv.ProductID
              LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm đếm tổng số sản phẩm
    public function getTotalProducts()
    {
        global $pdo;
        $query = "SELECT COUNT(*) as total FROM products";
        $stmt = $pdo->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function searchProducts($keyword)
    {
        global $pdo;
        $query = "SELECT p.ID, p.Name, p.ThumbnailImage, pv.VariantPrice 
              FROM products p 
              LEFT JOIN product_variants pv ON p.ID = pv.ProductID 
              WHERE p.Name LIKE :keyword";

        $stmt = $pdo->prepare($query);
        $searchTerm = "%$keyword%";
        $stmt->bindParam(':keyword', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        return $results;
    }



}
?>