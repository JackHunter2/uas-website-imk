<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "hotel";

// Establish database connection
$kon = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$kon) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define the create_pesanan() function
function create_pesanan($post)
{
    global $kon; // Menggunakan variabel koneksi global

    $nama_pemesan = $post['nama_pemesan'];
    $jenis_kelamin = $post['jenis_kelamin'];
    $nomor_identitas = $post['nomor_identitas'];
    $tipe_kamar = $post['tipe_kamar'];
    $harga = $post['harga'];
    $tanggal_pesan = $post['tanggal_pesan'];
    $durasi_menginap = $post['durasi_menginap'];
    $breakfeast = $post['breakfeast'] ? 1 : 0;
    $total_bayar = $post['total_bayar'];

    // Insert the data into the database
    $query = "INSERT INTO pesanan VALUES (null, '$nama_pemesan', '$jenis_kelamin', '$nomor_identitas', '$tipe_kamar', '$harga', '$tanggal_pesan', '$durasi_menginap', '$breakfeast', '$total_bayar')";
    mysqli_query($kon, $query);
    // Execute the query and return the result
    return mysqli_affected_rows($kon);
}
?>