<?php
require_once '../includes/db.php';

// Xử lý tham số
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$status = isset($_GET['status']) && $_GET['status'] !== '' ? intval($_GET['status']) : null;
$category_id = isset($_GET['category_id']) && $_GET['category_id'] !== '' ? intval($_GET['category_id']) : null;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 10; // Số bài viết mỗi trang
// Lấy tất cả danh mục
$stmt = $conn->query("SELECT id, name FROM categories ORDER BY name");
$sql = "SELECT * FROM articles";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

$articles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $articles[] = $row;
}




// Điều kiện WHERE
$where = [];
$params = [];

if (!empty($search)) {
    $where[] = "(title LIKE :search OR content LIKE :search OR author LIKE :search)";
    $params[':search'] = "%$search%";
}

if ($status !== null) {
    $where[] = "status = :status";
    $params[':status'] = $status;
}
if ($category_id !== null) {
    $where[] = "category_id = :category_id";
    $params[':category_id'] = $category_id;
}


$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// Lấy tổng số bài viết
$stmt = $conn->prepare("SELECT COUNT(*) FROM articles $where_clause");
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();
$total_articles = $stmt->fetchColumn();
$total_pages = ceil($total_articles / $per_page);

// Lấy danh sách bài viết
$offset = ($page - 1) * $per_page;
$sql = "SELECT a.id, a.title, a.author, a.status, a.cover_image, a.created_at, a.updated_at, c.name AS category_name
        FROM articles a
        LEFT JOIN categories c ON a.category_id = c.id
        $where_clause 
        ORDER BY a.created_at DESC 
        LIMIT :offset, :per_page";


$stmt = $conn->prepare($sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý bài viết - VN Article</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .status-badge {
            font-size: 0.8rem;
            padding: 3px 8px;
        }

        .article-title {
            font-weight: 500;
        }

        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .article-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .article-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .cover-thumb {
            width: 60px;
            height: 40px;
            object-fit: cover;
            border-radius: 3px;
        }

        .main-content {
            margin-left: 16.666667%;
            padding: 20px;
        }

        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">VN Article Admin</a>
            <a href="logout.php" class="btn btn-outline-light">Sign Out</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (sẽ được load từ file riêng) -->
            <div id="sidebar-container"></div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container-fluid py-4">
                    <!-- Nội dung chính của bạn ở đây -->
                    <div class="row">
                        <div class="col-12">
                            <h1 class="h3 mb-4">Quản lý bài viết</h1>



                            <!-- Tìm kiếm và tabs -->
                            <form method="GET" class="d-flex justify-content-between align-items-center mb-4">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link <?= $status === null ? 'active' : '' ?>" href="?<?= build_query_string(['status' => '']) ?>">Tất cả (<?= $total_articles ?>)</a>

                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $status === 1 ? 'active' : '' ?>" href="?<?= build_query_string(['status' => 1]) ?>">Đã xuất bản (<?= get_count_by_status(1) ?>)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $status === 0 ? 'active' : '' ?>" href="?<?= build_query_string(['status' => 0]) ?>">Bản nháp (<?= get_count_by_status(0) ?>)</a>
                                    </li>
                                </ul>

                                <div class="ms-3" style="width: 300px;">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Tìm kiếm..." value="<?= htmlspecialchars($search) ?>">
                                        <?php if ($status !== null): ?>
                                            <input type="hidden" name="status" value="<?= $status ?>">
                                        <?php endif; ?>
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Bộ lọc -->
                            <div class="filter-section mb-4">
                                <form method="GET" class="row g-3 align-items-center">
                                    <!-- Dropdown Sắp xếp -->
                                    <div class="col-md-2">
                                        <select name="sort" class="form-select" onchange="this.form.submit()">
                                            <option value="">Sắp xếp</option>
                                            <option value="newest" <?= isset($_GET['sort']) && $_GET['sort'] === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                                            <option value="oldest" <?= isset($_GET['sort']) && $_GET['sort'] === 'oldest' ? 'selected' : '' ?>>Cũ nhất</option>
                                        </select>
                                    </div>

                                    <!-- Dropdown Danh mục -->
                                    <div class="col-md-3">
                                        <select name="category_id" class="form-select" onchange="this.form.submit()">
                                            <option value="">Tất cả danh mục</option>
                                            <?php foreach ($all_categories as $cat): ?>
                                                <option value="<?= $cat['id'] ?>"
                                                    <?= $category_id == $cat['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($cat['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Các tham số ẩn -->
                                    <?php if (!empty($search)): ?>
                                        <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                                    <?php endif; ?>
                                    <?php if ($status !== null): ?>
                                        <input type="hidden" name="status" value="<?= $status ?>">
                                    <?php endif; ?>
                                </form>
                            </div>
                            <!-- Danh sách bài viết -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="50px"></th>
                                            <th>Tiêu đề</th>
                                            <th>Tác giả</th>
                                            <th>Danh mục</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($articles as $article): ?>
                                            <tr>
                                                <td>
                                                    <?php if ($article['cover_image']): ?>
                                                        <img src="<?= htmlspecialchars($article['cover_image']) ?>" class="cover-thumb" alt="Cover">
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="article-title"><?= htmlspecialchars($article['title']) ?></div>
                                                    <div class="article-meta">
                                                        Cập nhật: <?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?>
                                                    </div>
                                                </td>
                                                <td><?= htmlspecialchars($article['author']) ?></td>
                                                <td><?= htmlspecialchars($article['category_name'] ?? 'Chưa chọn') ?></td>
                                                <td><?= date('d/m/Y', strtotime($article['created_at'])) ?></td>
                                                <td>
                                                    <span class="badge <?= $article['status'] ? 'bg-success' : 'bg-secondary' ?> status-badge">
                                                        <?= $article['status'] ? 'Đã xuất bản' : 'Bản nháp' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                                                    <a href="delete_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa bài viết này?')">Xóa</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Phân trang -->
                            <nav aria-label="Page navigation" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?<?= build_query_string(['page' => $page - 1]) ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?<?= build_query_string(['page' => $i]) ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?<?= build_query_string(['page' => $page + 1]) ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </main>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Hàm hỗ trợ
function get_count_by_status($status)
{
    global $conn;
    if ($status === null) {
        $stmt = $conn->query("SELECT COUNT(*) FROM articles");
    } else {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM articles WHERE status = ?");
        $stmt->execute([$status]);
    }
    return $stmt->fetchColumn();
}


function build_query_string($new_params = [])
{
    $params = array_filter($_GET ?? [], function ($value) {
        return is_scalar($value);
    });

    // Giữ lại các tham số hợp lệ
    $allowed = ['search', 'status', 'category_id', 'sort', 'page'];
    $params = array_intersect_key($params, array_flip($allowed));

    // Ghi đè bằng tham số mới
    $params = array_merge($params, $new_params);

    // Luôn xóa page khi thay đổi filter (trừ khi đang phân trang)
    if (!isset($new_params['page'])) {
        unset($params['page']);
    }

    return http_build_query($params);
}


?>
<!-- Load sidebar từ file riêng -->
<script>
    fetch('sidebar.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('sidebar-container').innerHTML = data;
        });
</script>

</body>

</html>