<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require '../config/functions.php';

$id = $_GET["id"];
if (hapus_proker($id) > 0) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus'); window.location.href='dashboard.php';</script>";
}
?>