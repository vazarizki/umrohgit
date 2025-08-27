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
    
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <style>
        /* Desain Minimalis dan Modern */
        :root {
            --primary-color: #ff6600;
            --background-color: #f7f7f7;
            --text-color: #333;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .page-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background: #fafafa;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.1);
            outline: none;
        }
        
        /* Style untuk Summernote */
        .note-editor {
            border: 1px solid var(--border-color) !important;
            border-radius: 8px !important;
            box-shadow: none !important;
        }
        .note-toolbar.panel-default {
            background-color: #f5f5f5 !important;
            border-bottom: 1px solid var(--border-color) !important;
        }
        .note-editable {
            background-color: #fff !important;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #e45b00;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
                padding: 20px;
            }
        }
    </style>
</head>
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
            <textarea id="summernote" name="isi" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label for="gambar_blog">Gambar Artikel</label>
            <input class="input" name="gambar_blog" type="file" required />
        </div>
        
        <button type="submit" class="btn">Simpan</button>
    </form>
</main>

<!-- jQuery, Bootstrap JS, dan Summernote JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    // Inisialisasi Summernote pada textarea dengan ID 'summernote'
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis isi artikel di sini...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>

</body>
</html>
