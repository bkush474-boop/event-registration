<?php
session_start();

// Simple, hardcoded admin credentials (for demonstration purposes only)
$admin_email = "bkush474@gmail.com";
$admin_password = "Kush23092008.";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: admin_login.php");
        exit();
    }
}
?>