<!-- sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <h3>Quản trị</h3>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="dashboard.php">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="articles.php">
                <i class="bi bi-file-earmark-text"></i> Bài Viết
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-person"></i> Thành Viên
            </a>
        </li>
        <li>
            <a href="categories.php">
                <i class="bi bi-bar-chart"></i> Danh Mục
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-gear"></i> Cài Đặt
            </a>
        </li>
    </ul>
</nav>


<style>
    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background-color: #222;
        padding-top: 20px;
        transition: 0.3s;
    }

    .sidebar-header {
        text-align: center;
        color: white;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .sidebar ul {
        padding: 0;
        list-style: none;
        margin: 0;
    }

    .sidebar ul li a {
        color: #fff;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        transition: 0.3s;
    }

    .sidebar ul li a:hover {
        background-color: #575757;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    .sidebar ul li a.active {
        background-color: #007bff;
    }

    .sidebar .list-unstyled {
        margin-top: 20px;
    }

    /* Toggle button for mobile */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar-header {
            font-size: 20px;
        }
    }
</style>

<script>
    // Tạo sự kiện để mở/đóng sidebar
    const toggleBtn = document.getElementById("sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");

    toggleBtn.addEventListener("click", function() {
        sidebar.classList.toggle("active");
    });
</script>