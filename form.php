<?php
include 'koneksi.php';
$tipe_kamar_selected = isset($_GET['tipe_kamar']) ? $_GET['tipe_kamar'] : '';

if (isset($_POST['simpan'])) {
    if (create_pesanan($_POST)) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'hasilpesanan.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan data');
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
    <title>Pemesanan</title>
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

        function validateForm() {
            const namaPemesan = document.getElementById('nama_pemesan').value;
            const jenisKelamin = document.getElementById('jenis_kelamin').value;
            const nomorIdentitas = document.getElementById('nomor_identitas').value;
            const tipeKamar = document.getElementById('tipe_kamar').value;
            const tanggalPesan = document.getElementById('tanggal_pesan').value;
            const durasiMenginap = document.getElementById('durasi_menginap').value;
            const totalBayar = document.getElementById('total_bayar').value;

            if (nomorIdentitas.length !== 16) {
                alert('Isian salah..data harus 16 digit');
                return false;
            }

            if (!namaPemesan || !jenisKelamin || !nomorIdentitas || !tipeKamar || !tanggalPesan || !durasiMenginap || !totalBayar) {
                alert('Semua field harus diisi.');
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Form Pemesanan</h2>
        <form action="form.php" method="POST" onsubmit="return validateForm();">
            <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">
            <div class="mb-3 row">
                <label for="nama_pemesan" class="col-sm-2 col-form-label">Nama Pemesan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required
                        placeholder="Nama harus diisi">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nomor_identitas" class="col-sm-2 col-form-label">Nomor Identitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required
                        placeholder="Nomor identitas harus diisi" maxlength="16">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tipe_kamar" class="col-sm-2 col-form-label">Tipe Kamar</label>
                <div class="col-sm-10">
                <select class="form-select" id="tipe_kamar" name="tipe_kamar" required>
                        <option value="Standar" <?= $tipe_kamar_selected == 'Standar' ? 'selected' : '' ?>>Standar</option>
                        <option value="Deluxe" <?= $tipe_kamar_selected == 'Deluxe' ? 'selected' : '' ?>>Deluxe</option>
                        <option value="Executive" <?= $tipe_kamar_selected == 'Executive' ? 'selected' : '' ?>>Executive</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" required readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tanggal_pesan" class="col-sm-2 col-form-label">Tanggal Pesan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="durasi_menginap" class="col-sm-2 col-form-label">Durasi Menginap</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="durasi_menginap" name="durasi_menginap" required
                        placeholder="Durasi menginap harus diisi">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="breakfeast" class="col-sm-2 col-form-label">Breakfast</label>
                <div class="col-sm-10">
                    <input type="checkbox" class="form-check-input" id="breakfeast" name="breakfeast" value="1">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="total_bayar" class="col-sm-2 col-form-label">Total Bayar</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar" required readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="button" name="hitung_total" class="btn btn-primary me-2"
                        onclick="hitungTotal()">Hitung Total Bayar</button>
                    <button type="submit" name="simpan" class="btn btn-success me-2">Simpan</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                    <a href="index.php" class="btn btn-primary float-end">Kembali ke Beranda</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
