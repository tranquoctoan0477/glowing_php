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

        <div class="form-box login">
            <h2 class="animation" style="--i:0;--j:21;">Login</h2>
            <form id="login-form">
                <div class="input-box animation" style="--i:1;--j:22;">
                    <input type="email" name="email" id="login-email" required>
                    <label>Email</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:2;--j:23;">
                    <input type="password" name="password" id="login-password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>

                <!-- Hiển thị thông báo lỗi -->
                <div id="login-message" class="Notification"></div>

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

        <script>
            $(document).ready(function () {
                $("#login-form").submit(function (event) {
                    event.preventDefault(); // Ngăn chặn reload trang

                    let email = $("#login-email").val();
                    let password = $("#login-password").val();

                    $.ajax({
                        type: "POST",
                        url: "../app/controllers/UserController.php?action=login",
                        data: { email: email, password: password },
                        dataType: "json",
                        success: function (response) {
                            console.log("✅ Phản hồi từ server:", response); // Debug phản hồi từ server
                            if (response.status === "success") {
                                $("#login-message").html("<div class='alert alert-success'>" + response.message + "</div>");
                                setTimeout(function () {
                                    window.location.href = "index.php"; // Chuyển trang nếu đăng nhập thành công
                                }, 2000);
                            } else {
                                $("#login-message").html("<div class='alert alert-danger'>" + response.message + "</div>");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("❌ Lỗi AJAX:", xhr.responseText); // Debug lỗi AJAX nếu có
                            $("#login-message").html("<div class='alert alert-danger'>Có lỗi xảy ra! Kiểm tra console.</div>");
                        }
                    });
                });
            });
        </script>


        <?php
        // Tạo CSRF Token nếu chưa có
        if (!isset($_SESSION))
            session_start(); // Đảm bảo session đã khởi động
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        ?>

        <!-- Đăng Ký -->
        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0">Register</h2>
            <form id="register-form" action="../app/controllers/UserController.php?action=register" method="POST">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" name="fullname" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:19; --j:2">
                    <input type="email" name="email" id="register-email" required>
                    <label>Email</label>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" name="phone" required>
                    <label>Phone</label>
                    <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box animation" style="--i:20; --j:3">
                    <input type="password" name="password" id="register-password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock' id="generate-password"></i>
                </div>
                <div class="input-box animation" style="--i:21; --j:4">
                    <input type="password" name="confirm_password" id="register-confirm-password" required>
                    <label>Confirm Password</label>
                    <i class='bx bxs-lock'></i>
                </div>
                <div id="register-message" class="Notification"></div>
                <button type="submit" class="btn animation" style="--i:21; --j:4">Register</button>
                <div class="logreg-link animation" style="--i:22;--j:5">
                    <p>Don't have an account? <a href="#" class="login-link">Sign in</a></p>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function () {
                $("#register-form").submit(function (event) {
                    event.preventDefault(); // Ngăn chặn reload trang

                    let fullname = $("input[name='fullname']").val();
                    let email = $("#register-email").val();
                    let phone = $("input[name='phone']").val();
                    let password = $("#register-password").val();
                    let confirmPassword = $("#register-confirm-password").val();
                    let csrfToken = $("input[name='csrf_token']").val();

                    $.ajax({
                        type: "POST",
                        url: "../app/controllers/UserController.php?action=register",
                        data: { fullname, email, phone, password, confirm_password: confirmPassword, csrf_token: csrfToken },
                        dataType: "json",
                        success: function (response) {
                            console.log("✅ Phản hồi từ server:", response);
                            if (response.status === "success") {
                                $("#register-message").html("<div class='alert alert-success'>" + response.message + "</div>");
                                setTimeout(function () {
                                    window.location.href = "login.php"; // Chuyển trang nếu đăng ký thành công
                                }, 2000);
                            } else {
                                $("#register-message").html("<div class='alert alert-danger'>" + response.message + "</div>");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("❌ Lỗi AJAX:", xhr.responseText);
                            $("#register-message").html("<div class='alert alert-danger'>Có lỗi xảy ra! Kiểm tra console.</div>");
                        }
                    });
                });
            });
        </script>

        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0">WELCOME!</h2>
            <p class="animation" style="--i:18;--j:1">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        </div>
    </div>



    <script src="./assets/js/login.js"></script>
</body>

</html>