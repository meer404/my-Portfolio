<?php
include 'auth.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $image = $_POST['image_url'];
  $category = $_POST['category'];
  $link = $_POST['link'];
  $stmt = $conn->prepare("INSERT INTO portfolio (title, image_url, category, link) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $title, $image, $category, $link);
  $stmt->execute();
  header("Location: projects.php");
}
?>
<form method="post">
  <h2>Add Project</h2>
  <input type="text" name="title" placeholder="Title" required><br>
  <input type="text" name="image_url" placeholder="Image URL" required><br>
  <input type="text" name="category" placeholder="Category" required><br>
  <input type="text" name="link" placeholder="Project Link" required><br>
  <button type="submit">Save</button>
</form>