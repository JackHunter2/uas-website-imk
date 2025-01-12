<?php
include 'koneksi.php';

function select($query)
{
    global $kon;

    $result = mysqli_query($kon, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
$data_pesanan = select("SELECT * FROM pesanan");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mx-5 border">
        <h1>Hasil Pesanan</h1>
        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
        <table class="table table-striped mt-3 border">
            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Jenis kelamin</th>
                    <th>Nomor Identitas</th>
                    <th>Tipe Kamar</th>
                    <th>Harga</th>
                    <th>Tanggal Pesan</th>
                    <th>Durasi Menginap</th>
                    <th>Total Bayar</th>
                    <th>aksi</th>
                </tr>

            </thead>
            <tbody class="table-group-divider">
                <?php $no = 1 ?>
                <?php foreach ($data_pesanan as $pesanan): ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $pesanan['nama_pemesan'] ?></td>
                        <td><?php echo $pesanan['jenis_kelamin'] ?></td>
                        <td><?php echo $pesanan['nomor_identitas'] ?></td>
                        <td><?php echo $pesanan['tipe_kamar'] ?></td>
                        <td><?php echo $pesanan['harga'] ?></td>
                        <td><?php echo $pesanan['tanggal_pesan'] ?></td>
                        <td><?php echo $pesanan['durasi_menginap'] ?></td>
                        <td><?php echo $pesanan['total_bayar'] ?></td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="formedit.php?id_pesanan=<?= $pesanan['id_pesanan'] ?>" name="ubah" class="btn btn-success">Ubah</a>
                                <a href="hapus.php?id_pesanan=<?= $pesanan['id_pesanan'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>

</body>

</html>