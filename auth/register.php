<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- notif gagal register -->
    <?php if (isset($_SESSION['error'])): ?>

        <!-- backdrop -->
    <div class="fixed inset-0 bg-black/90 flex items-center justify-center z-50">

    <!-- alert box -->
    <div class="p-4 rounded-lg bg-red-50 border border-red-200
                dark:bg-red-900/30 dark:border-red-800
                w-full max-w-sm shadow-xl animate-scaleIn">

        <div class="flex items-center gap-3">

        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>

        <p class="text-red-800 dark:text-red-200 font-medium">
            <?= $_SESSION['error']; ?>
        </p>
        </div>

        <button onclick="this.closest('.fixed').remove()" class="mt-4 w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
        OK
        </button>

        </div>
    </div>
    <?php unset($_SESSION['error']); endif; ?>

    <!-- notif register berhasil -->
     <?php if (isset($_SESSION['success'])): ?>

        <!-- backdrop -->
    <div class="fixed inset-0 bg-black/90 flex items-center justify-center z-50">

        
        <!-- alert box -->
        <div class="p-4 rounded-lg bg-green-50 border border-green-200 dark:bg-green-900/30 dark:border-green-800">

            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <p class="text-green-800 dark:text-green-200 font-medium">
                    <?= $_SESSION['success']; ?>
                </p>
                <button onclick="this.closest('.fixed').remove(); window.location.href='../auth/login.php';" class="mt-4 w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                    Sign In
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php unset($_SESSION['success']); ?>


    <div class="bg-white shadow-lg w-full max-w-sm p-6 rounded-2xl">
        <form action="../auth/register_proses.php" method="post">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-2">Welcome to Our Platform</h2>
            <p class="text-center text-gray-600 mb-6 ">Create an account to get started</p>
            
            <input type="text" name="username" placeholder="Username" required
            class="rounded hover:pointer border border-gray-200 focus:ring-2 focus:ring-blue-700 focus:outline-none w-full p-2 mb-4">

            <input type="password" name="password" placeholder="Password" required
            class="rounded hover:pointer border border-gray-200 focus:ring-2 focus:ring-blue-700 focus:outline-none w-full p-2 mb-6">   
            
            <select required name="role" class="rounded border border-gray-200 focus:ring-2 focus:ring-blue-700 focus:outline-none w-full p-2 mb-6">
                <option value="" disabled selected>Select Role</option>
                <option value="peminjam">Peminjam</option>
                <option value="petugas">Petugas</option>
            </select>

            <button type="submit" class="text-white w-full rounded bg-blue-500 hover:bg-blue-800 hover:scale-105 transform transition duration-300 ease-in-out  p-2">
                Sign Up
            </button>
            <p class="text-gray-900 text-center mt-4">
                Have an account? <a href="../auth/login.php" class="text-blue-700 font-semibold hover:text-blue-500">Sign In</a>
            </p>
        </form>
    </div>
</body>
</html>