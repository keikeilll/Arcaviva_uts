<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: login.php"); exit; }
require '../config/functions.php';

$pengumuman = query("SELECT * FROM pengumuman LIMIT 1")[0];

if (isset($_POST["simpan_pengumuman"])) {
    $isi_baru = htmlspecialchars($_POST["isi_pengumuman"]);
    
    $query = "UPDATE pengumuman SET isi_pengumuman = '$isi_baru' WHERE id = 1";
    mysqli_query($conn, $query);
    
    echo "<script>
            alert('Pengumuman berhasil diperbarui!');
            window.location.href = 'dashboard.php';
          </script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Pengumuman</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin: auto; margin-top: 50px;">
        <div class="card">
            <h2 style="color: #f7e6a1; margin-bottom: 20px;">Kelola Pengumuman 📢</h2>
            <form action="" method="post">
                <label>Teks Pengumuman (Tampil di Halaman Utama)</label>
                <textarea name="isi_pengumuman" rows="6" required><?= $pengumuman['isi_pengumuman']; ?></textarea>

                <p style="font-size: 13px; color: #bfc0d1; margin-top: 10px;">
                    Terakhir diubah: <?= date('d M Y H:i', strtotime($pengumuman['terakhir_diubah'])); ?>
                </p>

                <button type="submit" name="simpan_pengumuman" class="btn" style="width: 100%; margin-top: 15px; background-color: #2980b9;">Update Pengumuman</button>
            </form>
            <br>
            <div style="text-align: center;">
                <a href="dashboard.php" style="color: #bfc0d1; text-decoration: none;">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>