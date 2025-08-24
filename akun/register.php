<?php
// Sertakan file koneksi database
include "../config.php";

$message = "";
$message_color = "black"; // Warna default

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $message = "Username, password, dan konfirmasi password tidak boleh kosong.";
        $message_color = "red";
    } else if ($password !== $confirm_password) {
        // Cek apakah password dan konfirmasi password cocok
        $message = "Password dan konfirmasi password tidak cocok.";
        $message_color = "red"; // Mengatur warna menjadi merah
    } else {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Gunakan prepared statement untuk mencegah SQL Injection
        // Ganti 'akun' dengan '_akun' jika itu nama tabel yang benar
        $stmt = $conn->prepare("INSERT INTO akun (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $message = "Akun berhasil dibuat! Silakan <a href='login.php'>Login</a>.";
            $message_color = "green"; // Mengatur warna menjadi hijau untuk pesan sukses
        } else {
            $message = "Error: " . $stmt->error;
            $message_color = "red";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    /* style.css */

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary-color: #007bff;
    --secondary-color: #f8f9fa;
    --text-color: #343a40;
    --bg-color: #e9ecef;
    --card-bg-color: #ffffff;
    --border-color: #dee2e6;
    --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.08);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    line-height: 1.6;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    background-color: var(--card-bg-color);
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: var(--shadow-light);
    width: 100%;
    max-width: 450px;
    transition: transform 0.3s ease-in-out;
}

.container:hover {
    transform: translateY(-5px);
}

h2 {
    font-size: 2rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.form-group input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    outline: none;
}

button {
    width: 100%;
    padding: 0.85rem;
    border: none;
    border-radius: 8px;
    background-color: var(--primary-color);
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 1rem;
}

button:hover {
    background-color: #0056b3;
}

.message {
    margin-top: 1.5rem;
    text-align: center;
    font-size: 0.9rem;
}

.message a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

.message a:hover {
    text-decoration: underline;
}

/* ADMIN DASHBOARD STYLING */
.admin-dashboard {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 900px;
    background-color: var(--card-bg-color);
    border-radius: 12px;
    box-shadow: var(--shadow-light);
    min-height: 80vh;
}

.dashboard-header {
    background-color: var(--primary-color);
    color: white;
    padding: 1.5rem 2.5rem;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dashboard-header h1 {
    font-size: 1.8rem;
    font-weight: 600;
}

.dashboard-header a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.dashboard-header a:hover {
    background-color: #0056b3;
}

.dashboard-content {
    padding: 2.5rem;
}
</style>

<body>
    <div class="container">
        <h2>Daftar Akun</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Daftar</button>
        </form>
        <?php if (!empty($message)): ?>
            <p class="message" style="color: <?php echo $message_color; ?>;"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
