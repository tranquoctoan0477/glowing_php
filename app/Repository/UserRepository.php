<?php
class UserRepository {
    private $conn;

    public function __construct($pdo) {
        if (!$pdo) {
            die("Lỗi: Kết nối database thất bại. Kiểm tra lại config.php.");
        }
        $this->conn = $pdo;
    }

    // Kiểm tra email tồn tại
    public function isEmailExists($email) {
        $query = "SELECT * FROM users WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Đăng ký người dùng mới
    public function registerUser($fullName, $email, $password, $phone, $role = "user") {
        if ($this->isEmailExists($email)) {
            return false;
        }

        $query = "INSERT INTO users (FullName, Email, Password, Phone, Role) 
                  VALUES (:fullName, :email, :password, :phone, :role)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fullName", $fullName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":role", $role);

        return $stmt->execute();
    }

    // Hàm đăng nhập
    public function loginUser($email, $password) {
        $query = "SELECT * FROM users WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra mật khẩu đã hash
            if (password_verify($password, $user["Password"])) {
                return $user; // Trả về thông tin user nếu đăng nhập thành công
            } else {
                error_log("Lỗi đăng nhập: Mật khẩu không đúng cho email $email");
            }
        } else {
            error_log("Lỗi đăng nhập: Email không tồn tại $email");
        }

        return false; // Đăng nhập thất bại
    }
}
?>
