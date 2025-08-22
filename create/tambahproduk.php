<?php
include "../config.php";

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul   = $conn->real_escape_string($_POST['judul']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $isi = $conn->real_escape_string($_POST['deskripsi']);
    $deskripsi = $conn->real_escape_string($_POST['isi']);
    $gambar = $conn->real_escape_string($_POST['gambar']);

    $sql = "INSERT INTO produk (judul, harga, deskripsi, gambar, isi) VALUES ('$judul', '$harga', '$isi', '$gambar', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        // redirect ke blogs.php setelah sukses
        header("Location: ../backend.php#produk");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
     <link rel="icon" type="image/png" href="../assets/TWS TP.png">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
/* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f5f5f5;
  color: #333;
  line-height: 1.6;
  padding: 20px;
}

/* Container */
.container {
  max-width: 800px;
  margin: 30px auto;
  background: #fff;
  padding: 40px;
  border-radius: 16px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

/* Title */
.page-title {
  text-align: center;
  margin-bottom: 25px;
  font-size: 1.8rem;
  font-weight: 700;
  color: #ff6600;
}

/* Form */
.form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: 600;
  margin-bottom: 6px;
  color: #111;
}

.form-group input,
.form-group textarea {
  padding: 12px 14px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: border 0.2s ease;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #ff6600;
  outline: none;
  box-shadow: 0 0 0 3px rgba(255,102,0,0.15);
}

/* Button */
.btn {
  background: #ff6600;
  color: #fff;
  font-size: 1rem;
  font-weight: 600;
  border: none;
  border-radius: 8px;
  padding: 12px;
  cursor: pointer;
  transition: background 0.2s ease, transform 0.1s ease;
}

.btn:hover {
  background: #e65500;
  transform: translateY(-2px);
}

.btn:active {
  transform: translateY(0);
}

</style>

<body>

<main class="container">
    <h2 class="page-title">Tambah Produk Baru</h2>
    
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="judul">Nama Produk</label>
            <input type="text" id="title" name="judul" required>
        </div>

         <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Meta Deskripsi</label>
            <textarea id="content" name="deskripsi" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label for="deskripsi">Detail Produk</label>
            <textarea id="content" name="deskripsi" rows="8" required></textarea>
        </div>

        <div class="field">
            <label for="gambar">Gambar Produk </label>
            <input class="input" name="gambar" type="file" placeholder="https://…" />
          </div>
          
        <button type="submit" class="btn">Simpan</button>
    </form>
</main>
</body>
</html>
