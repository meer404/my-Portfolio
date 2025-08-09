<?php
include 'auth.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $link = $_POST['link'];
    $imagePath = ''; // Default empty

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_name = rand(10, 100000) . "-" . basename($_FILES['image']['name']);
        $tmp_img = $_FILES['image']['tmp_name'];
        $folder = "uploads/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($tmp_img, $folder . $img_name)) {
            $imagePath = $img_name;
        }
    }

    if (empty($imagePath)) {
        $imagePath = "default.jpg"; // Ensure this file exists in uploads/
    }

    $stmt = $conn->prepare("INSERT INTO portfolio (title, image, category, link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $imagePath, $category, $link);
    $stmt->execute();

    header("Location: projects.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="projects.php"><i class="bi bi-arrow-left-circle"></i> Back to Projects</a>
    <span class="text-light">Welcome, <strong><?= $_SESSION['admin'] ?></strong></span>
</nav>

<div class="form-container">
    <h2 class="mb-4"><i class="bi bi-plus-circle text-warning"></i> Add Project</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Project Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter project title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Project Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Leave empty to use the default image.</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" placeholder="Enter project category" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Project Link</label>
            <input type="url" name="link" class="form-control" placeholder="https://example.com" required>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Save Project
        </button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
