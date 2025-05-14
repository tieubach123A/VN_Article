<!-- filepath: c:\xampp\htdocs\VN_Article\index.php -->
<?php
require_once 'includes/db.php';
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit();
}

// Lấy thông tin người dùng từ phiên
$username = $_SESSION['username'];
$userId = $_SESSION['user_id'];

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
    <style>
        .content-wrapper {
            background-color: #fcf8f6;
            margin: 30px auto;
            padding: 0;
            max-width: 1200px;
            /* Đảm bảo chiều rộng cố định */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Tùy chọn: thêm hiệu ứng đổ bóng */
        }

        .content-wrapper>* {
            margin: 0;
            /* Loại bỏ margin giữa các phần tử con */
            padding: 0;
        }

        /* Avatar */
        img.rounded-circle {
            border: 2px solid #ddd;
            padding: 5px;
        }

        /* Nút chỉnh sửa */
        #edit-profile {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Danh sách bài viết */
        .list-group-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body style="background-color: #3487b6; margin: 0; padding: 0;">
    <!-- Div lớn chứa toàn bộ nội dung -->
    <div class="content-wrapper m-3">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <!-- Nội dung chính -->
        <div class="container py-4">
            <!-- Hàng đầu tiên: Avatar và thông tin người dùng -->
            <div class="row mb-4">
                <!-- Avatar bên trái -->
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="assets/images/avt.jpg" alt="Avatar" class="img-fluid rounded-circle"
                        style="max-width: 200px;">
                </div>
                <!-- Thông tin người dùng bên phải -->
                <div class="col-md-8">
                    <h3 class="mb-3"><span id="username"><?php echo htmlspecialchars($username); ?></span></h3>
                    <p>Email: <span id="email">nguyenvana@gmail.com</span></p>
                    <p>Bio: <span id="bio">Đây là phần giới thiệu ngắn gọn về người dùng.</span></p>
                    <button class="btn btn-primary mt-3" id="edit-profile" data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
                        <i class="fas fa-edit"></i> Chỉnh sửa thông tin
                    </button>
                </div>
            </div>

            <!-- Modal chỉnh sửa thông tin -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="update_user.php" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileModalLabel">Chỉnh sửa thông tin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="edit-username">Tên người dùng</label>
                                    <input type="text" class="form-control" id="edit-username" name="username"
                                        value="<?php echo htmlspecialchars($username); ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit-email">Email</label>
                                    <input type="email" class="form-control" id="edit-email" name="email"
                                        value="nguyenvana@gmail.com" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit-bio">Bio</label>
                                    <textarea class="form-control" id="edit-bio" name="bio"
                                        rows="3">Đây là phần giới thiệu ngắn gọn về người dùng.</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit-password">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="edit-password" name="password">
                                    <small class="text-muted">Để trống nếu không muốn thay đổi mật khẩu.</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="edit-avatar">Avatar</label>
                                    <input type="file" class="form-control" id="edit-avatar" name="avatar"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hàng thứ hai: Danh sách bài viết đã xem -->
            <div class="row">
                <h4 class="mb-3">Danh sách bài viết đã xem</h4>
                <div class="col-12">
                    <div class="list-group">
                        <?php
                        // Giả sử bạn có một bảng `viewed_articles` để lưu các bài viết đã xem
                        $stmt = $conn->prepare("SELECT articles.id, articles.title FROM viewed_articles 
                                                JOIN articles ON viewed_articles.article_id = articles.id 
                                                WHERE viewed_articles.user_id = :user_id");
                        $stmt->bindParam(':user_id', $userId);
                        $stmt->execute();
                        $viewedArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($viewedArticles)) {
                            foreach ($viewedArticles as $article) {
                                echo '<a href="article.php?id=' . $article['id'] . '" class="list-group-item list-group-item-action">';
                                echo '<i class="fas fa-book-open"></i> ' . htmlspecialchars($article['title']);
                                echo '</a>';
                            }
                        } else {
                            echo '<p class="text-muted">Bạn chưa xem bài viết nào.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="/VN_Article/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/VN_Article/assets/js/theme-toggle.js"></script>
</body>

</html>