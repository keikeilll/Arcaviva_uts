<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: login.php"); exit; }
require '../config/functions.php';

$id_proker = $_GET["id"];
$proker = query("SELECT * FROM proker WHERE id_proker = $id_proker")[0];

// Tambah Tugas Baru
if(isset($_POST["tambah_tugas"])) {
    $tugas = htmlspecialchars($_POST["tugas"]);
    mysqli_query($conn, "INSERT INTO timeline (id_proker, tugas, is_done) VALUES ($id_proker, '$tugas', 0)");
    header("Location: kelola_timeline.php?id=$id_proker");
    exit;
}

if(isset($_POST["update_progress"])) {
    mysqli_query($conn, "UPDATE timeline SET is_done = 0 WHERE id_proker = $id_proker");
    if(isset($_POST["task_done"])) {
        foreach($_POST["task_done"] as $id_timeline) {
            mysqli_query($conn, "UPDATE timeline SET is_done = 1 WHERE id_timeline = $id_timeline");
        }
    }
    echo "<script>alert('Progress berhasil disimpan!'); window.location.href='kelola_timeline.php?id=$id_proker';</script>";
}

$timeline = query("SELECT * FROM timeline WHERE id_proker = $id_proker");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Timeline</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 700px; margin: auto; margin-top: 30px;">
        <div class="card">
            <h2 style="color: #f7e6a1;">Kelola Timeline: <?= $proker['nama_proker']; ?></h2>
            <br>
            <form action="" method="post" style="display: flex; gap: 10px; margin-bottom: 20px;">
                <input type="text" name="tugas" placeholder="Masukkan tahapan baru (cth: Survei Tempat)" required style="flex: 1; margin: 0;">
                <button type="submit" name="tambah_tugas" class="btn" style="background-color: #27ae60;">+ Tambah Tugas</button>
            </form>
            
            <hr style="border: 1px solid #1e202c; margin: 20px 0;">

            <form action="" method="post">
                <?php if(empty($timeline)) { ?>
                    <p>Belum ada tahapan proker.</p>
                <?php } else { ?>
                    <ul style="list-style: none; padding: 0;">
                        <?php foreach($timeline as $t) { ?>
                            <li style="padding: 10px; background: #1e202c; margin-bottom: 8px; border-radius: 5px;">
                                <label style="cursor: pointer; display: flex; align-items: center; gap: 10px;">
                                    <input type="checkbox" name="task_done[]" value="<?= $t['id_timeline']; ?>" <?= ($t['is_done'] == 1) ? 'checked' : ''; ?> style="width: 20px; height: 20px; margin: 0;">
                                    <?= $t['tugas']; ?>
                                </label>
                            </li>
                        <?php } ?>
                    </ul>
                    <button type="submit" name="update_progress" class="btn" style="width: 100%; margin-top: 15px;">Simpan Progress</button>
                <?php } ?>
            </form>
            <br>
            <div style="text-align: center;"><a href="dashboard.php" style="color: #bfc0d1;">Kembali ke Dashboard</a></div>
        </div>
    </div>
</body>
</html>