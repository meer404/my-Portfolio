<?php
include 'auth.php';
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM blog_posts WHERE id = $id");
header("Location: blogs.php");
?>