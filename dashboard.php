<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Lấy thông tin admin từ phiên
$username = $_SESSION['username'];
?>

<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>

<body>
    <header>
        <h1>Chào mừng, Admin <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Đây là bảng điều khiển quản trị.</p>
        <a href="logout.php">Đăng xuất</a>
    </header>
    <main>
        <section class="stats">
            <h2>Thống kê</h2>
            <div class="stat-item">Tổng bài viết: 120</div>
            <div class="stat-item">Lượt xem hôm nay: 5,000</div>
        </section>
        <section class="articles">
            <h2>Danh sách bài viết</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Tác giả</th>
                        <th>Ngày đăng</th>
                        <th>Lượt xem</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($articles as $article) {
                        echo "<tr>
                                <td>{$article['title']}</td>
                                <td>{$article['author']}</td>
                                <td>{$article['date']}</td>
                                <td>{$article['views']}</td>
                                <td><a href='edit.php?id={$article['id']}'>Sửa</a> | <a href='delete.php?id={$article['id']}'>Xóa</a></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Báo chí</p>
    </footer>
</body>

</html>
<?php include 'includes/footer.php'; ?>