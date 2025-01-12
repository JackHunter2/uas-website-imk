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

function update_pesanan($data, $id_pesanan)
{
    global $kon;

    $nama_pemesan = $data['nama_pemesan'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $nomor_identitas = $data['nomor_identitas'];
    $tipe_kamar = $data['tipe_kamar'];
    $harga = $data['harga'];
    $tanggal_pesan = $data['tanggal_pesan'];
    $durasi_menginap = $data['durasi_menginap'];
    $breakfeast = $data['breakfeast'] ? 1 : 0;
    $total_bayar = $data['total_bayar'];

    $query = "UPDATE pesanan SET 
        nama_pemesan = '$nama_pemesan',
        jenis_kelamin = '$jenis_kelamin',
        nomor_identitas = '$nomor_identitas',
        tipe_kamar = '$tipe_kamar',
        harga = '$harga',
        tanggal_pesan = '$tanggal_pesan',
        durasi_menginap = '$durasi_menginap',
        breakfeast = '$breakfeast',
        total_bayar = '$total_bayar'
        WHERE id_pesanan = $id_pesanan";

    return mysqli_query($kon, $query);
}

$id_pesanan = (int) $_GET['id_pesanan'];

// Ambil data pesanan berdasarkan ID
$pesanan = select("SELECT * FROM pesanan WHERE id_pesanan = $id_pesanan")[0];

if (isset($_POST['ubah'])) {
    if (update_pesanan($_POST, $id_pesanan)) {
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'hasilpesanan.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal mengubah data');
            document.location.href = 'index.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: gray;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 20px;
        }

        .form-check-input {
            accent-color: #007bff;
        }
    </style>
    <script>
        function hitungTotal() {
            const tipeKamar = document.getElementById('tipe_kamar').value;
            const durasiMenginap = parseInt(document.getElementById('durasi_menginap').value);
            const breakfeast = document.getElementById('breakfeast').checked;

            let hargaKamar = 0;
            let discount = 0;
            let tambahan = 0;

            if (tipeKamar === 'Standar') {
                hargaKamar = 500000;
            } else if (tipeKamar === 'Deluxe') {
                hargaKamar = 1000000;
            } else if (tipeKamar === 'Executive') {
                hargaKamar = 1500000;
            }

            if (durasiMenginap > 3) {
                discount = 0.1;
            }

            if (breakfeast) {
                tambahan = 80000;
            }

            const totalBayar = (hargaKamar * durasiMenginap) * (1 - discount) + tambahan;

            document.getElementById('total_bayar').value = totalBayar;
            document.getElementById('harga').value = hargaKamar;
        }
    </script>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Edit Pemesanan</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id_pesanan=<?= $id_pesanan ?>" method="POST">
            <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">
            <div class="mb-3 row">
                <label for="nama_pemesan" class="col-sm-2 col-form-label">Nama Pemesan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required
                        value="<?= $pesanan['nama_pemesan']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" <?= $pesanan['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>
                            Laki-laki</option>
                        <option value="Perempuan" <?= $pesanan['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>
                            Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nomor_identitas" class="col-sm-2 col-form-label">Nomor Identitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required
                        value="<?= $pesanan['nomor_identitas']; ?>" maxlength="16">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tipe_kamar" class="col-sm-2 col-form-label">Tipe Kamar</label>
                <div class="col-sm-10">
                    <select class="form-select" id="tipe_kamar" name="tipe_kamar" required>
                        <option value="Standar" <?= $pesanan['tipe_kamar'] == 'Standar' ? 'selected' : ''; ?>>Standar
                        </option>
                        <option value="Deluxe" <?= $pesanan['tipe_kamar'] == 'Deluxe' ? 'selected' : ''; ?>>Deluxe</option>
                        <option value="Executive" <?= $pesanan['tipe_kamar'] == 'Executive' ? 'selected' : ''; ?>>Executive
                        </option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" required readonly
                        value="<?= $pesanan['harga']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tanggal_pesan" class="col-sm-2 col-form-label">Tanggal Pesan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required
                        value="<?= $pesanan['tanggal_pesan']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="durasi_menginap" class="col-sm-2 col-form-label">Durasi Menginap</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="durasi_menginap" name="durasi_menginap" required
                        value="<?= $pesanan['durasi_menginap']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="breakfeast" class="col-sm-2 col-form-label">Breakfeast</label>
                <div class="col-sm-10">
                    <input type="checkbox" class="form-check-input" id="breakfeast" name="breakfeast" value="1"
                        <?= $pesanan['breakfeast'] ? 'checked' : ''; ?>>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="total_bayar" class="col-sm-2 col-form-label">Total Bayar</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar" required readonly
                        value="<?= $pesanan['total_bayar']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="button" name="hitung_total" class="btn btn-primary me-2"
                        onclick="hitungTotal()">Hitung Total Bayar</button>
                    <button type="submit" name="ubah" class="btn btn-success me-2">Simpan</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>