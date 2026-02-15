<?php
require '../fungsi/functions.php';

$id = $_GET['id'];
$status = $_GET['status'];

// status yang dipakai sekarang
$allowed = ['approved','ditolak','pending','dikembalikan'];

if (!in_array($status, $allowed)) {
    die("Status tidak valid");
}

mysqli_query($koneksi, "
    UPDATE peminjaman 
    SET status='$status' 
    WHERE id_peminjaman='$id'
");

header("Location: dashboard.php");
exit;
