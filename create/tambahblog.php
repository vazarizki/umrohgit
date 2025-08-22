<?php
include "../config.php";

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul   = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $isi = $conn->real_escape_string($_POST['isi']);

    $sql = "INSERT INTO blog (judul, isi, deskripsi) VALUES ('$judul', '$isi', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        // redirect ke blogs.php setelah sukses
        header("Location: ../backend.php#blog");
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
    <title>Tambah Blog</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    /* Form */
.form {
  max-width: 600px;
  margin: 20px auto;
  background: #fff;
  padding: 25px;
  border: 1px solid #eee;
  border-radius: 10px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-weight: 600;
  margin-bottom: 5px;
  color: #000;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 1rem;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #ff6600;
  outline: none;
}

</style>

<body>

<main class="container">
    <h2 class="page-title">Tambah Blog Baru</h2>
    
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="judul">Judul Blog</label>
            <input type="text" id="title" name="judul" required>
        </div>

         <div class="form-group">
            <label for="deskripsi">Meta Deskripsi</label>
            <input type="text" id="deskripsi" name="deskripsi" required>
        </div>

        <div class="form-group">
            <label for="isi">Isi Artikel</label>
            <textarea id="content" name="isi" rows="8" required></textarea>
        </div>

        <div class="field">
            <label for="gambar">URL Gambar (opsional)</label>
            <input class="input" name="gambar" type="url" placeholder="https://…" />
          </div>
          
        <button type="submit" class="btn">Simpan</button>
    </form>
</main>
</body>
</html>
