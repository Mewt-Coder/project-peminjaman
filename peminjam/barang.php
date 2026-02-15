<?php
session_start();
include '../fungsi/functions.php';

// filter kategori
$where = "";
$params = [];

if (!empty($_GET['kategori'])) {
    $kategori_id = intval($_GET['kategori']);
    $where = "WHERE item.kategori_id = ?";
}

// query item
$sql_item = "SELECT item.item_id, item.name_item, kategori.nama_kategori
             FROM item
             JOIN kategori ON item.kategori_id = kategori.kategori_id
             $where";

$stmt = mysqli_prepare($koneksi, $sql_item);

if (!empty($kategori_id)) {
    mysqli_stmt_bind_param($stmt, "i", $kategori_id);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// daftar kategori untuk filter
$sql_kategori = "SELECT * FROM kategori";
$query_kategori = mysqli_query($koneksi, $sql_kategori);
$kategori_list = mysqli_fetch_all($query_kategori, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peminjam Dashboard</title>
<link rel="stylesheet" href="../src/output.css">
</head>

<body class="bg-gray-100 min-h-screen">

<div class="flex">

<!-- SIDEBAR -->
<aside class="w-52 bg-white shadow-lg min-h-screen p-6">
<h2 class="text-blue-500 text-lg font-semibold mb-6 text-center">
Pinjam.in
</h2>

<ul class="space-y-2">

<li>
<a href="../peminjam/dashboard.php"
class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
<img src="../icon/icon_home.svg" class="w-4 h-4">
Dashboard
</a>
</li>

<li>
<a href="../peminjam/barang.php"
class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
<img src="../icon/icon_item.png" class="w-4 h-4">
Daftar Barang
</a>
</li>

<li>
<a href="../peminjam/barang_pinjam.php"
class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
<img src="../icon/icon_item.png" class="w-4 h-4">
Barang Dipinjam
</a>
</li>

<li>
<a href="../auth/logout.php"
class="flex items-center px-4 py-2 gap-2 rounded-lg text-black hover:bg-red-700 hover:text-white transition">
<img src="../icon/icon_logout.svg" class="w-4 h-4">
Logout
</a>
</li>

</ul>
</aside>

<!-- CONTENT -->
<div class="flex-1">

<!-- NAVBAR -->
<div class="bg-blue-700 h-10 flex items-center shadow-md">
<p class="text-white mx-auto text-sm">Dashboard Peminjam</p>
</div>

<!-- MAIN -->
<main class="p-6">

<h1 class="text-2xl font-bold text-blue-500 mb-4">
Data Barang
</h1>

<!-- FILTER -->
<form method="GET" class="mb-4">
<select name="kategori"
onchange="this.form.submit()"
class="border px-3 py-2 rounded">

<option value="">Filter Kategori</option>

<?php foreach ($kategori_list as $kategori): ?>
<option value="<?= $kategori['kategori_id']; ?>"
<?= (isset($_GET['kategori']) && $_GET['kategori']==$kategori['kategori_id']) ? 'selected':''; ?>>
<?= htmlspecialchars($kategori['nama_kategori']); ?>
</option>
<?php endforeach; ?>

</select>
</form>

<!-- TABLE -->
<table class="w-full bg-white rounded-lg shadow">

<thead class="bg-gray-100">
<tr>
<th class="py-2">No</th>
<th>ID Barang</th>
<th>Nama Barang</th>
<th>Kategori</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $no=1; ?>
<?php while($row=mysqli_fetch_assoc($result)): ?>
<tr class="border-t hover:bg-gray-50">

<td class="text-center py-2"><?= $no++; ?></td>

<td class="text-center">
<?= htmlspecialchars($row['item_id']); ?>
</td>

<td>
<?= htmlspecialchars($row['name_item']); ?>
</td>

<td>
<?= htmlspecialchars($row['nama_kategori']); ?>
</td>

<td class="text-center">
<a href="proses_pinjam.php?id=<?= $row['item_id']; ?>"
class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
Pinjam
</a>
</td>

</tr>
<?php endwhile; ?>
</tbody>

</table>

</main>
</div>
</div>

</body>
</html>
