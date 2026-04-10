<?php
session_start();
require '../config/functions.php';

$query = "SELECT proker.nama_proker, arsip.* FROM arsip 
          JOIN proker ON arsip.id_proker = proker.id_proker 
          WHERE proker.status = 'Selesai'";
$data_arsip = query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Arsip Kegiatan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <h2>Arcaviva.</h2>
        <ul class="nav-links">
            <li><a href="home.php">Kembali</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1 style="color: #f7e6a1; margin-bottom: 20px;">Arsip dan Dokumentasi</h1>
        
        <?php if(empty($data_arsip)) { ?>
            <div class="card"><p>Belum ada data arsip untuk proker yang sudah selesai.</p></div>
        <?php } else { ?>
            <?php foreach($data_arsip as $a) { ?>
                <div class="card">
                    <h3 style="color: #e0c96b;"><?= $a['nama_proker']; ?></h3>
                    <p style="margin-top: 10px;"><strong>Catatan Evaluasi</strong><br><?= $a['catatan']; ?></p>
                    <div style="margin-top: 15px; display: flex; gap: 10px;">
                        <a href="<?= $a['link_drive']; ?>" target="_blank" class="btn">Drive Dokumentasi</a>
                        <a href="<?= $a['link_lpj']; ?>" target="_blank" class="btn" style="background-color: #2c3e50;">Lihat LPJ</a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>