<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .dashboard-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
  <a class="navbar-brand" href="#">Admin Dashboard</a>
  <span class="text-light">Welcome, <strong><?= $_SESSION['admin'] ?></strong></span>
</nav>

<div class="container py-5">
  <div class="row g-4">

    <!-- Messages -->
    <div class="col-md-3">
      <a href="messages.php" class="text-decoration-none text-dark">
        <div class="card dashboard-card text-center p-4">
          <i class="bi bi-inbox-fill display-4 text-primary"></i>
          <h5 class="mt-3">View Messages</h5>
        </div>
      </a>
    </div>

    <!-- Blogs -->
    <div class="col-md-3">
      <a href="blogs.php" class="text-decoration-none text-dark">
        <div class="card dashboard-card text-center p-4">
          <i class="bi bi-pencil-square display-4 text-success"></i>
          <h5 class="mt-3">Manage Blogs</h5>
        </div>
      </a>
    </div>

    <!-- Projects -->
    <div class="col-md-3">
      <a href="projects.php" class="text-decoration-none text-dark">
        <div class="card dashboard-card text-center p-4">
          <i class="bi bi-folder-fill display-4 text-warning"></i>
          <h5 class="mt-3">Manage Projects</h5>
        </div>
      </a>
    </div>

    <!-- Logout -->
    <div class="col-md-3">
      <a href="logout.php" class="text-decoration-none text-dark">
        <div class="card dashboard-card text-center p-4">
          <i class="bi bi-box-arrow-right display-4 text-danger"></i>
          <h5 class="mt-3">Logout</h5>
        </div>
      </a>
    </div>

  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
