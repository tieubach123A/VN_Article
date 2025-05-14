<?php
include('../includes/db.php');
include('sidebar.php');

// Xử lý thêm danh mục nếu có POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Thêm danh mục
    if (isset($_POST['category_name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['category_name']);
        $query = "INSERT INTO categories (name) VALUES ('$name')";
        mysqli_query($conn, $query);
    }

    // Xóa danh mục
    if (isset($_POST['delete_category'])) {
        $category_id = intval($_POST['category_id']);
        $query = "DELETE FROM categories WHERE id = $category_id";
        mysqli_query($conn, $query);
    }
}

// Truy vấn danh mục hiện có
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý danh mục</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        /* Bố cục container */
        .container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        /* Sidebar */


        /* Nội dung chính (content) */
        .content {
            margin-left: 270px;
            /* Tạo khoảng cách cho sidebar */
            width: calc(100% - 270px);
            /* Đảm bảo nội dung còn lại sau sidebar */
            padding: 20px;
        }

        /* Các phần của form và danh sách */
        .form-section,
        .list-section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
        }

        /* Table danh mục */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* Input text và submit */
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 8px 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Content -->
    <div class="content">
        <!-- Form thêm danh mục -->
        <div class="form-section">
            <h2>Thêm danh mục</h2>
            <form method="POST">
                <label for="category_name">Tên danh mục:</label>
                <input type="text" id="category_name" name="category_name" required>
                <input type="submit" value="Thêm">
            </form>
        </div>

        <!-- Danh sách danh mục -->
        <div class="list-section">
            <h2>Danh sách danh mục</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Hành động</th> <!-- Thêm cột Hành động -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td>
                                <form action="categories.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="category_id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="delete_category" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
    </div>
</body>

</html>