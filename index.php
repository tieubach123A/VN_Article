<!-- filepath: c:\xampp\htdocs\VN_Article\index.php -->
<?php
require_once 'includes/db.php';
$stmt = $conn->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VN Article - Trang chủ</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/VN_Article/assets/css/style.css">
</head>

<body style="background-color: #3487b6; margin: 0; padding: 0;">
    <!-- Div lớn chứa toàn bộ nội dung -->
    <div class="content-wrapper" style="background-color: #fcf8f6; margin: 30px; padding: 0; ">
        <?php include 'includes/header.php'; ?>

        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <!-- Logo -->
                <div class="logo-container">
                    <a href="index.php">
                        <img src="/VN_Article/assets/images/logo1.png" alt="VN Article Logo" class="logo img-fluid">
                    </a>
                </div>
            </div>
            <!-- Search Bar -->
            <div class="container-fluid mt-3">
                <form class="d-flex justify-content-center" method="GET" action="search.php">
                    <div class="input-group w-75"
                        style="border: 2px solid #3487b6; border-radius: 50px; background-color: white; overflow: hidden;">
                        <input class="form-control border-0" type="search" name="query" placeholder="Tìm kiếm"
                            aria-label="Search" required style="background-color: white; color: #000;">
                        <span class="input-group-text border-0" style="background-color: white;">
                            <i class="bi bi-search" style="color: #3487b6;"></i>
                        </span>
                    </div>
                </form>
            </div>
        </div>
      
        <div class="container mt-3">
            <div class="categories">
                <ul class="list-inline mb-0 text-center">
                    <li class="list-inline-item mx-2">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-house-door-fill"></i> Trang chủ
                        </a>
                    </li>
                    <li class="list-inline-item mx-2">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-flag-fill"></i> Chính trị
                        </a>
                    </li>
                    <li class="list-inline-item mx-2">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-globe"></i> Thế giới
                        </a>
                    </li>
                    <li class="list-inline-item mx-2">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-bar-chart-fill"></i> Kinh tế
                        </a>
                    </li>
                    <li class="list-inline-item mx-2">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-people-fill"></i> Đời sống
                        </a>
                    </li>
                    <li class="list-inline-item mx-2">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="bi bi-heart-fill"></i> Sức khỏe
                        </a>
                    </li>
                    <li class="list-inline-item mx-2">
                        <button class="btn btn-link text-decoration-none text-dark p-0" id="toggle-categories">
                            <i class="fas fa-chevron-down"></i> Xem thêm
                        </button>
                    </li>
                </ul>
                <div class="row mt-3" id="extra-categories" style="display: none;">
                    <ul class="list-inline mb-0 text-center">
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-house-door-fill"></i> Trang chủ
                            </a>
                        </li>
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-flag-fill"></i> Chính trị
                            </a>
                        </li>
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-globe"></i> Thế giới
                            </a>
                        </li>
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-bar-chart-fill"></i> Kinh tế
                            </a>
                        </li>
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-people-fill"></i> Đời sống
                            </a>
                        </li>
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-heart-fill"></i> Sức khỏe
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-airplane"></i> Du lịch
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-book"></i> Văn hóa
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-film"></i> Giải trí
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-cpu"></i> Công nghệ
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-newspaper"></i> Thời sự
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-briefcase"></i> Kinh doanh
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-people"></i> Dân tộc và Tôn giáo
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-trophy"></i> Thể thao
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-gavel"></i> Pháp luật
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-car-front"></i> Ô tô xe máy
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-building"></i> Bất động sản
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-person"></i> Bạn đọc
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-calendar3"></i> Tuần Việt Nam
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-grid-3x3-gap"></i> Toàn văn
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-gear"></i> Công nghiệp hỗ trợ
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-shield-check"></i> Bảo vệ người tiêu dùng
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-cart"></i> Thị trường tiêu dùng
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-heart"></i> Giảm nghèo bền vững
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-seedling"></i> Nông thôn mới
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-map-fill"></i> Dân tộc thiểu số và miền núi
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-bookmark"></i> Nội dung chuyên đề
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- Đường kẻ -->

                <nav class="navbar navbar-expand-lg text-white py-2"
                    style="border-bottom: 2px solid #3487b6; margin-bottom: 20px; ;">
            </div>


            <!-- Main Content -->

            <body>
                <!-- Trong <head> của bạn, nhớ đã include Bootstrap 5 CSS -->
                <style>
                    /* CSS tùy chỉnh */
                    .featured-card img {
                        border-radius: 0.75rem;
                    }

                    .small-post img {
                        width: 100px;
                        height: 100px;
                        object-fit: cover;
                        border-radius: 0.5rem;
                    }

                    .small-post+.small-post {
                        margin-top: 1.5rem;
                    }
                </style>

                <body>
                    <main class="container my-5">

                        <!-- ===== Hero Section ===== -->
                        <section id="hero" class="row g-4 mb-5">
                            <!-- Bài viết nổi bật -->
                            <article class="col-lg-8">
                                <div class="card">
                                    <div class="ratio ratio-16x9">
                                        <img src="assets/images/baonoibat1.jpg" alt="Featured" class="img-fluid"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h2 class="fw-bold text-primary">Dự thảo sửa đổi Hiến pháp 2013 được lấy ý kiến
                                            nhân dân</h2>
                                        <p class="text-secondary">
                                            Sáng 6.5, Ủy ban dự thảo sửa đổi, bổ sung một số điều của Hiến pháp 2013 đã
                                            công bố
                                            dự thảo nghị quyết sửa đổi Hiến pháp để lấy ý kiến nhân dân.
                                        </p>
                                    </div>
                                </div>
                            </article>
                            <!-- 3 bài nhỏ bên cạnh -->
                            <aside class="col-lg-4">
                                <div class="d-flex mb-4 small-post">
                                    <div class="ratio ratio-1x1 flex-shrink-0" style="width: 100px;">
                                        <img src="assets/images/baonoibat2.jpg" alt="" class="img-fluid rounded"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold mb-1">'Giáo viên dạy thêm không sai trái, quan trọng là chống
                                            tiêu cực'</h5>
                                        <p class="text-secondary small mb-0"></p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4 small-post">
                                    <div class="ratio ratio-1x1 flex-shrink-0" style="width: 100px;">
                                        <img src="assets/images/baonoibat3.jpg" alt="" class="img-fluid rounded"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold mb-1">Trường ĐH Y khoa Phạm Ngọc Thạch tiếp tục gửi công văn
                                            khẩn về hội đồng giáo sư</h5>
                                        <p class="text-secondary small mb-0"></p>
                                    </div>
                                </div>
                                <div class="d-flex small-post">
                                    <div class="ratio ratio-1x1 flex-shrink-0" style="width: 100px;">
                                        <img src="assets/images/baonoibat4.jpg" alt="" class="img-fluid rounded"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="fw-bold mb-1">Đang đà tăng mạnh, xuất khẩu rau quả đột ngột giảm sâu
                                        </h5>
                                        <p class="text-secondary small mb-0"></p>
                                    </div>
                                </div>
                            </aside>
                        </section>

                        <!-- ===== Content Section ===== -->
                        <section id="content" class="row g-4">
                            <!-- Tin mới -->
                            <section id="latest-news" class="col-lg-8">
                                <h3 class="h4 mb-4 border-bottom pb-2 text-primary">TIN MỚI</h3>
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    <article class="col">
                                        <div class="card mx-auto" style="max-width: 320px;">
                                            <div class="ratio ratio-16x9 overflow-hidden">
                                                <img src="path/to/news1.jpg" alt="News 1" class="img-fluid"
                                                    style="object-fit: cover;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="fw-bold mb-1">Tiêu đề bài viết 1</h5>
                                                <p class="text-secondary small">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="col">
                                        <div class="card mx-auto" style="max-width: 320px;">
                                            <div class="ratio ratio-16x9 overflow-hidden">
                                                <img src="path/to/news2.jpg" alt="News 2" class="img-fluid"
                                                    style="object-fit: cover;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="fw-bold mb-1">Tiêu đề bài viết 2</h5>
                                                <p class="text-secondary small">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="col">
                                        <div class="card mx-auto" style="max-width: 320px;">
                                            <div class="ratio ratio-16x9 overflow-hidden">
                                                <img src="path/to/news3.jpg" alt="News 3" class="img-fluid"
                                                    style="object-fit: cover;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="fw-bold mb-1">Tiêu đề bài viết 3</h5>
                                                <p class="text-secondary small">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="col">
                                        <div class="card mx-auto" style="max-width: 320px;">
                                            <div class="ratio ratio-16x9 overflow-hidden">
                                                <img src="path/to/news4.jpg" alt="News 4" class="img-fluid"
                                                    style="object-fit: cover;">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="fw-bold mb-1">Tiêu đề bài viết 4</h5>
                                                <p class="text-secondary small">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </section>

                            <!-- Video & Links Sidebar -->
                            <aside id="sidebar" class="col-lg-4">
                                <div class="mb-5">
                                    <h4 class="h5 mb-3 text-primary">VIDEO</h4>
                                    <div class="ratio ratio-16x9 rounded">
                                        <iframe src="https://www.youtube.com/embed/…" title="Video"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-3 text-primary">Kết nối với chúng tôi</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><a href="#" class="text-decoration-none text-info">Facebook</a>
                                        </li>
                                        <li class="mb-2"><a href="#" class="text-decoration-none text-info">Twitter</a>
                                        </li>
                                        <li><a href="#" class="text-decoration-none text-info">YouTube</a></li>
                                    </ul>
                                </div>
                            </aside>
                        </section>

                    </main>
                </body>


            </body>

            <script>
                document.getElementById('toggle-categories').addEventListener('click', function () {
                    const extraCategories = document.getElementById('extra-categories');
                    const toggleIcon = this.querySelector('i');
                    if (extraCategories.style.display === 'none') {
                        extraCategories.style.display = 'block';
                        toggleIcon.classList.remove('fa-chevron-down');
                        toggleIcon.classList.add('fa-chevron-up');
                        this.innerHTML = '<i class="fas fa-chevron-up"></i> Thu gọn';
                    } else {
                        extraCategories.style.display = 'none';
                        toggleIcon.classList.remove('fa-chevron-up');
                        toggleIcon.classList.add('fa-chevron-down');
                        this.innerHTML = '<i class="fas fa-chevron-down"></i> Xem thêm';
                    }
                });
            </script>
            <?php include 'includes/footer.php'; ?>
        </div>
        <?php include 'includes/footer.php'; ?>
        </div>

        <!-- Bootstrap JS -->
        <script src="/VN_Article/assets/js/bootstrap.bundle.min.js"></script>

        <script src="/VN_Article/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/VN_Article/assets/js/theme-toggle.js"></script>
</body>

</html>