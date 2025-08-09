<?php
include 'auth.php';
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Projects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .project-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .project-img {
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="dashboard.php"><i class="bi bi-arrow-left-circle"></i> Back to Dashboard</a>
    <span class="text-light">Welcome, <strong><?= $_SESSION['admin'] ?></strong></span>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-folder-fill text-warning"></i> Portfolio Projects</h2>
        <a href="add_project.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Project
        </a>
    </div>

    <div class="row g-4">
        <?php
        $result = $conn->query("SELECT * FROM portfolio ORDER BY created_at DESC");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $imageWebPath = 'uploads/' . htmlspecialchars($row['image']);
                ?>
                <div class="col-md-4">
                    <div class="card project-card">
                        <img src="<?= $imageWebPath ?>" class="card-img-top project-img" alt="<?= htmlspecialchars($row['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($row['category']) ?></p>
                            <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                                <i class="bi bi-link-45deg"></i> View Project
                            </a>
                            <div class="d-flex gap-2">
                                <a href="edit_project.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="delete_project.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project?');">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        <div class="card-footer text-muted small">
                            <i class="bi bi-clock"></i> <?= $row['created_at'] ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-muted'>No projects found.</p>";
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
