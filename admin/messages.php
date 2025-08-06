<?php
include 'auth.php';
include 'config.php';

$result = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
echo "<h2>Contact Messages</h2><a href='dashboard.php'>⬅ Back</a><hr>";
while($row = $result->fetch_assoc()) {
  echo "<p><strong>{$row['fullname']}</strong> ({$row['email']})<br>";
  echo nl2br(htmlspecialchars($row['message'])) . "<br><small>{$row['created_at']}</small></p><hr>";
}
?>