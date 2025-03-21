<?php
session_start();
require_once __DIR__ . '/../../config/config.php'; // Load database trước
require_once __DIR__ . '/../repository/UserRepository.php';

class UserController
{
    private $userRepository;

    public function __construct($pdo)
    { // Đổi $db thành $pdo
        if (!$pdo) {
            die("Lỗi: Kết nối database thất bại. Kiểm tra lại config.php.");
        }
        $this->userRepository = new UserRepository($pdo);
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $fullName = trim($_POST["fullname"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $confirmPassword = trim($_POST["confirm_password"]);
            $phone = trim($_POST["phone"] ?? "");
            $role = "user"; // Mặc định vai trò là user

            // Kiểm tra CSRF Token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                echo json_encode(["status" => "error", "message" => "CSRF Token không hợp lệ!"]);
                exit();
            }

            // Kiểm tra các trường không được để trống
            if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
                echo json_encode(["status" => "error", "message" => "Vui lòng điền đầy đủ thông tin!"]);
                exit();
            }

            // Kiểm tra định dạng email hợp lệ
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["status" => "error", "message" => "Email không hợp lệ!"]);
                exit();
            }

            // Kiểm tra độ dài mật khẩu (tối thiểu 6 ký tự)
            if (strlen($password) < 6) {
                echo json_encode(["status" => "error", "message" => "Mật khẩu phải có ít nhất 6 ký tự!"]);
                exit();
            }

            // Kiểm tra mật khẩu có ít nhất 1 chữ hoa, 1 số và 1 ký tự đặc biệt
            if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W]/', $password)) {
                echo json_encode(["status" => "error", "message" => "Mật khẩu phải chứa ít nhất một chữ hoa, một số và một ký tự đặc biệt!"]);
                exit();
            }

            // Kiểm tra mật khẩu nhập lại
            if ($password !== $confirmPassword) {
                echo json_encode(["status" => "error", "message" => "Mật khẩu nhập lại không khớp!"]);
                exit();
            }

            // Kiểm tra số điện thoại hợp lệ (chỉ cho phép số từ 10 đến 15 ký tự)
            if (!empty($phone) && !preg_match('/^\d{10,15}$/', $phone)) {
                echo json_encode(["status" => "error", "message" => "Số điện thoại không hợp lệ!"]);
                exit();
            }

            // Mã hóa mật khẩu trước khi lưu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Gọi hàm từ UserRepository để đăng ký
            $result = $this->userRepository->registerUser($fullName, $email, $hashedPassword, $phone, $role);

            if ($result) {
                echo json_encode(["status" => "success", "message" => "Đăng ký thành công! Vui lòng đăng nhập."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Email đã tồn tại hoặc có lỗi xảy ra trong quá trình đăng ký!"]);
            }
            exit();
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST["email"] ?? '');
            $password = trim($_POST["password"] ?? '');

            // Kiểm tra dữ liệu đầu vào
            if (empty($email) || empty($password)) {
                echo json_encode(["status" => "error", "message" => "Vui lòng nhập email và mật khẩu!"]);
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["status" => "error", "message" => "Email không hợp lệ!"]);
                exit();
            }

            // Gọi UserRepository để kiểm tra tài khoản
            $user = $this->userRepository->loginUser($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    "id" => $user["ID"],
                    "fullname" => $user["FullName"],
                    "email" => $user["Email"],
                    "role" => $user["Role"]
                ];
                echo json_encode(["status" => "success", "message" => "Đăng nhập thành công!"]);
                exit();
            } else {
                echo json_encode(["status" => "error", "message" => "Email hoặc mật khẩu không đúng!"]);
                exit();
            }
        }
    }
}

// Kiểm tra nếu `$pdo` đã tồn tại trước khi tạo `UserController`
if (!isset($pdo)) {
    die("Lỗi: Biến `$pdo` chưa được khởi tạo từ config.php");
}

// **Khởi tạo UserController**
$controller = new UserController($pdo);

// Xử lý request
if (isset($_GET["action"])) {
    if ($_GET["action"] === "register") {
        $controller->register();
    } elseif ($_GET["action"] === "login") {
        $controller->login();
    } else {
        echo json_encode(["status" => "error", "message" => "Hành động không hợp lệ!"]);
        exit();
    }
} else {
    echo json_encode(["status" => "error", "message" => "Không có hành động nào được gửi!"]);
    exit();
}
?>
?>