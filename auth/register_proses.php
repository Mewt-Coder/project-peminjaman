<?php
session_start();
include '../fungsi/functions.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = trim($_POST['role']);

$allowedRoles = ['admin', 'petugas', 'peminjam'];
if (!in_array($role, $allowedRoles)){
    $_SESSION['error'] = "Invalid role selected";
    header("Location:../auth/register.php");
    exit;
}

// validasi kosong
 if (empty($username) || empty($password) || empty($role)){
    $_SESSION['error'] = "Please fill in all fields";
    header("Location: register.php");
    exit;
 }

// cek apakah username sudah ada
 $checkUser = "SELECT * FROM users WHERE username = ?";
 $stmt = mysqli_prepare($koneksi, $checkUser);
 mysqli_stmt_bind_param($stmt, "s", $username);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);

 if (mysqli_num_rows($result) > 0){
    $_SESSION['error'] = "Username already exists";
    header("Location: register.php");
    exit;
 }

//  simpan user
 $insertUser = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
 $stmt = mysqli_prepare($koneksi, $insertUser);
 mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
 mysqli_stmt_execute($stmt);

// sukses registrasi
$_SESSION['success'] = "Registration successful. Please Sign in.";  
header("Location: register.php");
exit;
?>