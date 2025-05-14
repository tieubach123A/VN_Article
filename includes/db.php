<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "vn_article";

$conn = new mysqli($host, $user, $password, $database);

// Kiểm tra lỗi kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
