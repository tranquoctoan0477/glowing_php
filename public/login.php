<!-- <?php
session_start(); // Bắt đầu session ngay đầu file
?> -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowing</title>

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <link rel="stylesheet" href="./assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

         <!-- Hiển thị thông báo lỗi hoặc thành công -->
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <div class="form-box login">
            <h2 class="animation" style="--i:0;--j:21;">Login</h2>
            <form id="login-form" action="../app/controllers/UserController.php?action=login" method="POST">
                <div class="input-box animation" style="--i:1;--j:22;">
                    <input type="text" name="email" id="login-username" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:2;--j:23;">
                    <input type="password"  name="password" id="register-passwordDN" required>
                    <label>Password</label>
                    <i class='bx bxs-lock' id="show-password"></i>
                </div>
                <button type="submit" class="btn animation" style="--i:3;--j:24;">Đăng Nhập</button>
                <div class="logreg-link animation" style="--i:4;--j:25;">
                    <p>Don't have an account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
            </form>
        </div>
        <div class="info-text login">
            <h2 class="animation" style="--1:0; --j:20">WELCOME BACK!</h2>
            <p class="animation" style="--1:1;--j:21">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        </div>

        <!-- Đăng Ký -->
        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0">Register</h2>
            <form id="register-form" action="../app/controllers/UserController.php?action=register" method="POST">
                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" name="fullName" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:19; --j:2">
                    <input type="email" name="email" id="register-email" required>
                    <label>Email</label>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box animation" style="--i:20; --j:3">
                    <input type="password" name="password" id="register-password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock' id="generate-password"></i>
                </div>
                <button type="submit" class="btn animation" style="--i:21; --j:4">Register</button>
                <div class="logreg-link animation" style="--i:22;--j:5">
                    <p>Don't have an account? <a href="#" class="login-link">Sign in</a></p>
                </div>
            </form>
        </div>
        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0">WELCOME!</h2>
            <p class="animation" style="--i:18;--j:1">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        </div>
    </div>

    <!-- Popup Thông báo -->
    <!-- <div id="notification-popup" class="popup-overlay">
        <div class="popup-box">
            <div class="popup-header">
                <h2 id="popup-title">Thông báo</h2>
                <span class="popup-close" onclick="closePopup()">×</span>
            </div>
            <div class="popup-body">
                <p id="popup-message">Nội dung thông báo...</p>
            </div>
            <div class="popup-footer">
                <button onclick="closePopup()">Đóng</button>
            </div>
        </div>
    </div> -->

    <!-- <?php
    // Kiểm tra nếu có thông báo trong session
    if (isset($_SESSION['notify'])) {
        $notifyData = $_SESSION['notify'];
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            showPopup('" . addslashes($notifyData['title']) . "', '" . addslashes($notifyData['message']) . "');
        });
    </script>";
        unset($_SESSION['notify']); // Xóa session sau khi hiển thị
    }
    ?>


    <script>
        function showPopup(title, message) {
            document.getElementById("popup-title").innerText = title;
            document.getElementById("popup-message").innerText = message;
            document.getElementById("notification-popup").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("notification-popup").style.display = "none";
        }
    </script> -->



    <script src="./assets/js/login.js"></script>
</body>

</html>