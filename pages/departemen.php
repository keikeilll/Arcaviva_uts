<?php
session_start();
require '../config/functions.php';

$id_dept = $_GET["id"];
$info_dept = query("SELECT * FROM dept WHERE id_dept = $id_dept")[0];
$proker_dept = query("SELECT * FROM proker WHERE id_dept = $id_dept");
$semua_dept = query("SELECT * FROM dept");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Departemen <?= $info_dept['nama_dept']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <h2>Arcaviva.</h2>
        <ul class="nav-links">
            <li><a href="home.php">Beranda</a></li>
            <li><a href="proker.php">Semua Proker</a></li>
            <li><a href="arsip.php">Arsip</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="card" style="border-left: 4px solid #60519b;">
            <h1 style="color: #f7e6a1;"><?= $info_dept['nama_dept']; ?></h1>
            <p style="margin-top: 10px;"><?= $info_dept['tentang_dept']; ?></p>
        </div>

        <h3 style="margin-bottom: 15px;">Daftar Program Kerja</h3>
        <?php if(empty($proker_dept)) { ?>
            <div class="card"><p>Belum ada program kerja di departemen ini.</p></div>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Penanggung Jawab</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
                <?php foreach($proker_dept as $p) { ?>
                <tr>
                    <td><?= $p['nama_proker']; ?></td>
                    <td><?= $p['pj_proker']; ?></td>
                    <td><?= format_tanggal($p['tgl_pelaksanaan']); ?></td>
                    <td><?= $p['status']; ?></td>
                </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</body>
</html>