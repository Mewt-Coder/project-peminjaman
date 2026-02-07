<?php
include '../fungsi/functions.php';

$where = "";

if (!empty($_GET['kategori'])) {
    $kategori_id = mysqli_real_escape_string($koneksi, $_GET['kategori']);
    $where = "WHERE item.kategori_id = '$kategori_id'";
}

$sql_item = "SELECT item.item_id, item.name_item, kategori.nama_kategori
             FROM item 
             JOIN kategori ON item.kategori_id = kategori.kategori_id
             $where";

$result = mysqli_query($koneksi, $sql_item);


// Query daftar kategori untuk select
$sql_kategori = "SELECT * FROM kategori";
$query_kategori = mysqli_query($koneksi, $sql_kategori);
$kategori_list = mysqli_fetch_all($query_kategori, MYSQLI_ASSOC);

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
                <h1 class="text-2xl font-bold text-blue-500 text-center">Data Barang</h1>
                    <a href="../admin/tambah_barang.php"
                        class="flex items-center gap-2 text-gray-800 hover:text-blue-500 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        viewBox="0 0 448 512"
                        fill="currentColor">
                    <path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/>
                    </svg>

                    <span>Tambah Barang</span>
                    </a>
            </div>

            <!-- isi content -->
            <div class="flex mt-4">
              <table class="items-center w-full border-collapse border border-gray-300">
                <thead>
                  <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">ID Barang</th>
                    <th class="border px-4 py-2">Nama Barang</th>
                    <th class="border px-4 py-2">
                        <form method="GET">
                            <select name="kategori" onchange="this.form.submit()">
                                <option value="">Filter Kategori</option>
                                <?php foreach ($kategori_list as $kategori): ?>
                                    <option value="<?= htmlspecialchars($kategori['kategori_id']) ?>"
                                        <?= (isset($_GET['kategori']) && $_GET['kategori'] == $kategori['kategori_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($kategori['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                  <tr class="hover:bg-gray-300 transition">
                    <td class="border px-4 py-2"><?= $no ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['item_id']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['name_item']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_kategori']) ?></td>
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