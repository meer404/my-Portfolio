<?php
include 'auth.php';
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = (int)$_GET['id'];

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("UPDATE portfolio SET title = ?, image = ?, category = ?, link = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $image, $category, $link, $id);
    $stmt->execute();

    header("Location: projects.php");
    exit;
}

// Fetch existing project
$stmt = $conn->prepare("SELECT * FROM portfolio WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$project = $res->fetch_assoc();

if (!$project) {
    die("Project not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Project</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
    }
    .form-container {
        max-width: 600px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
</head>
<body>

<div class="container form-container">
    <h2 class="mb-4 text-center">✏ Edit Project</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Project Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($project['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" name="image_url" class="form-control" value="<?= htmlspecialchars($project['image']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($project['category']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Project Link</label>
            <input type="text" name="link" class="form-control" value="<?= htmlspecialchars($project['link']) ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="projects.php" class="btn btn-secondary">⬅ Back</a>
            <button type="submit" class="btn btn-primary">💾 Update</button>
        </div>
    </form>
</div>

</body>
</html>
