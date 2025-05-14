<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VN Article</title>
    <!-- Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/VN_Article/assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="content-wrapper" style="background-color: #fcf8f6; margin: 30px; padding: 0; ">
        <nav class="navbar navbar-expand-lg text-white py-2"
            style="border-bottom: 2px solid #3487b6; margin-bottom: 20px; ">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Icon mặt trời/mặt trăng -->
                <button id="theme-toggle" class="btn btn-outline-light rounded-circle ms-3">
                    <i id="theme-icon" class="fas fa-sun"></i>
                </button>
                <!-- Thời gian -->
                <div class="text-muted fw-bold">
                    <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $days = [
                        'Monday' => 'Thứ Hai',
                        'Tuesday' => 'Thứ Ba',
                        'Wednesday' => 'Thứ Tư',
                        'Thursday' => 'Thứ Năm',
                        'Friday' => 'Thứ Sáu',
                        'Saturday' => 'Thứ Bảy',
                        'Sunday' => 'Chủ Nhật'
                    ];
                    $dayOfWeek = $days[date('l')];
                    echo date('H:i') . ' - ' . $dayOfWeek . ', ' . date('d/m/Y');
                    ?>
                </div>

                <!-- Nút toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu đầy đủ -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="/VN_Article/index.php" class="nav-link">Trang chủ</a></li>
                        <li class="nav-item"><a href="/VN_Article/login.php" class="nav-link">Đăng nhập</a></li>
                        <li class="nav-item"><a href="/VN_Article/register.php" class="nav-link">Đăng ký</a></li>
                        <li class="nav-item"><a href="/VN_Article/articles.php" class="nav-link">Bài viết</a></li>
                        <li class="nav-item"><a href="/VN_Article/categories.php" class="nav-link">Danh mục</a></li>
                        <li class="nav-item"><a href="/VN_Article/admin/dashboard.php" class="nav-link">Quản trị</a>
                        </li>
                        <li class="nav-item"><a href="/VN_Article/support.php" class="nav-link">Liên hệ</a></li>
                    </ul>
                </div>

                <!-- Biểu tượng người dùng -->
                <a href="/VN_Article/user.php" class="btn btn-outline-light rounded-circle ms-3" title="Trang cá nhân">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </nav>
    </div>
    <!-- Bootstrap JS từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Theme Toggle JS -->
    <script src="/VN_Article/assets/js/theme-toggle.js"></script>
</body>

</html>