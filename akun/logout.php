<?php
// logout.php
session_start();      // 1. Memulai sesi yang sedang aktif
session_unset();      // 2. Menghapus semua variabel sesi
session_destroy();    // 3. Menghancurkan sesi sepenuhnya

header("Location: ../home.php"); // 4. Mengarahkan pengguna kembali ke halaman login
exit();                       // 5. Menghentikan eksekusi skrip
?>