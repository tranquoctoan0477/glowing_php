<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glowing</title>

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
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/logo.png">
  <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-3.jpg">

</head>

<body id="top">

  <?php
  require_once __DIR__ . '/../app/controllers/ProductController.php';

  require_once __DIR__ . '/../app/controllers/CategoryController.php';

  $productController = new ProductController();
  ?>


  <!-- 
    - #HEADER
  -->

  <?php include 'header.php'; ?>
  <!-- 
    - #MOBILE NAVBAR
  -->

  <div class="sidebar">
    <div class="mobile-navbar" data-navbar>

      <div class="wrapper">
        <a href="#" class="logo">
          <img src="./assets/images/logo.png" width="179" height="26" alt="Glowing">
        </a>

        <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
          <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
        </button>
      </div>

      <ul class="navbar-list">

        <li>
          <a href="#home" class="navbar-link" data-nav-link>Home</a>
        </li>

        <li>
          <a href="#collection" class="navbar-link" data-nav-link>Collection</a>
        </li>

        <li>
          <a href="#shop" class="navbar-link" data-nav-link>Shop</a>
        </li>

        <li>
          <a href="#offer" class="navbar-link" data-nav-link>Offer</a>
        </li>

        <li>
          <a href="#blog" class="navbar-link" data-nav-link>Blog</a>
        </li>

      </ul>

    </div>

    <div class="overlay" data-nav-toggler data-overlay></div>
  </div>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero" id="home" aria-label="hero" data-section>
        <div class="container">

          <ul class="has-scrollbar">

            <li class="scrollbar-item">
              <div class="hero-card has-bg-image" style="background-image: url('./assets/images/hero-banner-1.jpg')">

                <div class="card-content">

                  <h1 class="h1 hero-title">
                    Reveal The <br>
                    Beauty of Skin
                  </h1>

                  <p class="hero-text">
                    Made using clean, non-toxic ingredients, our products are designed for everyone.
                  </p>

                  <p class="price">Starting at $7.99</p>

                  <a href="#" class="btn btn-primary">Shop Now</a>

                </div>

              </div>
            </li>

            <li class="scrollbar-item">
              <div class="hero-card has-bg-image" style="background-image: url('./assets/images/hero-banner-2.jpg')">

                <div class="card-content">

                  <h1 class="h1 hero-title">
                    Reveal The <br>
                    Beauty of Skin
                  </h1>

                  <p class="hero-text">
                    Made using clean, non-toxic ingredients, our products are designed for everyone.
                  </p>

                  <p class="price">Starting at $7.99</p>

                  <a href="#" class="btn btn-primary">Shop Now</a>

                </div>

              </div>
            </li>

            <li class="scrollbar-item">
              <div class="hero-card has-bg-image" style="background-image: url('./assets/images/hero-banner-3.jpg')">

                <div class="card-content">

                  <h1 class="h1 hero-title">
                    Reveal The <br>
                    Beauty of Skin
                  </h1>

                  <p class="hero-text">
                    Made using clean, non-toxic ingredients, our products are designed for everyone.
                  </p>

                  <p class="price">Starting at $7.99</p>

                  <a href="#" class="btn btn-primary">Shop Now</a>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #COLLECTION
      -->

      <section class="section collection" id="collection" aria-label="collection" data-section>
        <div class="container">

          <ul class="collection-list">

            <li>
              <div class="collection-card has-before hover:shine">

                <h2 class="h2 card-title">Summer Collection</h2>

                <p class="card-text">Starting at $17.99</p>

                <a href="#" class="btn-link">
                  <span class="span">Shop Now</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>

                <div class="has-bg-image" style="background-image: url('./assets/images/collection-1.jpg')"></div>

              </div>
            </li>

            <li>
              <div class="collection-card has-before hover:shine">

                <h2 class="h2 card-title">What’s New?</h2>

                <p class="card-text">Get the glow</p>

                <a href="#" class="btn-link">
                  <span class="span">Discover Now</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>

                <div class="has-bg-image" style="background-image: url('./assets/images/collection-2.jpg')"></div>

              </div>
            </li>

            <li>
              <div class="collection-card has-before hover:shine">

                <h2 class="h2 card-title">Buy 1 Get 1</h2>

                <p class="card-text">Starting at $7.99</p>

                <a href="#" class="btn-link">
                  <span class="span">Discover Now</span>

                  <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>

                <div class="has-bg-image" style="background-image: url('./assets/images/collection-3.jpg')"></div>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #SHOP
      -->

      <section class="section shop" id="shop" aria-label="shop" data-section>
        <div class="container">

          <div class="title-wrapper">
            <h2 class="h2 section-title">Our Bestsellers</h2>

            <a href="#" class="btn-link">
              <span class="span">Shop All Products</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>
          </div>
          <!-- Hiệu ứng loading -->
          <div id="loadingSpinner" style="display: none;">
            <div class="spinner">
              <ion-icon name="reload-circle-outline" style="font-size: 40px; color: #333;"></ion-icon>
            </div>
          </div>

          <ul class="has-scrollbar">

            <?php
            // Khởi tạo controller
            
            // Lấy 5 sản phẩm bán chạy nhất
            $topProductList = $productController->getTopSellingProducts();

            if (!empty($topProductList)) {
              foreach ($topProductList as $product) {
                echo '<li class="scrollbar-item">';
                echo '<div class="shop-card" data-id="' . $product->getId() . '">';

                // Card Banner (Hình ảnh sản phẩm)
                echo '<div class="card-banner img-holder" style="--width: 540; --height: 720;">';

                // Lấy đường dẫn ảnh từ cơ sở dữ liệu (đường dẫn đã lưu đúng)
                $imageURL = $product->getImageURL(); // Đảm bảo giá trị này đã lưu đúng, ví dụ: /assets/images/product/product-03.jpg
            
                // Hiển thị ảnh sản phẩm với đường dẫn chính xác
                echo '<img src="' . $imageURL . '" width="540" height="720" loading="lazy" alt="' . $product->getName() . '" class="img-cover">';
                echo '<span class="badge" aria-label="discount">-20%</span>';

                echo '<div class="card-actions">';
                echo '<button class="action-btn" aria-label="add to cart"><ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon></button>';
                echo '<button class="action-btn" aria-label="add to whishlist"><ion-icon name="star-outline" aria-hidden="true"></ion-icon></button>';
                echo '<button class="action-btn" aria-label="compare"><ion-icon name="repeat-outline" aria-hidden="true"></ion-icon></button>';
                echo '</div>'; // card-actions
                echo '</div>'; // card-banner
            
                // Card Content (Thông tin sản phẩm)
                echo '<div class="card-content">';
                echo '<div class="price">';
                echo '<del class="del">' . number_format($product->getVariantPrice(), 0, ',', '.') . ' VNĐ</del>'; // Giá gốc
                echo '<span class="span">' . number_format($product->getBasePrice(), 0, ',', '.') . ' VNĐ</span>'; // Giá sau giảm
                echo '</div>'; // price
            

                // Tên sản phẩm
                echo '<h3><a href="#" class="card-title">' . $product->getName() . '</a></h3>';

                echo '<h3><p class="card-title"> Đã bán: ' . $product->getSalesCount() . '</p></h3>';

                echo '</div>'; // card-content
                echo '</div>'; // shop-card
                echo '</li>'; // scrollbar-item
              }
            } else {
              echo "Không có sản phẩm bán chạy để hiển thị.";
            }
            ?>

          </ul>

        </div>
      </section>

      <section class="section shop" id="shop" aria-label="shop" data-section>
        <div class="container">

          <div class="title-wrapper">
            <h2 class="h2 section-title">Under 300.000 VND</h2>

            <a href="#" class="btn-link">
              <span class="span">Shop All Products</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>
          </div>

          <ul class="has-scrollbar">

            <?php

            $affordableProductList = $productController->getProductsByPriceLimit();

            // Kiểm tra nếu danh sách sản phẩm không rỗng
            if (!empty($affordableProductList)) {
              foreach ($affordableProductList as $product) {
                echo '<li class="scrollbar-item">';
                echo '<div class="shop-card">';

                // Card Banner (Hình ảnh sản phẩm)
                echo '<div class="card-banner img-holder" style="--width: 540; --height: 720;">';

                // Lấy đường dẫn ảnh từ cơ sở dữ liệu (đảm bảo giá trị đã lưu đúng)
                $imageURL = $product->getImageURL(); // Đảm bảo giá trị này đã lưu đúng, ví dụ: /assets/images/product/product-03.jpg
            
                // Hiển thị ảnh sản phẩm với đường dẫn chính xác
                echo '<img src="' . $imageURL . '" width="540" height="720" loading="lazy" alt="' . $product->getName() . '" class="img-cover">';
                echo '<div class="badge" aria-label="discount">-20%</div>'; // Cập nhật giá trị % giảm giá
                echo '<div class="card-actions">';
                echo '<button class="action-btn" aria-label="add to cart"><ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon></button>';
                echo '<button class="action-btn" aria-label="add to wishlist"><ion-icon name="star-outline" aria-hidden="true"></ion-icon></button>';
                echo '<button class="action-btn" aria-label="compare"><ion-icon name="repeat-outline" aria-hidden="true"></ion-icon></button>';
                echo '</div>'; // card-actions
                echo '</div>'; // card-banner
            
                // Card Content (Thông tin sản phẩm)
                echo '<div class="card-content">';
                echo '<div class="price">';
                echo '<del class="del">' . number_format($product->getBasePrice(), 0, ',', '.') . ' VNĐ</del>'; // Giá gốc
                echo '<span class="span">' . number_format($product->getVariantPrice(), 0, ',', '.') . ' VNĐ</span>'; // Giá sau giảm
                echo '</div>'; // price
            
                // Tên sản phẩm
                echo '<h3><a href="#" class="card-title">' . $product->getName() . '</a></h3>';

                echo '</div>'; // card-content
                echo '</div>'; // shop-card
                echo '</li>'; // scrollbar-item
              }
            } else {
              echo "Không có sản phẩm dưới 300,000 để hiển thị.";
            }
            ?>


          </ul>

        </div>
      </section>





      <!-- 
        - #BANNER
      -->

      <section class="section banner" aria-label="banner" data-section>
        <div class="container">

          <ul class="banner-list">

            <li>
              <div class="banner-card banner-card-1 has-before hover:shine">

                <p class="card-subtitle">New Collection</p>

                <h2 class="h2 card-title">Discover Our Autumn Skincare</h2>

                <a href="#" class="btn btn-secondary">Explore More</a>

                <div class="has-bg-image" style="background-image: url('./assets/images/banner-1.jpg')"></div>

              </div>
            </li>

            <li>
              <div class="banner-card banner-card-2 has-before hover:shine">

                <h2 class="h2 card-title">25% off Everything</h2>

                <p class="card-text">
                  Makeup with extended range in colors for every human.
                </p>

                <a href="#" class="btn btn-secondary">Shop Sale</a>

                <div class="has-bg-image" style="background-image: url('./assets/images/banner-2.jpg')"></div>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #FEATURE
      -->

      <section class="section feature" aria-label="feature" data-section>
        <div class="container">

          <h2 class="h2-large section-title">Why Shop with Glowing?</h2>

          <ul class="flex-list">

            <li class="flex-item">
              <div class="feature-card">

                <img src="./assets/images/feature-1.jpg" width="204" height="236" loading="lazy" alt="Guaranteed PURE"
                  class="card-icon">

                <h3 class="h3 card-title">Guaranteed PURE</h3>

                <p class="card-text">
                  All Grace formulations adhere to strict purity standards and will never contain harsh or toxic
                  ingredients
                </p>

              </div>
            </li>

            <li class="flex-item">
              <div class="feature-card">

                <img src="./assets/images/feature-2.jpg" width="204" height="236" loading="lazy"
                  alt="Completely Cruelty-Free" class="card-icon">

                <h3 class="h3 card-title">Completely Cruelty-Free</h3>

                <p class="card-text">
                  All Grace formulations adhere to strict purity standards and will never contain harsh or toxic
                  ingredients
                </p>

              </div>
            </li>

            <li class="flex-item">
              <div class="feature-card">

                <img src="./assets/images/feature-3.jpg" width="204" height="236" loading="lazy"
                  alt="Ingredient Sourcing" class="card-icon">

                <h3 class="h3 card-title">Ingredient Sourcing</h3>

                <p class="card-text">
                  All Grace formulations adhere to strict purity standards and will never contain harsh or toxic
                  ingredients
                </p>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #OFFER
      -->

      <section class="section offer" id="offer" aria-label="offer" data-section>
        <div class="container">

          <figure class="offer-banner">
            <img src="./assets/images/offer-banner-1.jpg" width="305" height="408" loading="lazy" alt="offer products"
              class="w-100">

            <img src="./assets/images/offer-banner-2.jpg" width="450" height="625" loading="lazy" alt="offer products"
              class="w-100">
          </figure>

          <div class="offer-content">

            <p class="offer-subtitle">
              <span class="span">Special Offer</span>

              <span class="badge" aria-label="20% off">-20%</span>
            </p>

            <h2 class="h2-large section-title">Mountain Pine Bath Oil</h2>

            <p class="section-text">
              Made using clean, non-toxic ingredients, our products are designed for everyone.
            </p>

            <div class="countdown">

              <span class="time" aria-label="days">15</span>
              <span class="time" aria-label="hours">21</span>
              <span class="time" aria-label="minutes">46</span>
              <span class="time" aria-label="seconds">08</span>

            </div>

            <a href="#" class="btn btn-primary">Get Only $39.00</a>

          </div>

        </div>
      </section>





      <!-- 
        - #BLOG
      -->

      <section class="section blog" id="blog" aria-label="blog" data-section>
        <div class="container">

          <h2 class="h2-large section-title">More to Discover</h2>

          <ul class="flex-list">

            <li class="flex-item">
              <div class="blog-card">

                <figure class="card-banner img-holder has-before hover:shine" style="--width: 700; --height: 450;">
                  <img src="./assets/images/blog-1.jpg" width="700" height="450" loading="lazy" alt="Find a Store"
                    class="img-cover">
                </figure>

                <h3 class="h3">
                  <a href="#" class="card-title">Find a Store</a>
                </h3>

                <a href="#" class="btn-link">
                  <span class="span">Our Store</span>

                  <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>

              </div>
            </li>

            <li class="flex-item">
              <div class="blog-card">

                <figure class="card-banner img-holder has-before hover:shine" style="--width: 700; --height: 450;">
                  <img src="./assets/images/blog-2.jpg" width="700" height="450" loading="lazy" alt="From Our Blog"
                    class="img-cover">
                </figure>

                <h3 class="h3">
                  <a href="#" class="card-title">From Our Blog</a>
                </h3>

                <a href="#" class="btn-link">
                  <span class="span">Our Store</span>

                  <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>

              </div>
            </li>

            <li class="flex-item">
              <div class="blog-card">

                <figure class="card-banner img-holder has-before hover:shine" style="--width: 700; --height: 450;">
                  <img src="./assets/images/blog-3.jpg" width="700" height="450" loading="lazy" alt="Our Story"
                    class="img-cover">
                </figure>

                <h3 class="h3">
                  <a href="#" class="card-title">Our Story</a>
                </h3>

                <a href="#" class="btn-link">
                  <span class="span">Our Store</span>

                  <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>

              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <?php include 'footer.php'; ?>




  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="assets/js/script.js"></script>


  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>