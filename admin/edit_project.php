<?php
include 'auth.php';
include 'config.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $image = $_POST['image_url'];
  $category = $_POST['category'];
  $link = $_POST['link'];
  $stmt = $conn->prepare("UPDATE portfolio SET title = ?, image_url = ?, category = ?, link = ? WHERE id = ?");
  $stmt->bind_param("ssssi", $title, $image, $category, $link, $id);
  $stmt->execute();
  header("Location: projects.php");
}
$res = $conn->query("SELECT * FROM portfolio WHERE id = $id");
$project = $res->fetch_assoc();
?>
<form method="post">
  <h2>Edit Project</h2>
  <input type="text" name="title" value="<?= $project['title'] ?>" required><br>
  <input type="text" name="image_url" value="<?= $project['image_url'] ?>" required><br>
  <input type="text" name="category" value="<?= $project['category'] ?>" required><br>
  <input type="text" name="link" value="<?= $project['link'] ?>" required><br>
  <button type="submit">Update</button>
</form>