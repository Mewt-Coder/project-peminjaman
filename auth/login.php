<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- notif jika username atau password salah -->
    <?php if (isset($_SESSION['error'])): ?>

    <!-- backdrop -->
    <div class="fixed inset-0 bg-black/90 flex items-center justify-center z-50">

    <!-- alert box -->
    <div class="p-4 rounded-lg bg-red-50 border border-red-200
                dark:bg-red-900/30 dark:border-red-800
                w-full max-w-sm shadow-xl animate-scaleIn">

        <div class="flex items-center gap-3">
        <svg class="w-5 h-5 text-red-600 dark:text-red-400"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>

        <p class="text-red-800 dark:text-red-200 font-medium">
            <?= $_SESSION['error']; ?>
        </p>
        </div>

        <button
        onclick="this.closest('.fixed').remove()"
        class="mt-4 w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
        OK
        </button>

    </div>
    </div>
    <?php unset($_SESSION['error']); endif; ?>



    <div class="bg-white shadow-lg w-full max-w-sm p-6 rounded-2xl">

        <form action="../auth/login_proses.php" method="post">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-2">Welcome Back</h2>
            <p class="text-center text-gray-600 mb-6 ">Sign in to continue to your account</p>
            
            <input type="text" name="username" placeholder="Username" required
            class="rounded hover:pointer border border-gray-200 focus:ring-2 focus:ring-blue-700 focus:outline-none w-full p-2 mb-4">

            <input type="password" name="password" placeholder="Password" required
            class="rounded hover:pointer border border-gray-200 focus:ring-2 focus:ring-blue-700 focus:outline-none w-full p-2 mb-6">      
            
            <button type="submit" class="text-white w-full rounded bg-blue-500 hover:bg-blue-800 hover:scale-105 transform transition duration-300 ease-in-out  p-2">
                Sign In
            </button>
            <p class="text-gray-900 text-center mt-4">
                Don't have an account? <a href="../auth/register.php" class="text-blue-700 font-semibold hover:text-blue-500">Sign Up</a>
            </p>
        </form>
    </div>
</body>
</html>