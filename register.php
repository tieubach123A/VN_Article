<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $avatar = $_FILES['avatar'];

    // Kiểm tra mật khẩu và nhập lại mật khẩu
    if ($password !== $confirm_password) {
        $error = "Mật khẩu và nhập lại mật khẩu không khớp.";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Xử lý upload avatar
        $avatar_path = null;
        if (!empty($avatar['name'])) {
            $upload_dir = 'uploads/';
            $avatar_path = $upload_dir . basename($avatar['name']);
            if (!move_uploaded_file($avatar['tmp_name'], $avatar_path)) {
                $error = "Không thể upload hình ảnh.";
            }
        } else {
            $avatar_path = 'uploads/default-avatar.jpg'; // Đường dẫn ảnh đại diện mặc định
        }

        // Nếu không có lỗi, thêm người dùng vào cơ sở dữ liệu
        if (!isset($error)) {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, avatar, created_at, updated_at) 
                                    VALUES (:username, :email, :password, 'user', :avatar, NOW(), NOW())");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':avatar', $avatar_path);

            if ($stmt->execute()) {
                header('Location: login.php'); // Chuyển hướng đến trang đăng nhập
                exit();
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng ký tài khoản</title>
    <style>
        body {
            background-color: #3487b6;
            /* Màu nền */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
            /* Đảm bảo padding và border không ảnh hưởng đến kích thước */
        }

        /* Header */
        .login-container header {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Footer */
        .login-container footer {
            text-align: center;
            margin-top: px;
        }

        /* Login container */
        .login-container {
            background-color: #fcf8f6;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            /* Tăng chiều rộng tổng thể */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Row layout */
        .login-container .row {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }

        /* Logo section */
        .login-container .col-lg-6 {
            flex: 1;
            padding: 20px;
        }

        /* Form section */
        .login-container form {
            width: 100%;
        }

        /* Title */
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        /* Form group (label + input) */
        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        /* Focus state for inputs */
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus,
        .form-group input[type="text"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.3);
        }

        /* Form options: remember me and forgot password */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-options label {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #333;
        }

        .form-options input[type="checkbox"] {
            margin-right: 5px;
        }

        .forgot-password {
            font-size: 14px;
            color: #0056b3;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Login button */
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #003f7f;
        }

        /* Register link */
        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }

        .register-link a {
            color: #0056b3;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Error message */
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .action-links {
            margin-top: 15px;
            text-align: center;
        }

        .action-links a {
            color: #0056b3;
            text-decoration: none;
            margin: 0 10px;
        }

        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php if (isset($error)): ?>
        <div class="error-message text-center">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="login-container">
        <div class="row">
            <!-- Phần logo -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <a href="index.php">
                    <img src="assets/images/logo1.png" alt="Logo" class="img-fluid" style="max-width: 300px;">
                </a>
                <!-- Hình ảnh đại diện -->
                <label for="avatar" style="cursor: pointer;">
                    <img src="assets/images/avt.jpg" alt="Avatar" class="img-fluid"
                        style="max-width: 300px; border-radius: 50%;">
                </label>
                <!-- Input file ẩn -->
                <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;" required>
            </div>
            <!-- Phần form đăng nhập -->
            <div class="col-lg-6">
                <h2>Chào mừng bạn mới</h2>

                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Tên người dùng</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Nhập lại mật khẩu</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" class="login-button">Đăng ký</button>
                </form>
                <div class="action-links">
                    <a href="index.php">Tiếp tục không dùng tài khoản</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php if (isset($error))
    echo "<p class='text-danger'>$error</p>"; ?>