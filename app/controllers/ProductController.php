<?php
require_once __DIR__ . '/../Repository/ProductRepository.php';  // Đảm bảo đường dẫn chính xác
require_once __DIR__ . '/../models/ProductModel.php'; // Đảm bảo đường dẫn chính xác

class ProductController
{
    private $productRepository;

    // ✅ Constructor để khởi tạo `ProductRepository` một lần duy nhất
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }


    // Phương thức lấy tất cả sản phẩm
    public function getAllProduct()
    {
        // Khởi tạo repository
        $productRepository = new ProductRepository();

        // Lấy dữ liệu sản phẩm từ repository
        $productsData = $productRepository->getAllProducts();

        // Kiểm tra nếu không có sản phẩm nào trong cơ sở dữ liệu
        if (empty($productsData)) {
            return [];  // Nếu không có sản phẩm, trả về mảng rỗng
        }

        // Duyệt qua dữ liệu và chỉ lấy các thông tin cần thiết: hình ảnh, tên sản phẩm và giá
        $productList = [];
        foreach ($productsData as $data) {
            // Khởi tạo ProductModel
            $product = new ProductModel();
            $product->setId($data['ID']);
            $product->setName($data['Name']);
            $product->setImageURL($data['ThumbnailImage']);
            $product->setBasePrice($data['BasePrice']);
            $product->setVariantPrice($data['VariantPrice']); // Dùng giá biến thể nếu có

            // Thêm vào mảng sản phẩm
            $productList[] = $product;
        }

        // Trả về dữ liệu sản phẩm
        return $productList;
    }

    // Phương thức lấy 5 sản phẩm bán chạy nhất
    public function getTopSellingProducts()
    {
        // Khởi tạo repository
        $productRepository = new ProductRepository();

        // Lấy 5 sản phẩm bán chạy nhất
        $topProductsData = $productRepository->getTopSellingProducts(7);

        // Kiểm tra nếu không có sản phẩm bán chạy
        if (empty($topProductsData)) {
            return [];  // Trả về mảng rỗng nếu không có sản phẩm bán chạy
        }

        // Duyệt qua dữ liệu và chỉ lấy các thông tin cần thiết: hình ảnh, tên sản phẩm, giá và số lượt bán
        $topProductList = [];
        foreach ($topProductsData as $data) {
            // Khởi tạo ProductModel
            $product = new ProductModel();
            $product->setId($data['ID']);
            $product->setName($data['Name']);
            $product->setImageURL($data['ThumbnailImage']);
            $product->setBasePrice($data['BasePrice']);
            $product->setVariantPrice($data['VariantPrice']);
            $product->setSalesCount($data['SalesCount']); // Số lượt bán của sản phẩm

            // Thêm vào mảng sản phẩm bán chạy
            $topProductList[] = $product;
        }

        // Trả về danh sách sản phẩm bán chạy
        return $topProductList;
    }

    public function getProductsByPriceLimit()
    {
        // Khởi tạo repository
        $productRepository = new ProductRepository();

        // Lấy các sản phẩm có VariantPrice < 300,000
        $affordableProductsData = $productRepository->getProductsByPriceLimit(300000);  // Thay đổi giá trị nếu cần

        // Kiểm tra nếu không có sản phẩm nào
        if (empty($affordableProductsData)) {
            return [];  // Trả về mảng rỗng nếu không có sản phẩm phù hợp
        }

        // Duyệt qua dữ liệu và chỉ lấy các thông tin cần thiết
        $affordableProductList = [];
        foreach ($affordableProductsData as $data) {
            // Khởi tạo ProductModel
            $product = new ProductModel();
            $product->setId($data['ID']);
            $product->setName($data['Name']);
            $product->setImageURL($data['ThumbnailImage']);
            $product->setBasePrice($data['BasePrice']);
            $product->setVariantPrice($data['VariantPrice']);
            $product->setSalesCount($data['SalesCount']); // Nếu cần

            // Thêm vào mảng sản phẩm có giá dưới 300,000
            $affordableProductList[] = $product;
        }

        // Trả về danh sách sản phẩm
        return $affordableProductList;
    }


    public function getProductById($id)
    {
        $productRepository = new ProductRepository();
        $data = $productRepository->findById($id);

        if (!$data) {
            return null; // Trả về null nếu không tìm thấy sản phẩm
        }

        // Tạo ProductModel từ dữ liệu database
        $product = new ProductModel();
        $product->setId($data['ID']);
        $product->setName($data['Name']);
        $product->setDescription($data['Description']);
        $product->setBasePrice($data['BasePrice']);
        $product->setCategoryId($data['CategoryID']);
        $product->setVariantName($data['VariantName']);
        $product->setVariantPrice($data['VariantPrice']);
        $product->setImageURL($data['ThumbnailImage']);
        $product->setStockQuantity($data['StockQuantity']); // Lấy tồn kho
        $product->setSalesCount($data['SalesCount']); // Lấy số lượng đã bán

        return $product;
    }

    // 📌 3️⃣ Lấy danh sách hình ảnh của tất cả sản phẩm có chung `is_default`

    public function getProductsBySameIsDefault($productId)
    {
        return $this->productRepository->getProductsBySameIsDefault($productId);
    }

    public function getProductImagesByProductId($productId)
    {
        $productRepository = new ProductRepository();
        return $productRepository->getProductImagesByProductId($productId);
    }


    public function filterProducts($category = null, $priceRange = null, $sort = null)
    {
        // Khởi tạo ProductRepository để lấy dữ liệu từ database
        $productRepository = new ProductRepository();

        // Gọi hàm lọc sản phẩm trong Repository
        $filteredProductsData = $productRepository->filterProducts($category, $priceRange, $sort);

        // Nếu không có sản phẩm, trả về mảng rỗng
        if (empty($filteredProductsData)) {
            return [];
        }

        // Chuyển dữ liệu thành danh sách ProductModel
        $filteredProducts = [];
        foreach ($filteredProductsData as $data) {
            $product = new ProductModel();
            $product->setId($data['ID']);
            $product->setName($data['Name']);
            $product->setImageURL($data['ThumbnailImage']);
            $product->setBasePrice($data['BasePrice']);
            $product->setVariantPrice($data['VariantPrice']);
            $product->setStockQuantity($data['StockQuantity']);

            $filteredProducts[] = $product;
        }

        return $filteredProducts;
    }

    public function getPaginatedProducts($page, $limit)
    {
        $productRepository = new ProductRepository();

        // Tính toán offset
        $offset = ($page - 1) * $limit;

        // Lấy danh sách sản phẩm
        $productsData = $productRepository->getProductsPaginated($limit, $offset);

        if (empty($productsData)) {
            return [];
        }

        // Tạo danh sách sản phẩm dưới dạng đối tượng ProductModel
        $productList = [];
        foreach ($productsData as $data) {
            $product = new ProductModel();
            $product->setId($data['ID']);
            $product->setName($data['Name']);
            $product->setImageURL($data['ThumbnailImage']);
            $product->setBasePrice($data['BasePrice']);
            $product->setVariantPrice($data['VariantPrice']);
            $productList[] = $product;
        }

        return $productList;
    }

    // Hàm lấy tổng số trang
    public function getTotalPages($limit)
    {
        $productRepository = new ProductRepository();
        $totalProducts = $productRepository->getTotalProducts();
        return ceil($totalProducts / $limit);
    }

    //tìm kiếm
    public function searchProducts($keyword)
    {
        $productRepository = new ProductRepository();
        return $productRepository->searchProducts($keyword);
    }

}
?>