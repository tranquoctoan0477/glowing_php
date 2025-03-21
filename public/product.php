<?php
require_once __DIR__ . '/../app/controllers/ProductController.php';

// Kiểm tra xem có `id` sản phẩm trong URL không
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Sản phẩm không tồn tại!");
}

$productId = intval($_GET['id']);
$productController = new ProductController();
$product = $productController->getProductById($productId);
$relatedProducts = $productController->getProductsBySameIsDefault($productId);
$productImages = $productController->getProductImagesByProductId($productId);



// Nếu sản phẩm tồn tại, lấy dữ liệu từ database
if ($product) {
  $productName = htmlspecialchars($product->getName());
  $productPrice = number_format($product->getVariantPrice(), 0, ',', '.') . " VNĐ";
  $productDescription = nl2br(htmlspecialchars($product->getDescription()));
  $productImage = htmlspecialchars($product->getImageURL());
  $stockQuantity = $product->getStockQuantity();
  $salesCount = $product->getSalesCount();
} else {
  // Nếu sản phẩm không tồn tại, đặt giá trị mặc định
  $productName = "Lỗi";
  $productPrice = "không có ";
  $productDescription = "Lỗi";
  $productImage = "assets/images/product-01.jpg";
  $stockQuantity = "Không có thông tin"; // Giá trị mặc định
  $salesCount = "Không có thông tin"; // Giá trị mặc định
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glowing</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="preload" as="image" href="./assets/images/logo.png">
  <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-3.jpg">

  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>

  <?php include 'header.php'; ?>

  <section id="prodetails" class="section-p1">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="single-pro-img">
            <img src="<?= $productImage; ?>" alt="Product Image" id="MainImg" width="100%">
            <div class="small-img-group">
              <?php if (!empty($productImages)): ?>
                <?php foreach ($productImages as $image): ?>
                  <div class="col-sm-3">
                    <img src="<?= htmlspecialchars($image['ImageURL']); ?>" alt="Ảnh biến thể sản phẩm" class="small-img"
                      width="100%" onclick="changeProductDetails(
                        '<?= htmlspecialchars($image['ImageURL']); ?>',
                        '<?= htmlspecialchars($image['VariantName'] ?? $productName); ?>',
                        '<?= number_format($image['VariantPrice'] ?? $product->getVariantPrice(), 0, ',', '.'); ?> VNĐ',
                        '<?= $image['StockQuantity'] ?? $product->getStockQuantity(); ?>',
                        '<?= $image['SalesCount'] ?? $product->getSalesCount(); ?>'
                     )">
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="single-pro-details">
            <h6>Home / T-Shirt</h6>
            <h4 id="product-name"><?= $productName; ?></h4>
            <h2 id="product-price"><?= $productPrice; ?></h2>
            <h3 id="stock-quantity"><strong>Tồn kho:</strong> <?= $stockQuantity; ?></h3>
            <h3 id="sales-count"><strong>Đã bán:</strong> <?= $salesCount; ?></h3>
            <select>
              <option>Select Size</option>
              <option>S</option>
              <option>M</option>
              <option>L</option>
              <option>XL</option>
              <option>XXL</option>
            </select>
            <input type="number" value="1">
            <button class="normal">Add To Cart</button>
            <h4>Product Details</h4>
            <span id="product-description"><?= $productDescription; ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="product1" class="section-p1">
    <h2>Sản phẩm liên quan</h2>
    <div class="prod-cont">
      <?php if (!empty($relatedProducts)): ?>
        <?php foreach ($relatedProducts as $product): ?>
          <div class="prod">
            <a href="product.php?id=<?= $product['ID']; ?>">
              <img src="<?= htmlspecialchars($product['ImageURL']); ?>" alt="<?= htmlspecialchars($product['Name']); ?>">
            </a>
            <div class="des">
              <span>Danh mục</span>
              <h5><?= htmlspecialchars($product['Name']); ?></h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4><?= number_format($product['VariantPrice'], 0, ',', '.'); ?> VNĐ</h4>
            </div>
            <a href="product.php?id=<?= $product['ID']; ?>">
              <i class="fa-solid fa-cart-shopping cart"></i>
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Không có sản phẩm liên quan.</p>
      <?php endif; ?>
    </div>
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

        <img src="./assets/images/pay.png" width="313" height="28" alt="available all payment method" class="w-100">

      </div>

    </div>
  </footer>

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
  </a>

  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script>
    function changeProductDetails(imageUrl, variantName, price, stock, sales) {
      // Thay đổi ảnh chính
      document.getElementById("MainImg").src = imageUrl;

      // Cập nhật thông tin sản phẩm
      document.getElementById("product-name").innerText = variantName;
      document.getElementById("product-price").innerText = price;
      document.getElementById("stock-quantity").innerText = "Tồn kho: " + stock;
      document.getElementById("sales-count").innerText = "Đã bán: " + sales;
    }
  </script>



</body>

</html>