<?php
session_start();
require '../config/functions.php';

$query = "SELECT proker.*, dept.nama_dept 
          FROM proker 
          JOIN dept ON proker.id_dept = dept.id_dept 
          ORDER BY tgl_pelaksanaan ASC";
$semua_proker = query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Semua Proker</title>
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
        <h1 style="color: #f7e6a1; margin-bottom: 20px;">Master List Program Kerja</h1>
       <table>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Departemen</th>
                <th>PJ</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($semua_proker as $p) { ?>
            <tr>
                <td><strong><?= $p['nama_proker']; ?></strong></td>
                <td><?= $p['nama_dept']; ?></td>
                <td><?= $p['pj_proker']; ?></td>
                <td><?= format_tanggal($p['tgl_pelaksanaan']); ?></td>
                <td>
                    <span style="padding: 5px 10px; border-radius: 4px; background: #1e202c;">
                        <?= $p['status']; ?>
                    </span>
                </td>
                <td>
                    <a href="detail_proker.php?id=<?= $p['id_proker']; ?>" style="color: #f7e6a1; font-weight: bold; text-decoration: none;">Lihat Detail</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>