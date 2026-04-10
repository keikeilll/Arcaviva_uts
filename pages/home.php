<?php
session_start();
require '../config/functions.php';

$departemen = query("SELECT * FROM dept");


$total_proker = count(query("SELECT * FROM proker"));
$proker_selesai = count(query("SELECT * FROM proker WHERE status = 'Selesai'"));
$persentase = ($total_proker > 0) ? round(($proker_selesai / $total_proker) * 100) : 0;
$data_pengumuman = query("SELECT * FROM pengumuman LIMIT 1")[0];

$proker_dekat = query("SELECT * FROM proker WHERE status != 'Selesai' ORDER BY tgl_pelaksanaan ASC LIMIT 3");
?> 

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Arcaviva - Home</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo-container">
            <img src="../assets/images/logofix(lagi).png" alt="Logo" class="logo-img">
            <h2>Arcaviva.</h2>
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Beranda</a></li>
            <li class="dropdown">
                <a href="#">Departemen ▼</a>
                <div class="dropdown-content">
                    <?php foreach($departemen as $d) { ?>
                        <a href="departemen.php?id=<?= $d['id_dept']; ?>"><?= $d['nama_dept']; ?></a>
                    <?php } ?>
                </div>
            </li>
            <li><a href="proker.php">Semua Proker</a></li>
            <li><a href="arsip.php">Arsip</a></li>
            <?php if(!isset($_SESSION['login'])) { ?>
                <li><a href="../admin/login.php" class="btn">Login</a></li>
            <?php } else { ?>
                <li><a href="../admin/dashboard.php" class="btn">Panel Admin</a></li>
            <?php } ?>
        </ul>
    </nav>

    <div class="container">
        <div class="card" style="border-left: 4px solid #f7e6a1; margin-bottom: 30px;">
            <h3 style="color: #f7e6a1; margin-bottom: 10px;">Pengumuman Sistem 📢</h3>
            <p><?= nl2br($data_pengumuman['isi_pengumuman']); ?></p> 
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 30px;">
            <div class="card" style="flex: 1; text-align: center;">
                <h1 style="font-size: 48px; color: #f7e6a1;"><?= $persentase; ?>%</h1>
                <p style="color: #bfc0d1;">Progress Keseluruhan Organisasi</p>
                <div style="background-color: #1e202c; border-radius: 10px; height: 10px; width: 100%; margin-top: 10px; overflow: hidden;">
                    <div style="background-color: #f7e6a1; height: 100%; width: <?= $persentase; ?>%;"></div>
                </div>
            </div>
            <div class="card" style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <h2 style="color: #f7e6a1;"><?= $proker_selesai; ?> / <?= $total_proker; ?></h2>
                <p>Proker Telah Selesai</p>
            </div>
        </div>

        <div class="card">
            <h3 style="color: #bfc0d1; margin-bottom: 15px; border-bottom: 1px solid #60519b; padding-bottom: 10px;">⏳ Proker Dalam Waktu Dekat</h3>
            <?php if(empty($proker_dekat)) { ?>
                <p>Belum ada jadwal proker terdekat.</p>
            <?php } else { ?>
                <table style="width: 100%; text-align: left;">
                    <?php foreach($proker_dekat as $pd) { ?>
                        <tr>
                            <td style="padding: 10px 0; border-bottom: 1px solid #1e202c;">
                                <strong style="color: #f7e6a1; font-size: 18px;"><?= $pd['nama_proker']; ?></strong><br>
                                <small>Oleh: <?= $pd['pj_proker']; ?></small>
                            </td>
                            <td style="text-align: right; border-bottom: 1px solid #1e202c;">
                                <span style="background-color: #60519b; padding: 5px 10px; border-radius: 5px; color: #fff;">
                                    <?= date('d M Y', strtotime(format_tanggal($pd['tgl_pelaksanaan']))); ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>
</body>
</html>