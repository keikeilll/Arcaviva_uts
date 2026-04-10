<?php
require 'database.php';

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cek_bentrok($tgl_pelaksanaan) {
    global $conn;
    $query = "SELECT * FROM proker WHERE tgl_pelaksanaan = '$tgl_pelaksanaan'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function tambah_proker($data) {
    global $conn;
    $id_dept = htmlspecialchars($data["id_dept"]);
    $nama = htmlspecialchars($data["nama_proker"]);
    $pj = htmlspecialchars($data["pj_proker"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $tgl = htmlspecialchars($data["tgl_pelaksanaan"]);
    $status = "Belum Mulai";

    if (cek_bentrok($tgl)) {
        return -1; 
    }

    $query = "INSERT INTO proker (id_dept, nama_proker, pj_proker, deskripsi, tgl_pelaksanaan, status) 
              VALUES ('$id_dept', '$nama', '$pj', '$deskripsi', '$tgl', '$status')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_proker($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM proker WHERE id_proker = $id");
    return mysqli_affected_rows($conn);
}
function format_tanggal($tanggal) {
    $bulan = array (
        1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    
    $pecahkan = explode('-', $tanggal);
    
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>