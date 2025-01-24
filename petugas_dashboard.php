<?php
session_start();
if ($_SESSION['role'] !== 'petugas') {
    header("Location: login.html");
    exit();
}
?>
<h1>Welcome to Petugas Dashboard</h1>
<a href="logout.php">Logout</a>
