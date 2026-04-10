<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: login.php"); exit; }
require '../config/functions.php';

$id_proker = $_GET["id"];
$proker = query("SELECT * FROM proker WHERE id_proker = $id_proker")[0];

$cek_arsip = query("SELECT * FROM arsip WHERE id_proker = $id_proker");
$is_exist = count($cek_arsip) > 0;
$arsip = $is_exist ? $cek_arsip[0] : null;

if (isset($_POST["simpan_arsip"])) {
    $link_drive = htmlspecialchars($_POST["link_drive"]);
    $link_lpj = htmlspecialchars($_POST["link_lpj"]);
    $catatan = htmlspecialchars($_POST["catatan"]);

    if ($is_exist) {
        $query = "UPDATE arsip SET 
                    link_drive = '$link_drive', 
                    link_lpj = '$link_lpj', 
                    catatan = '$catatan' 
                  WHERE id_proker = $id_proker";
    } else {
        $query = "INSERT INTO arsip (id_proker, link_drive, link_lpj, catatan) 
                  VALUES ($id_proker, '$link_drive', '$link_lpj', '$catatan')";
    }

    mysqli_query($conn, $query);
    
    echo "<script>
            alert('Data arsip berhasil disimpan!');
            window.location.href = 'dashboard.php';
          </script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Arsip Proker</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin: auto; margin-top: 50px;">
        <div class="card">
            <h2 style="color: #f7e6a1; margin-bottom: 5px;">Kelola Arsip</h2>
            <p style="color: #bfc0d1; margin-bottom: 20px;">Proker: <?= $proker['nama_proker']; ?></p>

            <?php if($proker['status'] != 'Selesai') { ?>
                <div style="background-color: #e74c3c; padding: 15px; border-radius: 5px; color: white; margin-bottom: 15px;">
                    <strong>Peringatan!</strong> Status proker ini belum "Selesai". Pastikan proker sudah selesai sebelum mengarsipkan dokumen.
                </div>
            <?php } ?>

            <form action="" method="post">
                <label>Link Google Drive (Dokumentasi)</label>
                <input type="url" name="link_drive" value="<?= $is_exist ? $arsip['link_drive'] : ''; ?>" placeholder="https://drive.google.com/..." required>

                <label>Link LPJ (Laporan Pertanggungjawaban)</label>
                <input type="url" name="link_lpj" value="<?= $is_exist ? $arsip['link_lpj'] : ''; ?>" placeholder="https://docs.google.com/..." required>

                <label>Catatan Evaluasi Kegiatan</label>
                <textarea name="catatan" rows="6" placeholder="Tuliskan kendala dan saran untuk kepengurusan tahun depan..." required><?= $is_exist ? $arsip['catatan'] : ''; ?></textarea>

                <button type="submit" name="simpan_arsip" class="btn" style="width: 100%; margin-top: 15px; background-color: #2980b9;">Simpan Arsip</button>
            </form>
            <br>
            <div style="text-align: center;">
                <a href="dashboard.php" style="color: #bfc0d1; text-decoration: none;">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>