<?php
include '../fungsi/functions.php';

$where = "";

if (!empty($_GET['role'])) {
    $role = mysqli_real_escape_string($koneksi, $_GET['role']);
    $where = "WHERE users.role = '$role'";
}

$sql_item = "SELECT users.user_id, users.username, users.role
             FROM users 
             $where";
$result = mysqli_query($koneksi, $sql_item);


// Query daftar kategori untuk select
$sql_role = "SELECT DISTINCT role FROM users";
$query_role = mysqli_query($koneksi, $sql_role);
$role_list = mysqli_fetch_all($query_role, MYSQLI_ASSOC);

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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-blue-500 text-center">Daftar User</h1>
                    
            </div>

            <!-- isi content -->
            <div class="flex mt-4">
              <table class="items-center w-full border-collapse border border-gray-300">
                <thead>
                  <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">ID User</th>
                    <th class="border px-4 py-2">Nama User</th>
                    <th class="border px-4 py-2">Role</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                  <tr class="hover:bg-gray-300 transition">
                    <td class="border px-4 py-2"><?= $no ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['user_id']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['username']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['role']) ?></td>
                    </tr>
                    <?php $no++; ?>
                    <?php endwhile; ?>
                </tbody>
              </table>
        </main>

    </div>

</div>

</body>


    

</body>
</html>