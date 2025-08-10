<!-- register.php -->
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['admin']);
    $pass = $_POST['password'];

    if (empty($user) || empty($pass)) {
        echo "Please fill all fields.";
        exit;
    }

    // Check if username exists
    $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Username already exists.";
        exit;
    }
    $stmt->close();

    // Hash the password
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $passwordHash);
    if ($stmt->execute()) {
        echo "User registered successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
?>

<form method="POST" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
