<?php
require '../fungsi/functions.php';
session_start();

if (!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

// ambil data peminjaman
$peminjaman = mysqli_query($koneksi, "
    SELECT peminjaman.*, item.name_item, users.username
    FROM peminjaman
    JOIN item ON peminjaman.item_id = item.item_id
    JOIN users ON peminjaman.user_id = users.user_id
    ORDER BY peminjaman.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Peminjaman</title>
<link rel="stylesheet" href="../src/output.css">
</head>

<body class="bg-gray-100 min-h-screen">

<div class="flex">

<!-- SIDEBAR (TIDAK DIUBAH) -->
<aside class="w-52 bg-white shadow-lg min-h-screen p-6">
<h2 class="text-blue-500 text-lg font-semibold mb-6 text-center">
Pinjam.in
</h2>

<ul class="space-y-2">
<li>
<a href="../admin/dashboard.php"
class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
<img src="../icon/icon_home.svg" class="w-4 h-4">
Dashboard
</a>
</li>

<li>
<a href="../admin/data_peminjaman.php"
class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
<img src="../icon/folder.png" class="w-4 h-4">
Data Peminjaman
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

<!-- NAVBAR (TIDAK DIUBAH) -->
<div class="bg-blue-700 h-10 flex items-center shadow-md relative">
<p class="text-white mx-auto text-sm">Data Peminjaman</p>
</div>

<!-- MAIN -->
<main class="p-6">

<table class="w-full bg-white rounded-xl shadow overflow-hidden">

<thead class="bg-gray-100 text-gray-700 text-sm">
<tr>
<th class="py-3 px-4 text-center">No</th>
<th class="px-4">Nama Peminjam</th>
<th class="px-4">Barang</th>
<th class="px-4 text-center">Tanggal Pinjam</th>
<th class="px-4 text-center">Tanggal Kembali</th>
<th class="px-4 text-center">Status</th>
<th class="px-4 text-center">Aksi</th>
</tr>
</thead>

<tbody class="text-sm text-gray-700">

<?php $no=1; ?>
<?php while($data=mysqli_fetch_assoc($peminjaman)): ?>

<tr class="border-t hover:bg-gray-50">

<td class="text-center py-2">
<?= $no++; ?>
</td>

<td>
<?= htmlspecialchars($data['username']); ?>
</td>

<td>
<?= htmlspecialchars($data['name_item']); ?>
</td>

<td class="text-center">
<?= $data['tanggal_pinjam']; ?>
</td>

<td class="text-center">
<?= $data['tanggal_kembali'] ?: '-'; ?>
</td>

<td class="text-center">
<?php
if ($data['status']=='pending'){
echo "<span class='bg-yellow-200 text-yellow-700 px-3 py-1 rounded-full text-xs'>Pending</span>";
}elseif ($data['status']=='approved'){
echo "<span class='bg-green-200 text-green-700 px-3 py-1 rounded-full text-xs'>Dipinjam</span>";
}elseif ($data['status']=='dikembalikan'){
echo "<span class='bg-gray-300 text-gray-700 px-3 py-1 rounded-full text-xs'>Dikembalikan</span>";
}else{
echo "<span class='bg-red-200 text-red-700 px-3 py-1 rounded-full text-xs'>Ditolak</span>";
}
?>
</td>

<td class="text-center">

<?php if ($data['status']=='pending'){ ?>

<a href="update_status.php?id=<?= $data['id_peminjaman']; ?>&status=approved"
class="bg-green-500 text-white px-3 py-1 rounded">
Approve
</a>

<a href="update_status.php?id=<?= $data['id_peminjaman']; ?>&status=ditolak"
class="bg-red-500 text-white px-3 py-1 rounded">
Tolak
</a>

<?php } else { ?>

<span class="text-gray-400 italic">Selesai</span>

<?php } ?>

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
