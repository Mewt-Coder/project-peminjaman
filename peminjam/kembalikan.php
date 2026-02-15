<?php
session_start();
require '../fungsi/functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Data tidak ada");
}

$id = intval($_GET['id']);

// langsung update jadi dikembalikan
$sql = "UPDATE peminjaman 
        SET status='dikembalikan',
            tanggal_kembali = NOW()
        WHERE id_peminjaman=?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

echo "<script>
alert('Barang berhasil dikembalikan');
location.href='barang_pinjam.php';
</script>";
?>