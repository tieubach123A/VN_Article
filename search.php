<?php
require_once 'includes/db.php';

$query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
$searchResults = [];

if ($query) {
    $stmt = $conn->prepare("SELECT * FROM articles WHERE title LIKE :query OR content LIKE :query");
    $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h2>Kết quả tìm kiếm cho "<?php echo htmlspecialchars($query); ?>"</h2>
    <?php if (count($searchResults) > 0): ?>
        <div class="row">
            <?php foreach ($searchResults as $article): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="/VN_Article/assets/images/default.jpg" class="card-img-top" alt="Article Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h5>
                            <p class="card-text"><?php echo substr(htmlspecialchars($article['content']), 0, 100); ?>...</p>
                            <a href="article.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Không tìm thấy kết quả nào.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
