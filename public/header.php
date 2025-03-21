<header class="header">

  <div class="alert">
    <div class="container">
      <p class="alert-text">Free Shipping On All U.S. Orders $50+</p>
    </div>
  </div>

  <div class="header-top" data-header>
    <div class="container">

      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <span class="line line-1"></span>
        <span class="line line-2"></span>
        <span class="line line-3"></span>
      </button>

      <div class="input-wrapper">
        <input type="search" name="search" placeholder="Search product" class="search-field">

        <button class="search-submit" aria-label="search">
          <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
        </button>
      </div>

      <a href="#" class="logo">
        <img src="./assets/images/logo.png" width="179" height="26" alt="Glowing">
      </a>

      <div class="header-actions">

        <a href="login.php">
          <button class="header-action-btn" aria-label="user">
            <ion-icon name="person-outline" aria-hidden="true" aria-hidden="true"></ion-icon>
          </button>
        </a>

        <button class="header-action-btn" aria-label="favourite item">
          <ion-icon name="star-outline" aria-hidden="true" aria-hidden="true"></ion-icon>

          <span class="btn-badge">0</span>
        </button>

        <a href="cart.php">
          <button class="header-action-btn" aria-label="cart item">
            <data class="btn-text" value="0">$0.00</data>

            <ion-icon name="bag-handle-outline" aria-hidden="true" aria-hidden="true"></ion-icon>

            <span class="btn-badge">0</span>
          </button>
        </a>

      </div>

      <nav class="navbar">
        <ul class="navbar-list">

          <li>
            <a href="index.php" class="navbar-link has-after">Home</a>
          </li>

          <li>
            <a href="#collection" class="navbar-link has-after">Collection</a>
          </li>

          <!-- Dropdown menu cho Shop -->
          <li class="navbar-item dropdown">
            <a href="shop.php" class="navbar-link has-after">Shop</a>
            <ul class="dropdown-menu">
              <?php
              // Kết nối với CategoryController và lấy danh sách categories
              require_once $_SERVER['DOCUMENT_ROOT'] . '/glowing-master/app/controllers/CategoryController.php';

              // Tạo instance CategoryController để gọi hàm lấy danh mục
              $categoryController = new CategoryController();
              $categories = $categoryController->getCategories(); // Giả sử bạn đã có hàm này trong CategoryController
              
              // Lặp qua các danh mục và hiển thị chúng trong dropdown
              if (!empty($categories)) {
                foreach ($categories as $category) {
                  echo '<li><a href="#">' . $category->getCategoryName() . '</a></li>';
                }
              } else {
                echo '<li><a href="#">No Categories Available</a></li>';
              }
              ?>
            </ul>
          </li>

          <li>
            <a href="#offer" class="navbar-link has-after">Offer</a>
          </li>

          <li>
            <a href="#blog" class="navbar-link has-after">Blog</a>
          </li>

        </ul>
      </nav>

    </div>
  </div>

</header>