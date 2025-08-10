<?php
session_start();
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    if (empty($user) || empty($pass)) {
        $message = "Please fill all fields.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($pass, $hashedPassword)) {
                $_SESSION['admin'] = $user;
                header("Location: dashboard.php");
                exit;
            } else {
                $message = "Invalid username or password.";
            }
        } else {
            $message = "Invalid username or password.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<style>
  body {
    background: #f0f2f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .login-container {
    background: white;
    padding: 2rem 3rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    width: 320px;
  }
  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #333;
  }
  .input-group {
    margin-bottom: 1.2rem;
  }
  label {
    display: block;
    margin-bottom: 0.3rem;
    color: #555;
    font-weight: 600;
  }
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 0.6rem 0.8rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s;
  }
  input[type="text"]:focus,
  input[type="password"]:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 5px #4a90e2;
  }
  button {
    width: 100%;
    background-color: #4a90e2;
    border: none;
    padding: 0.8rem;
    font-size: 1rem;
    color: white;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  button:hover {
    background-color: #357abd;
  }
  .message {
    color: red;
    text-align: center;
    margin-bottom: 1rem;
    font-weight: 600;
  }
</style>
</head>
<body>

<div class="login-container">
  <h2>Login</h2>
  <?php if ($message): ?>
    <div class="message"><?=htmlspecialchars($message)?></div>
  <?php endif; ?>
  <form method="POST" action="">
    <div class="input-group">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required autocomplete="username" />
    </div>
    <div class="input-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required autocomplete="current-password" />
    </div>
    <button type="submit">Log In</button>
  </form>
</div>

</body>
</html>
