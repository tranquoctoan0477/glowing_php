<?php
// Bắt đầu session để lưu trữ giỏ hàng
session_start();

// Kiểm tra nếu giỏ hàng đã được tạo ra trong session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hàm tính subtotal của mỗi sản phẩm
function calculateSubtotal($product)
{
    return $product['price'] * $product['quantity'];
}

// Tính tổng giỏ hàng
$total = 0;
foreach ($_SESSION['cart'] as $product) {
    $total += calculateSubtotal($product);
}
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

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Variant</td> <!-- Biến thể sản phẩm -->
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['cart'])):
                    foreach ($_SESSION['cart'] as $product_id => $product): ?>
                        <tr>
                            <td><a href="remove_from_cart.php?id=<?php echo $product_id; ?>"><i
                                        class="fa-regular fa-circle-xmark"></i></a></td>
                            <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['variant']; ?></td> <!-- Biến thể -->
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <input type="number" value="<?php echo $product['quantity']; ?>" min="1" max="10"
                                    onchange="updateQuantity(<?php echo $product_id; ?>, this.value)">
                            </td>
                            <td><?php echo number_format(calculateSubtotal($product), 0, ',', '.'); ?> VNĐ</td>
                            <!-- Subtotal -->
                        </tr>
                    <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="7">Giỏ hàng của bạn hiện tại trống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div class="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>

        <div class="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
                    <!-- Cập nhật subtotal từ các sản phẩm -->
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong></td>
                </tr>
            </table>
            <button class="normal">Proceed to checkout</button>
        </div>
    </section>

    <script>
        // Cập nhật số lượng trong giỏ hàng
        function updateQuantity(productId, quantity) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "api/update_cart.php", true); // Đảm bảo gửi đến đúng file update_cart.php
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        location.reload();  // Reload trang để cập nhật giỏ hàng
                    } else {
                        alert(response.message);  // Hiển thị thông báo lỗi nếu có
                    }
                }
            };
            xhr.send("product_id=" + productId + "&quantity=" + quantity);
        }

    </script>

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


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>