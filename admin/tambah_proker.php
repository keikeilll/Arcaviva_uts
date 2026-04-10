<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require '../config/functions.php';

$departemen = query("SELECT * FROM dept");

if (isset($_POST["submit"])) {
    if (tambah_proker($_POST) > 0) {
        echo "<script>
                alert('Program kerja berhasil ditambahkan');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data, pastikan jadwal tidak bentrok');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Proker</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin: auto;">
        <div class="card">
            <h2 style="color: #f7e6a1; margin-bottom: 20px;">Tambah Program Kerja</h2>
            <form action="" method="post">
                <label>Pilih Departemen</label>
                <select name="id_dept" required>
                    <option value="">-- Pilih Departemen --</option>
                    <?php foreach($departemen as $d) { ?>
                        <option value="<?= $d['id_dept']; ?>"><?= $d['nama_dept']; ?></option>
                    <?php } ?>
                </select>

                <label>Nama Program Kerja</label>
                <input type="text" name="nama_proker" required>

                <label>Penanggung Jawab (PJ)</label>
                <input type="text" name="pj_proker" required>

                <label>Tanggal Pelaksanaan</label>
                <input type="date" name="tgl_pelaksanaan" required>

                <label>Deskripsi Kegiatan</label>
                <textarea name="deskripsi" rows="4" required></textarea>

                <button type="submit" name="submit" class="btn" style="width: 100%; margin-top: 10px;">Simpan Data</button>
            </form>
            <br>
            <a href="dashboard.php" style="color: #bfc0d1;">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>