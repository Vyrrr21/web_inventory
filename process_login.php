<?php
session_start();
include 'db_connection.php'; // Pastikan file ini mengatur koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.html");
            } elseif ($user['role'] === 'petugas') {
                header("Location: petugas_dashboard.html");
            }
            exit;
        } else {
            echo "<script>alert('Invalid password!'); window.location.href = 'login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href = 'login.html';</script>";
    }
} else {
    header("Location: login.html");
    exit;
}
?>
