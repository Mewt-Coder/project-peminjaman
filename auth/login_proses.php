<?php
session_start();
include '../fungsi/functions.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$login = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($koneksi, $login);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {

    $user = mysqli_fetch_assoc($result);

    if (trim($password) === trim($user['password'])) {

        $_SESSION['login'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($user['role'] === 'petugas') {
            header("Location: ../petugas/dashboard.php");
        } elseif ($user['role'] === 'peminjam') {
            header("Location: ../peminjam/dashboard.php");
        } else {
            header("Location: ../login/login.php?error=role");
        }
        exit;

    } else {
        //  password salah
        $_SESSION['error'] = "Username or Password is incorrect";
        header("Location: login.php");
        exit;
    }

    } else {
        //  username tidak ditemukan
        $_SESSION['error'] = "Username not found";
        header("Location: login.php");
        exit;
    }

?>
