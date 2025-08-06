<?php
include 'auth.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $imagePath = null;

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $img_name = rand(10, 100000) . "-" . $_FILES['image']['title'];
$tmp_img = $_FILES['image']['tmp_name'];
$folder = "uploads/";
    if (move_uploaded_file($tmp_img, $folder . $img_name)) {
      $imagePath = $img_name;
    }
  }
 

  $stmt = $conn->prepare("INSERT INTO blog_posts (title, content, image) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $title, $content, $imagePath);
  $stmt->execute();
  header("Location: blogs.php");
  exit;
}
?>
<form method="post" enctype="multipart/form-data">
  <h2>Add Blog Post</h2>
  <input type="text" name="title" placeholder="Title" required><br>
  <textarea name="content" placeholder="Content" required></textarea><br>
  <input type="file" name="image" accept="image/*"><br>
  <button type="submit">Save</button>
</form>