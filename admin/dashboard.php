<?php
require '../fungsi/functions.php';
session_start();

if (!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

// data user
 $q1 = mysqli_query($koneksi, "SELECT COUNT(*) AS total_users FROM users");
$data_user = mysqli_fetch_assoc($q1);

// data barang
$q2 = mysqli_query($koneksi, "SELECT COUNT(*) AS total_items FROM item");
$data_barang = mysqli_fetch_assoc($q2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-52 bg-white shadow-lg min-h-screen p-6">
        <h2 class="text-blue-500 text-lg font-semibold mb-6 text-center">Pinjam.in</h2>

        <ul class="space-y-2">
          <li>
                <a href="../admin/dashboard.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/icon_home.svg" alt="Dashboard Icon" class="w-4 h-4">
                    <span>Dashboard</span>
                </a>
          </li>

            <li>
                <a href="../admin/daftar_barang.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/icon_item.png" alt="Barang Icon" class="w-4 h-4">
                    <span>Daftar Barang</span>
                </a>
            </li>
            <li>
                <a href="../admin/daftar_user.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/icon_user.svg" alt="User Icon" class="w-4 h-4">
                    <span>Daftar User</span>
                </a>
            </li>
            <li>
                <a href="../admin/data_peminjaman.php"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                    <img src="../icon/folder.png" alt="Peminjaman Icon" class="w-4 h-4">
                    <span>Data Peminjaman</span>
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
            <p class="text-white mx-auto text-sm">Admin Dashboard</p>
            
        </div>

        <!-- MAIN -->
        <main class="p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">
                Welcome <?= ucfirst($_SESSION['username']); ?>
            </h1>
            <p class="text-gray-600">Manage your inventory and users efficiently.</p>

            <!-- isi content -->
            <div class="flex mt-4">
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-1 ">Data User</h3>
                    <h2 class="text-2xl font-bold"><?= $data_user['total_users'] ?></h2>
                    <a href="../admin/daftar_user.php" class="text-black hover:text-blue-500 pt-4">Kelola Data</a>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 ml-6 border-l-4 border-green-500 hover:shadow-xl hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2">Data Barang</h3>
                    <h2 class="text-2xl font-bold"><?= $data_barang['total_items'] ?></h2>
                    <a href="../admin/daftar_barang.php" class="text-black hover:text-blue-500 pt-4">Kelola Data</a>
            </div>
        </main>

    </div>

</div>

</body>


    

</body>
</html>