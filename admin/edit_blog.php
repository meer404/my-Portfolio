<?php
include 'auth.php';
include 'config.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $stmt = $conn->prepare("UPDATE blog_posts SET title = ?, content = ? WHERE id = ?");
  $stmt->bind_param("ssi", $title, $content, $id);
  $stmt->execute();
  header("Location: blogs.php");
}
$res = $conn->query("SELECT * FROM blog_posts WHERE id = $id");
$post = $res->fetch_assoc();
?>
<form method="post">
  <h2>Edit Blog Post</h2>
  <input type="text" name="title" value="<?= $post['title'] ?>" required><br>
  <textarea name="content" required><?= $post['content'] ?></textarea><br>
  <button type="submit">Update</button>
</form>