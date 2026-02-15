<?php
require '../fungsi/functions.php';
session_start();

if (!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ambil data peminjaman sesuai user
$query = mysqli_query($koneksi, "
    SELECT peminjaman.*, item.name_item
    FROM peminjaman
    JOIN item ON peminjaman.item_id = item.item_id
    WHERE peminjaman.user_id = '$user_id'
    ORDER BY peminjaman.tanggal_pinjam DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Dashboard</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-52 bg-white shadow-lg min-h-screen p-6">
        <h2 class="text-blue-500 text-lg font-semibold mb-6 text-center">Pinjam.in</h2>

        <ul class="space-y-2">
          <li>
                <a href="../peminjam/dashboard.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/icon_home.svg" alt="Dashboard Icon" class="w-4 h-4">
                    <span>Dashboard</span>
                </a>
          </li>
            <li>
                <a href="../peminjam/barang.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/folder.png" alt="Peminjaman Icon" class="w-4 h-4">
                    <span>Daftar Barang</span>
                </a>
            </li>
            <li>
                <a href="../peminjam/barang_pinjam.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/folder.png" alt="Peminjaman Icon" class="w-4 h-4">
                    <span>Riwayat Peminjaman</span>
                </a>
            </li>
            <li>
                <a href="../auth/logout.php"
                    class="flex items-center px-4 py-2 gap-2 rounded-lg
                            text-black hover:bg-red-700 hover:text-white transition">

                    <img src="../icon/icon_logout.svg"
                        alt="Logout Icon"
                        class="w-4 h-4">

                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <div class="flex-1">

        <!-- NAVBAR -->
        <div class="bg-blue-700 h-10 flex items-center shadow-md relative">
            <p class="text-white mx-auto text-sm">Petugas Dashboard</p>
            
        </div>

        <!-- MAIN -->
        <main class="p-6">

            <h1 class="text-2xl font-semibold text-gray-800 mb-4">
                Riwayat Peminjaman
            </h1>

            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <table class="w-full text-sm text-left">

            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Barang</th>
                    <th class="px-4 py-3">Tanggal Pinjam</th>
                    <th class="px-4 py-3">Tanggal Kembali</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) :
                ?>
                <tr class="border-b hover:bg-gray-50">

                <td class="px-4 py-2"><?= $no++; ?></td>

                <td class="px-4 py-2 font-medium">
                    <?= $data['name_item']; ?>
                </td>

                <td class="px-4 py-2">
                    <?= $data['tanggal_pinjam']; ?>
                </td>

                <td class="px-4 py-2">
                    <?= $data['tanggal_kembali']; ?>
                </td>

                <td class="px-4 py-2">
                <?php
                if ($data['status'] == 'approved') {
                    echo "<span class='bg-green-500 text-white px-3 py-1 rounded-full text-xs'>Approved</span>";
                } elseif ($data['status'] == 'ditolak') {
                    echo "<span class='bg-red-500 text-white px-3 py-1 rounded-full text-xs'>Ditolak</span>";
                } elseif ($data['status'] == 'dikembalikan') {
                    echo "<span class='bg-blue-500 text-white px-3 py-1 rounded-full text-xs'>Dikembalikan</span>";
                } else {
                    echo "<span class='bg-yellow-500 text-white px-3 py-1 rounded-full text-xs'>Pending</span>";
                }

                ?>
                </td>
                <td>
                    <?php if ($data['status'] == 'approved') : ?>
                        <a href="proses_pinjam.php?id=<?= $data['id_peminjaman'] ?>"
                        onclick="return confirm('Yakin mau kembalikan barang?')"
                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Kembalikan
                        </a>

                        <?php elseif ($data['status'] == 'dikembalikan') : ?>
                        <span class="text-gray-400 italic">Selesai</span>

                        <?php else : ?>
                        <span class="text-gray-400 text-sm">-</span>
                    <?php endif; ?>
                </td>

                </tr>
                <?php endwhile; ?>

            </tbody>
            </table>
            </div>

        </main>

    </div>

</div>

</body>


    

</body>
</html>