<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require '../config/functions.php';

$id = $_GET["id"];

$cek = hapus_proker($id);

if ($cek <= 0) {
    global $conn; 
    echo "Pesan Error MySQL: " . mysqli_error($conn);
    die(); 
}

if ($cek > 0) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus'); window.location.href='dashboard.php';</script>";
}
?>