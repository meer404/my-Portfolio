<?php
include 'auth.php';
include 'config.php';

$id = $_GET['id'] ?? 0;

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE blog_posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: blogs.php");
    exit;
}

// Fetch blog post
$res = $conn->query("SELECT * FROM blog_posts WHERE id = $id");
$post = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">✏️ Edit Blog Post</h4>
        </div>
        <div class="card-body p-4">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="6" class="form-control" required><?= htmlspecialchars($post['content']) ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="blogs.php" class="btn btn-secondary">⬅ Back</a>
                    <button type="submit" class="btn btn-success">💾 Update Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
