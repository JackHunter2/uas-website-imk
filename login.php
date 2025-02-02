<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Jika username adalah "admin", langsung set role admin tanpa mengecek database
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['username'] = "admin";
        $_SESSION['role'] = "admin";
        header("Location: admin_dashboard.php");
        exit;
    }

    // Cek user biasa dari database
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Verifikasi password untuk user biasa
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = "user"; // Semua user yang login dari database otomatis jadi user biasa
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>
