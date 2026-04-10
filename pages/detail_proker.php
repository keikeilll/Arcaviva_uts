<?php
session_start();
require '../config/functions.php';

$id_proker = $_GET["id"];

$proker = query("SELECT proker.*, dept.nama_dept FROM proker JOIN dept ON proker.id_dept = dept.id_dept WHERE id_proker = $id_proker")[0];

$timeline = query("SELECT * FROM timeline WHERE id_proker = $id_proker");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Proker - <?= $proker['nama_proker']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo-container">
            <img src="../assets/images/logofix_lagi.png" alt="Logo" class="logo-img">
            <h2>Arcaviva.</h2>
        </div>
        <ul class="nav-links">
            <li><a href="proker.php" class="btn">Kembali ke Daftar</a></li>
        </ul>
    </nav>

    <div class="container" style="max-width: 800px; margin: auto;">
        <div class="card" style="border-top: 4px solid #60519b;">
            <h1 style="color: #f7e6a1;"><?= $proker['nama_proker']; ?></h1>
            <p style="margin-top: 5px; color: #bfc0d1;">Departemen: <?= $proker['nama_dept']; ?> | PJ: <?= $proker['pj_proker']; ?></p>
            <hr style="border: 1px solid #1e202c; margin: 15px 0;">
            <p><strong>Deskripsi Kegiatan:</strong><br><?= nl2br($proker['deskripsi']); ?></p>
            <p style="margin-top: 15px;"><strong>Tanggal:</strong> <?= date('d F Y', strtotime($proker['tgl_pelaksanaan'])); ?> | <strong>Status:</strong> <?= $proker['status']; ?></p>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 15px;">✅ Checklist Progress</h3>
            <?php if(empty($timeline)) { ?>
                <p>Belum ada timeline/tugas yang ditambahkan oleh Admin.</p>
            <?php } else { ?>
                <ul style="list-style: none;">
                    <?php foreach($timeline as $t) { ?>
                        <li style="padding: 12px; background: #1e202c; margin-bottom: 10px; border-radius: 5px; display: flex; align-items: center; gap: 15px;">
                            <?php if($t['is_done']) { ?>
                                <span style="background-color: #27ae60; padding: 5px 10px; border-radius: 3px; font-weight: bold; color: white;">SELESAI</span>
                                <span style="text-decoration: line-through; color: #7f8fa6;"><?= $t['tugas']; ?></span>
                            <?php } else { ?>
                                <span style="background-color: #e74c3c; padding: 5px 10px; border-radius: 3px; font-weight: bold; color: white;">BELUM</span>
                                <span><?= $t['tugas']; ?></span>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</body>
</html>