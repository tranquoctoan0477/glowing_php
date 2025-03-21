<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../Repository/UserRepository.php';

class UserController
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Đảm bảo session chỉ khởi động 1 lần
        }
    }

    // Xử lý đăng ký người dùng
    public function register()
    {
        header("Content-Type: application/json"); // Đảm bảo trả về JSON

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullName = trim($_POST['fullName'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $role = "user"; // Mặc định vai trò "user"

            // Kiểm tra thông tin hợp lệ
            if (empty($fullName) || empty($email) || empty($password)) {
                echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["success" => false, "message" => "Email không hợp lệ!"]);
                exit();
            }

            if (strlen($password) < 6) {
                echo json_encode(["success" => false, "message" => "Mật khẩu phải có ít nhất 6 ký tự!"]);
                exit();
            }

            // Kiểm tra email đã tồn tại chưa
            $emailExists = $this->userRepo->checkLogin($email, $password); // Dùng checkLogin để kiểm tra email
            if ($emailExists) {
                echo json_encode(["success" => false, "message" => "Email đã tồn tại!"]);
                exit();
            }

            // Mã hóa mật khẩu trước khi lưu vào database
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $user = new UserModel(null, $fullName, $email, $hashedPassword, $phone, $role);

            $result = $this->userRepo->createUser($user);
            if ($result === true) {
                echo json_encode(["success" => true, "message" => "Đăng ký thành công!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Lỗi đăng ký: " . $result]);
            }
            exit();
        }
    }

    // Xử lý đăng nhập người dùng
    public function login()
    {
        header("Content-Type: application/json"); // Đảm bảo trả về JSON

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = $this->userRepo->checkLogin($email, $password);
            if ($user) {
                // Chỉ lưu các thông tin quan trọng vào session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'fullName' => $user['fullName'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                echo json_encode(["success" => true, "redirect" => "../../public/index.php"]);
            } else {
                echo json_encode(["success" => false, "message" => "Email hoặc mật khẩu không đúng!"]);
            }
            exit();
        }
    }

    // Xử lý đăng xuất người dùng
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_unset(); // Xóa tất cả session
        session_destroy(); // Hủy session

        header("Location: ../../public/login.php"); // Chuyển hướng về trang đăng nhập
        exit();
    }
}

// Xử lý request từ form đăng ký, đăng nhập hoặc đăng xuất
if (isset($_GET['action'])) {
    $controller = new UserController();

    if ($_GET['action'] == "register") {
        $controller->register();
    } elseif ($_GET['action'] == "login") {
        $controller->login();
    } elseif ($_GET['action'] == "logout") {
        $controller->logout();
    }
}
?>
