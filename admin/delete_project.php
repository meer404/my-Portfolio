<?php
include 'auth.php';
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM portfolio WHERE id = $id");
header("Location: projects.php");
?>