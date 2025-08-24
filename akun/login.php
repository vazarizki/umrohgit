<?php
session_start();
include "../config.php";

$message = "";

// Cek apakah pengguna sudah login
if (isset($_SESSION['admin_id'])) {
    header("Location: ../backend.php");
    exit();
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mengambil data admin
    $stmt = $conn->prepare("SELECT id, username, password FROM akun WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login berhasil, buat session
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: ../backend.php");
            exit();
        } else {
            $message = "Password salah. Silakan coba lagi.";
        }
    } else {
        $message = "Username tidak ditemukan.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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
        <h2>Login Admin</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($message)): ?>
            <p class="message" style="color: #dc3545;"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>