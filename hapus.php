<?php
include 'koneksi.php';

$id_pesanan = (int) $_GET['id_pesanan'];

if ($id_pesanan) {
    $query = "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan";

    if (mysqli_query($kon, $query)) {
        echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'hasilpesanan.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data');
            document.location.href = 'hasilpesanan.php';
            </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan');
        document.location.href = 'index.php';
        </script>";
}
?>