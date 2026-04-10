<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: login.php"); exit; }
require '../config/functions.php';

$id_proker = $_GET["id"];
$proker = query("SELECT * FROM proker WHERE id_proker = $id_proker")[0];
$departemen = query("SELECT * FROM dept");

if (isset($_POST["edit"])) {
    $nama_proker = htmlspecialchars($_POST["nama_proker"]);
    $id_dept = htmlspecialchars($_POST["id_dept"]);
    $pj_proker = htmlspecialchars($_POST["pj_proker"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $tgl_pelaksanaan = htmlspecialchars($_POST["tgl_pelaksanaan"]);
    $status = htmlspecialchars($_POST["status"]);

    $query = "UPDATE proker SET 
                nama_proker = '$nama_proker',
                id_dept = '$id_dept',
                pj_proker = '$pj_proker',
                deskripsi = '$deskripsi',
                tgl_pelaksanaan = '$tgl_pelaksanaan',
                status = '$status'
              WHERE id_proker = $id_proker";

    mysqli_query($conn, $query);

    echo "<script>
            alert('Data proker berhasil diubah!');
            window.location.href = 'dashboard.php';
          </script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Proker</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin: auto; margin-top: 50px;">
        <div class="card">
            <h2 style="color: #f7e6a1; margin-bottom: 20px;">Edit Data Proker</h2>
            <form action="" method="post">
                <label>Nama Program Kerja</label>
                <input type="text" name="nama_proker" value="<?= $proker['nama_proker']; ?>" required>

                <label>Departemen</label>
                <select name="id_dept" required>
                    <?php foreach($departemen as $d) { ?>
                        <option value="<?= $d['id_dept']; ?>" <?= ($d['id_dept'] == $proker['id_dept']) ? 'selected' : ''; ?>>
                            <?= $d['nama_dept']; ?>
                        </option>
                    <?php } ?>
                </select>

                <label>Penanggung Jawab (PJ)</label>
                <input type="text" name="pj_proker" value="<?= $proker['pj_proker']; ?>" required>

                <label>Tanggal Pelaksanaan</label>
                <input type="date" name="tgl_pelaksanaan" value="<?= $proker['tgl_pelaksanaan']; ?>" required>

                <label>Deskripsi Kegiatan</label>
                <textarea name="deskripsi" rows="4" required><?= $proker['deskripsi']; ?></textarea>

                <label>Status Pelaksanaan</label>
                <select name="status" required>
                    <option value="Belum Mulai" <?= ($proker['status'] == 'Belum Mulai') ? 'selected' : ''; ?>>Belum Mulai</option>
                    <option value="Sedang Berjalan" <?= ($proker['status'] == 'Sedang Berjalan') ? 'selected' : ''; ?>>Sedang Berjalan</option>
                    <option value="Selesai" <?= ($proker['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                </select>

                <button type="submit" name="edit" class="btn" style="width: 100%; margin-top: 15px;">Simpan Perubahan</button>
            </form>
            <br>
            <div style="text-align: center;">
                <a href="dashboard.php" style="color: #bfc0d1; text-decoration: none;">Batal dan Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>