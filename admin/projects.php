<?php
include 'auth.php';
include 'config.php';

echo "<h2>Portfolio Projects</h2><a href='dashboard.php'>⬅ Back</a> | <a href='add_project.php'>➕ Add Project</a><hr>";
$result = $conn->query("SELECT * FROM portfolio ORDER BY created_at DESC");
while($row = $result->fetch_assoc()) {
  echo "<h4>{$row['title']} ({$row['category']})</h4><a href='{$row['link']}' target='_blank'>🔗 Link</a><br>";
  echo "<img src='{$row['image_url']}' width='100'><br>";
  echo "<a href='edit_project.php?id={$row['id']}'>✏ Edit</a> | <a href='delete_project.php?id={$row['id']}'>❌ Delete</a><hr>";
}
?>