<!-- filepath: c:\xampp\htdocs\VN_Article\update_user.php -->
<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = 1; // ID người dùng (cần thay bằng giá trị thực tế)
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $password = $_POST['password'];
    $avatar = $_FILES['avatar'];

    // Xử lý avatar
    $avatarPath = null;
    if (!empty($avatar['name'])) {
        $avatarPath = 'uploads/' . basename($avatar['name']);
        move_uploaded_file($avatar['tmp_name'], $avatarPath);
    }

    // Xử lý mật khẩu
    $hashedPassword = null;
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    // Cập nhật thông tin người dùng
    $query = "UPDATE users SET username = :username, email = :email, bio = :bio";
    if ($hashedPassword) {
        $query .= ", password = :password";
    }
    if ($avatarPath) {
        $query .= ", avatar = :avatar";
    }
    $query .= " WHERE id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':bio', $bio);
    if ($hashedPassword) {
        $stmt->bindParam(':password', $hashedPassword);
    }
    if ($avatarPath) {
        $stmt->bindParam(':avatar', $avatarPath);
    }
    $stmt->bindParam(':id', $userId);

    if ($stmt->execute()) {
        header('Location: user.php');
        exit();
    } else {
        echo "Cập nhật thông tin thất bại.";
    }
}
?>