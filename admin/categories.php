<?php
include('../includes/db.php');
include('sidebar.php');

// Xử lý thêm danh mục nếu có POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $query = "INSERT INTO categories (name) VALUES ('$name')";
    mysqli_query($conn, $query);
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
        .container {
            display: flex;
            padding: 20px;
        }

        .sidebar {
            width: 20%;
        }

        .content {
            width: 80%;
            display: flex;
            gap: 20px;
        }

        .form-section,
        .list-section {
            width: 50%;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
        }

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

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 8px 16px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="sidebar">
            <?php include('sidebar.php'); ?>
        </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>