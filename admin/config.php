<?php
$conn = new mysqli("localhost", "root", "", "my_portfolio");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Absolute server path to the project root
define('BASE_PATH', realpath(__DIR__ . '/..'));

// Base URL for the browser (adjust to your site URL if needed)
define('BASE_URL', '/V-CARD-SITE');

