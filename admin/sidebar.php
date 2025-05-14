<!-- sidebar.html -->
<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar position-fixed h-100">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="articles.php" id="articlesDropdown" role="button">
                    <i class="bi bi-file-earmark-text"></i> Bài Viết
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="articles.php">Tất cả bài viết</a></li>
                    <li><a class="dropdown-item" href="#">Thêm bài viết</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="articlesDropdown" role="button">
                    <i class="bi bi-file-earmark-text"></i> Thành Viên
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Tất cả thành viên</a></li>
                    <li><a class="dropdown-item" href="#">Thêm thành viên</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="categories.php">
                    <i class="bi bi-bar-chart"></i> Danh Mục
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart"></i> Báo Cáo
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-gear"></i> Cài Đặt
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    /* Dropdown mở khi hover trong sidebar */
    .sidebar .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    /* Đảm bảo sidebar không bị scroll */
    .sidebar {
        overflow-y: auto;
        top: 56px;
        /* Chiều cao của navbar */
        left: 0;
    }
</style>