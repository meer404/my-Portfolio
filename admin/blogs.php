<?php
include 'auth.php';
include 'config.php';

echo "<h2>Blog Posts</h2><a href='dashboard.php'>⬅ Back</a> | <a href='add_blog.php'>➕ Add New</a><hr>";
$result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
while($row = $result->fetch_assoc()) {
  echo "<h4>{$row['title']}</h4><small>{$row['created_at']}</small><br>";
  echo "<a href='edit_blog.php?id={$row['id']}'>✏ Edit</a> | <a href='delete_blog.php?id={$row['id']}'>❌ Delete</a><hr>";
}
?>