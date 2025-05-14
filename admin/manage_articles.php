<!-- filepath: c:\xampp\htdocs\VN_Article\admin\manage_articles.php -->
<?php
require_once '../includes/db.php'; // Kết nối cơ sở dữ liệu

// Lấy danh sách bài viết từ cơ sở dữ liệu
$stmt = $conn->query("SELECT id, title, author, created_at FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài viết</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Quản lý bài viết</h1>

        <!-- Bảng danh sách bài viết -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($article['id']); ?></td>
                            <td><?php echo htmlspecialchars($article['title']); ?></td>
                            <td><?php echo htmlspecialchars($article['author']); ?></td>
                            <td><?php echo htmlspecialchars($article['created_at']); ?></td>
                            <td>
                                <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                                <a href="delete_article.php?id=<?php echo $article['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có bài viết nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Nút thêm bài viết -->
        <a href="add_article.php" class="btn btn-primary">Thêm bài viết mới</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>