<?php
include 'auth.php';
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .message-card {
            transition: 0.2s;
        }
        .message-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="dashboard.php">
        <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
    </a>
    <span class="text-light">Welcome, <strong><?= $_SESSION['admin'] ?></strong></span>
</nav>

<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-inbox-fill text-primary"></i> Contact Messages</h2>
    <div class="row">
        <?php
        $result = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-12 mb-3">
                    <div class="card message-card">
                        <div class="card-body">
                            <h5 class="card-title mb-1"><?= htmlspecialchars($row['fullname']) ?></h5>
                            <h6 class="card-subtitle text-muted mb-2">
                                <i class="bi bi-envelope-fill"></i> <?= htmlspecialchars($row['email']) ?>
                            </h6>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                            <small class="text-muted"><i class="bi bi-clock"></i> <?= $row['created_at'] ?></small>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-muted'>No messages found.</p>";
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
