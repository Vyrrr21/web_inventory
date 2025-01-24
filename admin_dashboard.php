<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
?>
<h1>Welcome to Admin Dashboard</h1>
<a href="logout.php">Logout</a>
