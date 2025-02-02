<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Ambil data pemesanan dari database
$query = "SELECT * FROM pesanan";
$result = mysqli_query($kon, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }
        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="container mt-4">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Data Pemesanan Hotel</h2>
        
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Identitas</th>
                    <th>Tipe Kamar</th>
                    <th>Harga</th>
                    <th>Tanggal Pesan</th>
                    <th>Durasi</th>
                    <th>Breakfast</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Inisialisasi nomor urut
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td> <!-- Menggunakan nomor urut daripada id_pesanan -->
                        <td><?= $row['nama_pemesan'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['nomor_identitas'] ?></td>
                        <td><?= $row['tipe_kamar'] ?></td>
                        <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><?= $row['tanggal_pesan'] ?></td>
                        <td><?= $row['durasi_menginap'] ?> malam</td>
                        <td><?= $row['breakfeast'] ? '✅' : '❌' ?></td>
                        <td>Rp<?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
