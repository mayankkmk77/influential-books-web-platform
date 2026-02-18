<?php
// Start session (so it works for admin/login/index)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection details
$server = "localhost";
$username = "root";
$password = "";
$database = "influential_books";

// Create connection
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("❌ Database connection failed due to: " . mysqli_connect_error());
}

// Optional message for testing only
// echo "✅ Connected successfully to influential_books database.";

// 🔹 Admin Section Helper (optional):
// You can use this small block to verify if the user is admin
// Example: include this in admin.php to restrict access
function checkAdmin() {
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
        header("Location: login.php");
        exit;
    }
}
?>
