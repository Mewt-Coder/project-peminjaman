<?php
session_start();
include '../fungsi/functions.php';

// cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// cek ID barang
if (!isset($_GET['id'])) {
    die("ID barang tidak ditemukan");
}

$item_id = intval($_GET['id']); // lebih aman dari SQL injection
$user_id = $_SESSION['user_id'];

// insert data peminjaman
$sql = "INSERT INTO peminjaman 
        (item_id, user_id, status, tanggal_pinjam, tanggal_kembali)
        VALUES (?, ?, 'pending', NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY))";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);

if (!mysqli_stmt_execute($stmt)) {
    die("Error: " . mysqli_error($koneksi));
}

echo "<script>
alert('Pengajuan peminjaman dikirim, tunggu persetujuan petugas');
window.location.href='barang.php';
</script>";
?>
