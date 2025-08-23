<?php
include "../config.php";

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah ada file yang diunggah
    if (isset($_FILES['gambar_blog']) && $_FILES['gambar_blog']['error'] == 0) {
        // Mendefinisikan folder target untuk menyimpan gambar
        $target_dir = "uploads/";
        // Mendapatkan nama file
        $gambar_name = basename($_FILES["gambar_blog"]["name"]);
        // Mendefinisikan path lengkap untuk file yang diunggah
        $target_file = $target_dir . $gambar_name;

        // Pindahkan file yang diunggah ke folder target
        if (move_uploaded_file($_FILES["gambar_blog"]["tmp_name"], $target_file)) {
            // Jika file berhasil diunggah, simpan data ke database
            $judul = $conn->real_escape_string($_POST['judul']);
            $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
            $isi = $conn->real_escape_string($_POST['isi']);
            // Nama file gambar yang akan disimpan di database
            $gambar_db = $gambar_name;

            // Tambahkan kolom 'gambar' pada query INSERT
            $sql = "INSERT INTO blog (judul, isi, deskripsi, gambar) VALUES ('$judul', '$isi', '$deskripsi', '$gambar_db')";
            
            if ($conn->query($sql) === TRUE) {
                // redirect ke backend.php setelah sukses
                header("Location: ../backend.php#blog");
                exit;
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }
    } else {
        echo "Maaf, Anda harus mengunggah file gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
     <link rel="icon" type="image/png" href="assets/TWS TP.png">
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
    
    <form action="" method="POST" enctype="multipart/form-data" class="form">
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
            <label for="gambar_blog">Gambar Artikel</label>
            <input class="input" name="gambar_blog" type="file" required />
        </div>
        
        <button type="submit" class="btn">Simpan</button>
    </form>
</main>
</body>
</html>
