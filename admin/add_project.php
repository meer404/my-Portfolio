<?php
include 'auth.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $link = $_POST['link'];
    $imagePath = ''; // Default to empty string instead of null

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Correct: use 'name', not 'title'
        $img_name = rand(10, 100000) . "-" . basename($_FILES['image']['name']);
        $tmp_img = $_FILES['image']['tmp_name'];
        $folder = "uploads/";

        // Create folder if it doesn't exist
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($tmp_img, $folder . $img_name)) {
            $imagePath = $img_name;
        }
    }

    // Fallback image if none uploaded
    if (empty($imagePath)) {
        $imagePath = "default.jpg"; // Make sure this file exists in uploads/
    }

    $stmt = $conn->prepare("INSERT INTO portfolio (title, image, category, link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $imagePath, $category, $link);
    $stmt->execute();

    header("Location: projects.php");
    exit;
}
?>

<form method="post" enctype="multipart/form-data">
    <h2>Add Project</h2>
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="file" name="image" accept="image/*"><br>
    <input type="text" name="category" placeholder="Category" required><br>
    <input type="text" name="link" placeholder="Project Link" required><br>
    <button type="submit">Save</button>
</form>
