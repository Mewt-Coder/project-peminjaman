<?php

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

        <!-- isi content -->
        <div class="bg-white rounded-lg shadow relative m-3">

            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Tambah Barang
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="product-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <form action="../admin/proses_tambahbarang.php" method="POST" >
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="product-name" class="text-sm font-medium text-gray-900 block mb-2">Product Name</label>
                            <input type="text" name="name_item" id="product-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Category</label>
                            <input type="text" name="kategori" id="category" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                        </div>
                        <div class="p-6 border-t border-gray-200 rounded-b">
                            <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-7 py-2.5 text-center" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>

            
        </div>
    </div>
</div>

</body>


    

</body>
</html>