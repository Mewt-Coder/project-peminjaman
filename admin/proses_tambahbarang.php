<?php
include '../fungsi/functions.php';

$nama_barang = trim($_POST['name_item']);
$nama_kategori = trim($_POST['kategori']);

// 1️⃣ CEK KATEGORI SUDAH ADA ATAU BELUM
$cek = "SELECT kategori_id FROM kategori WHERE nama_kategori = ?";
$stmt = mysqli_prepare($koneksi, $cek);
mysqli_stmt_bind_param($stmt, "s", $nama_kategori);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // kategori sudah ada
    $row = mysqli_fetch_assoc($result);
    $id_kategori = $row['kategori_id'];
} else {
    // 2️⃣ INSERT KATEGORI BARU
    $insertKategori = "INSERT INTO kategori (nama_kategori) VALUES (?)";
    $stmt = mysqli_prepare($koneksi, $insertKategori);
    mysqli_stmt_bind_param($stmt, "s", $nama_kategori);
    mysqli_stmt_execute($stmt);

    $id_kategori = mysqli_insert_id($koneksi);
}

// 3️⃣ INSERT BARANG
$insertItem = "INSERT INTO item (name_item, kategori_id) VALUES (?, ?)";
$stmt = mysqli_prepare($koneksi, $insertItem);
mysqli_stmt_bind_param($stmt, "si", $nama_barang, $id_kategori);
mysqli_stmt_execute($stmt);

// 4️⃣ REDIRECT
header("Location: daftar_barang.php?status=sukses");
exit;
?>
