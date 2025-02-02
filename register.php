<?php
session_start();
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // User selalu mendapatkan role 'user'

    // Cek apakah username sudah digunakan
    $query_check = "SELECT * FROM users WHERE username = ?";
    $stmt_check = mysqli_prepare($kon, $query_check);
    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        echo "<script>alert('Username sudah digunakan, coba yang lain!');</script>";
    } else {
        // Simpan user baru dengan role 'user'
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($kon, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Gagal registrasi!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" name="register" class="btn btn-success">Register</button>
        </form>
        <p class="mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
