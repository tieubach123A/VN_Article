<?php
require_once 'includes/db.php';

// Lấy bài viết
$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
$articles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $articles[] = $row;
}

// Lấy danh mục
$query = "SELECT * FROM categories ORDER BY id ASC";
$result = mysqli_query($conn, $query);
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
$visible_categories = array_slice($categories, 0, 6);
$extra_categories = array_slice($categories, 6);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>VN Article - Trang chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap + Font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/VN_Article/assets/css/style.css">

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body style="background-color: #3487b6; margin: 0; padding: 0;">
    <div class="content-wrapper" style="background-color: #fcf8f6; margin: 30px; padding: 0;">
        <?php include 'includes/header.php'; ?>

        <div class="container">
            <!-- Logo -->
            <div class="d-flex justify-content-center align-items-center">
                <div class="logo-container">
                    <a href="index.php">
                        <img src="/VN_Article/assets/images/logo1.png" alt="VN Article Logo" class="logo img-fluid">
                    </a>
                </div>
            </div>

            <!-- Search -->
            <div class="container-fluid mt-3">
                <form class="d-flex justify-content-center" method="GET" action="search.php">
                    <div class="input-group w-75"
                        style="border: 2px solid #3487b6; border-radius: 50px; background-color: white;">
                        <input class="form-control border-0" type="search" name="query" placeholder="Tìm kiếm"
                            aria-label="Search" required style="background-color: white; color: #000;">
                        <span class="input-group-text border-0" style="background-color: white;">
                            <i class="bi bi-search" style="color: #3487b6;"></i>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories -->
        <div class="container mt-3">
            <div class="categories">
                <ul class="list-inline mb-0 text-center">
                    <?php foreach ($visible_categories as $category): ?>
                        <li class="list-inline-item mx-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="bi bi-house-door-fill"></i> <?= htmlspecialchars($category['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <?php if (count($extra_categories) > 0): ?>
                        <li class="list-inline-item mx-2">
                            <button class="btn btn-link text-decoration-none text-dark p-0" id="toggle-categories">
                                <i class="fas fa-chevron-down"></i> Xem thêm
                            </button>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if (count($extra_categories) > 0): ?>
                    <div class="row mt-3" id="extra-categories" style="display: none;">
                        <ul class="list-inline mb-0 text-center">
                            <?php foreach ($extra_categories as $category): ?>
                                <li class="list-inline-item mx-2">
                                    <a href="#" class="text-decoration-none text-dark">
                                        <i class="bi bi-house-door-fill"></i> <?= htmlspecialchars($category['name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Content -->
        <main class="container my-5">
            <!-- ===== Hero Section ===== -->
            <section id="hero" class="row g-4 mb-5">
                <article class="col-lg-8">
                    <div class="card">
                        <div class="ratio ratio-16x9">
                            <img src="assets/images/baonoibat1.jpg" alt="Featured" class="img-fluid"
                                style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h2 class="fw-bold text-primary">Dự thảo sửa đổi Hiến pháp 2013 được lấy ý kiến nhân dân</h2>
                            <p class="text-secondary">Sáng 6.5, Ủy ban dự thảo sửa đổi, bổ sung một số điều của Hiến pháp 2013 đã công bố dự thảo nghị quyết sửa đổi Hiến pháp để lấy ý kiến nhân dân.</p>
                        </div>
                    </div>
                </article>
                <aside class="col-lg-4">
                    <div class="d-flex mb-4 small-post">
                        <div class="ratio ratio-1x1 flex-shrink-0" style="width: 100px;">
                            <img src="assets/images/baonoibat2.jpg" alt="" class="img-fluid rounded" style="object-fit: cover;">
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">'Giáo viên dạy thêm không sai trái, quan trọng là chống tiêu cực'</h5>
                        </div>
                    </div>
                    <div class="d-flex mb-4 small-post">
                        <div class="ratio ratio-1x1 flex-shrink-0" style="width: 100px;">
                            <img src="assets/images/baonoibat3.jpg" alt="" class="img-fluid rounded" style="object-fit: cover;">
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Trường ĐH Y khoa Phạm Ngọc Thạch tiếp tục gửi công văn khẩn về hội đồng giáo sư</h5>
                        </div>
                    </div>
                    <div class="d-flex small-post">
                        <div class="ratio ratio-1x1 flex-shrink-0" style="width: 100px;">
                            <img src="assets/images/baonoibat4.jpg" alt="" class="img-fluid rounded" style="object-fit: cover;">
                        </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-1">Đang đà tăng mạnh, xuất khẩu rau quả đột ngột giảm sâu</h5>
                        </div>
                    </div>
                </aside>
            </section>

            <!-- ===== Latest News ===== -->
            <section id="latest-news" class="row g-4">
                <div class="col-lg-8">
                    <h3 class="h4 mb-4 border-bottom pb-2 text-primary">TIN MỚI</h3>
                    <!-- Bài viết mới -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php foreach ($articles as $article): ?>
                            <article class="col">
                                <div class="card mx-auto" style="max-width: 320px;">
                                    <div class="ratio ratio-16x9 overflow-hidden">
                                        <img src="<?= htmlspecialchars($article['image'] ?? 'assets/images/default.jpg') ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="img-fluid" style="object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-1"><?= htmlspecialchars($article['title']) ?></h5>
                                        <p class="text-secondary small"><?= htmlspecialchars(mb_strimwidth($article['content'], 0, 100, '...')) ?></p>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="col-lg-4">
                    <div class="mb-5">
                        <h4 class="h5 mb-3 text-primary">VIDEO</h4>
                        <div class="ratio ratio-16x9 rounded">
                            <iframe src="https://www.youtube.com/embed/…" title="Video" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-3 text-primary">Kết nối với chúng tôi</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-info">Facebook</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-info">Twitter</a></li>
                            <li><a href="#" class="text-decoration-none text-info">YouTube</a></li>
                        </ul>
                    </div>
                </aside>
            </section>
        </main>

        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- Toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-categories');
            const extraCategories = document.getElementById('extra-categories');

            if (toggleBtn && extraCategories) {
                toggleBtn.addEventListener('click', function() {
                    const isHidden = extraCategories.style.display === 'none' || extraCategories.style.display === '';
                    extraCategories.style.display = isHidden ? 'block' : 'none';
                    toggleBtn.innerHTML = isHidden ?
                        '<i class="fas fa-chevron-up"></i> Thu gọn' :
                        '<i class="fas fa-chevron-down"></i> Xem thêm';
                });
            }
        });
    </script>
</body>

</html>