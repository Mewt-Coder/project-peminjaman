<?php
session_start();

// Hapus semua data session
$_SESSION = [];
session_unset();
session_destroy();

// redirect ke halaman login
header("Location: ../auth/login.php");
exit;


?>