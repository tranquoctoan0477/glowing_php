<?php
require_once __DIR__ . '/../app/controllers/ProductController.php';

// Kiểm tra nếu biến `page` không tồn tại hoặc không hợp lệ, gán mặc định là 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Số sản phẩm trên mỗi trang (mặc định là 8)
$limit = 8;

// Khởi tạo ProductController
$productController = new ProductController();
$products = $productController->getAllProduct();
$products = $productController->getPaginatedProducts($page, $limit);
$totalPages = $productController->getTotalPages($limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/styles.css">

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- 
  - custom css link
-->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- 
  - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- 
  - preload images
-->
    <link rel="preload" as="image" href="./assets/images/logo.png">
    <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
    <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
    <link rel="preload" as="image" href="./assets/images/hero-banner-3.jpg">
</head>

<body>

    <?php include 'header.php'; ?>
    <section id="shop-filter-bar" class="shop-section-p1">
        <div class="shop-container">
            <!-- Bộ lọc danh mục -->
            <div class="shop-col-md-3">
                <label for="shop-category-filter">Danh mục:</label>
                <select id="shop-category-filter" class="shop-form-control">
                    <option value="">Tất cả</option>
                    <option value="1">Serum</option>
                    <option value="2">Kem Dưỡng</option>
                    <option value="3">Sữa Rửa Mặt</option>
                </select>
            </div>

            <!-- Bộ lọc khoảng giá -->
            <div class="shop-col-md-3">
                <label for="shop-price-filter">Khoảng giá:</label>
                <select id="shop-price-filter" class="shop-form-control">
                    <option value="">Tất cả</option>
                    <option value="0-300000">Dưới 300.000 VNĐ</option>
                    <option value="300000-600000">300.000 - 600.000 VNĐ</option>
                    <option value="600000-">Trên 600.000 VNĐ</option>
                </select>
            </div>

            <!-- Sắp xếp sản phẩm -->
            <div class="shop-col-md-3">
                <label for="shop-sort-filter">Sắp xếp:</label>
                <select id="shop-sort-filter" class="shop-form-control">
                    <option value="">Mặc định</option>
                    <option value="asc">Giá tăng dần</option>
                    <option value="desc">Giá giảm dần</option>
                </select>
            </div>

            <!-- Nút áp dụng bộ lọc -->
            <div class="shop-col-md-2">
                <button id="shop-apply-filters" class="shop-btn shop-btn-dark">Lọc sản phẩm</button>
            </div>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <div class="prod-cont">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="prod">
                        <a href="product.php?id=<?= $product->getId(); ?>">
                            <img src="<?= htmlspecialchars($product->getImageURL()); ?>"
                                alt="<?= htmlspecialchars($product->getName()); ?>">
                        </a>
                        <div class="des">
                            <h5><?= htmlspecialchars($product->getName()); ?></h5>
                            <h4><?= number_format($product->getVariantPrice() ?? $product->getBasePrice(), 0, ',', '.'); ?> VNĐ
                            </h4>
                        </div>
                        <a href="product.php?id=<?= $product->getId(); ?>"><i class="fa-solid fa-cart-shopping cart"></i></a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sản phẩm nào!</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <?php if ($totalPages > 1): ?>
            <a href="?page=<?= max(1, $page - 1); ?>">&laquo;</a>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i; ?>" class="<?= ($i == $page) ? 'active' : ''; ?>"><?= $i; ?></a>
            <?php endfor; ?>
            <a href="?page=<?= min($totalPages, $page + 1); ?>">&raquo;</a>
        <?php endif; ?>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign up</button>
        </div>
    </section>

    <footer class="footer active" data-section>
        <div class="container">

            <div class="footer-top">

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Company</p>
                    </li>

                    <li>
                        <p class="footer-list-text">
                            Find a location nearest you. See <a href="#" class="link">Our Stores</a>
                        </p>
                    </li>

                    <li>
                        <p class="footer-list-text bold">+391 (0)35 2568 4593</p>
                    </li>

                    <li>
                        <p class="footer-list-text">hello@domain.com</p>
                    </li>

                </ul>

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Useful links</p>
                    </li>

                    <li>
                        <a href="#" class="footer-link">New Products</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Best Sellers</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Bundle & Save</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Online Gift Card</a>
                    </li>

                </ul>

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Infomation</p>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Start a Return</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Contact Us</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Shipping FAQ</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Terms & Conditions</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Privacy Policy</a>
                    </li>

                </ul>

                <div class="footer-list">

                    <p class="newsletter-title">Good emails.</p>

                    <p class="newsletter-text">
                        Enter your email below to be the first to know about new collections and product launches.
                    </p>

                    <form action="" class="newsletter-form">
                        <input type="email" name="email_address" placeholder="Enter your email address" required
                            class="email-field">

                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>

                </div>

            </div>

            <div class="footer-bottom">

                <div class="wrapper">
                    <p class="copyright">
                        &copy; 2022 codewithsadee
                    </p>

                    <ul class="social-list">

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-youtube"></ion-icon>
                            </a>
                        </li>

                    </ul>
                </div>

                <a href="#" class="logo">
                    <img src="./assets/images/logo.png" width="179" height="26" loading="lazy" alt="Glowing">
                </a>

                <img src="./assets/images/pay.png" width="313" height="28" alt="available all payment method"
                    class="w-100">

            </div>

        </div>
    </footer>

    <script src="assets/js/scriptshop.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>