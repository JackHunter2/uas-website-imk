<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Jika belum login, kembali ke login
    exit;
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php"); // Arahkan ke login setelah logout
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pemesanan hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Pesan Sekarang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hasilpesanan.php">Hasil pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?logout=true">Logout</a> <!-- Link untuk logout -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 40px;">
            <div class="col-md-12 text-center">
                <h2 class="text-dark">Pemesanan Hotel di Bandung</h2>
                <p>Temukan pengalaman menginap yang nyaman dan menyenangkan di Bandung dengan pemesanan hotel yang mudah
                    dan cepat.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem; margin-top: 15px;">
                    <img src="img/stand.jpeg" class="card-img-top" alt="kamar standar"
                        style="object-fit: cover; height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Standar</h5>
                        <p class="card-text">Rp 500.000</p>
                        <a href="form.php?tipe_kamar=Standar" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="img/deluxe.jpg" class="card-img-top" alt="kamar deluxe"
                        style="object-fit: cover; height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Deluxe</h5>
                        <p class="card-text">Rp 1.000.000</p>
                        <a href="form.php?tipe_kamar=Deluxe" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="img/executive.webp" class="card-img-top" alt="kamar executive"
                        style="object-fit: cover; height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Executive</h5>
                        <p class="card-text">Rp 1.500.000</p>
                        <a href="form.php?tipe_kamar=Executive" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" style="margin-top: 50px;">
            <div class="col-md-12 text-center">
                <h2 class="text-dark">Tentang Kami</h2>
                <p>Hotel kami berlokasi di Bandung, dengan alamat Jl. braga No. 123, Bandung. Untuk informasi lebih
                    lanjut, silakan hubungi kami di nomor telepon (022) 1234567 atau melalui email di
                    info@hotelbandung.com.</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 50px; background-color: gray;">
        <div class="col-md-12 text-center">
            <p>&copy; 2023 Hotel Bandung. All rights reserved.</p>
        </div>
    </div>
</body>

</html>