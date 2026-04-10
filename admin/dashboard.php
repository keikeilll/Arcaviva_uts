<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require '../config/functions.php';
$proker = query("SELECT * FROM proker");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <h2>Admin Tools</h2>
        <ul class="nav-links">
            <li><a href="dashboard.php">Kelola Proker</a></li>
            <li><a href="kelola_pengumuman.php" style="color: #f7e6a1;">Pengumuman</a></li> <li><a href="../pages/home.php">Tampilan Publik</a></li>
            <li><a href="../logout.php" style="color: #ff6b6b;">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1 style="color: #f7e6a1;">Manajemen Program Kerja</h1>
        <br>
        <a href="tambah_proker.php" class="btn">Tambah Proker Baru</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Proker</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1; foreach($proker as $p) { ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $p["nama_proker"]; ?></td>
                <td><?= format_tanggal($p['tgl_pelaksanaan']); ?></td>
                <td><?= $p["status"]; ?></td>
                <td>
                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                        <a href="kelola_timeline.php?id=<?= $p['id_proker']; ?>" class="btn" style="background-color: #27ae60; flex: 1; text-align: center; font-size: 13px; padding: 6px;">Checklist</a>
                        <a href="edit_proker.php?id=<?= $p['id_proker']; ?>" class="btn" style="flex: 1; text-align: center; font-size: 13px; padding: 6px;">Edit</a>
                        <a href="hapus_proker.php?id=<?= $p['id_proker']; ?>" class="btn btn-danger" style="flex: 1; text-align: center; font-size: 13px; padding: 6px;" onclick="return konfirmasiHapus();">Hapus</a>
                    </div>
                    
                    <?php if($p['status'] == 'Selesai') { ?>
                        <a href="kelola_arsip.php?id=<?= $p['id_proker']; ?>" class="btn" style="background-color: #2980b9; display: block; text-align: center; margin-top: 5px; font-size: 13px; padding: 6px;">Kelola Arsip</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <script src="../assets/js/script.js"></script>
</body>
</html>