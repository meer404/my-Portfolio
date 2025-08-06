<?php include 'auth.php'; ?>
<h2>Welcome, <?= $_SESSION['admin'] ?></h2>
<ul>
  <li><a href="messages.php">📥 View Messages</a></li>
  <li><a href="blogs.php">📝 Manage Blogs</a></li>
  <li><a href="projects.php">🗂 Manage Projects</a></li>
  <li><a href="logout.php">🚪 Logout</a></li>
</ul>