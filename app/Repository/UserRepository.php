<?php

require_once __DIR__ . '/../../config/config.php';

class UserRepository {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Hàm đăng ký người dùng
    public function createUser($user) {
        try {
            // Kiểm tra email đã tồn tại chưa
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "Email đã tồn tại!";
            }

            // Thêm user vào database
            $stmt = $this->pdo->prepare("INSERT INTO users (fullName, email, password, phone, role) 
                                         VALUES (:fullName, :email, :password, :phone, :role)");
            $stmt->bindParam(':fullName', $user->getFullName());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':password', $user->getPassword()); // Đã hash trước đó
            $stmt->bindParam(':phone', $user->getPhone());
            $stmt->bindParam(':role', $user->getRole());

            if ($stmt->execute()) {
                return true; // Thành công
            } else {
                return "Lỗi khi đăng ký!";
            }
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage();
        }
    }

    public function checkLogin($email, $password) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                return $user; // Trả về thông tin user nếu đúng mật khẩu
            }
            return false; // Đăng nhập thất bại
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage();
        }
    }
    
}
?>
