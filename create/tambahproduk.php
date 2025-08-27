<?php
include "../config.php";

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah ada file yang diunggah
    if (isset($_FILES['gambar_produk']) && $_FILES['gambar_produk']['error'] == 0) {
        // Mendefinisikan folder target untuk menyimpan gambar
        $target_dir = "../assets/";
        // Mendapatkan nama file
        $gambar_name = basename($_FILES["gambar_produk"]["name"]);
        // Mendefinisikan path lengkap untuk file yang diunggah
        $target_file = $target_dir . $gambar_name;

        // Pindahkan file yang diunggah ke folder target
        if (move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file)) {
            // Jika file berhasil diunggah, simpan data ke database
            $judul = $conn->real_escape_string($_POST['judul']);
            $harga = $conn->real_escape_string($_POST['harga']);
            $deskripsi = $conn->real_escape_string($_POST['deskripsi_produk']);
            $isi = $conn->real_escape_string($_POST['isi_produk']);
            $itinerary = $conn->real_escape_string($_POST['itinerary']);
            // Nama file gambar yang akan disimpan di database
            $gambar_db = $gambar_name;

            $sql = "INSERT INTO produk (judul, harga, deskripsi, gambar, isi, itinerary) VALUES ('$judul', '$harga', '$deskripsi', '$gambar_db', '$isi', '$itinerary')";
            
            if ($conn->query($sql) === TRUE) {
                // redirect ke backend.php setelah sukses
                header("Location: ../backend.php#produk");
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
    <link rel="icon" type="image/png" href="../assets/TWS TP.png">
    <title>Tambah Produk</title>
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
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

    /* Style untuk Summernote */
    .note-editor {
        border: 1px solid #ddd !important;
        border-radius: 8px !important;
    }
    .note-toolbar {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid #ddd !important;
        border-radius: 8px 8px 0 0 !important;
    }
    .note-editable {
        background-color: #fff !important;
        color: #333 !important;
    }
    .note-popover .popover, .note-tooltip {
        background-color: #fff !important;
        border: 1px solid #ddd !important;
    }
    </style>
</head>

<body>

<main class="container">
    <h2 class="page-title">Tambah Produk Baru</h2>
    
    <form action="" method="POST" enctype="multipart/form-data" class="form">
        <div class="form-group">
            <label for="judul">Nama Produk</label>
            <input type="text" id="title" name="judul" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" required>
        </div>

        <div class="form-group">
            <label for="deskripsi_produk">Meta Deskripsi</label>
            <textarea id="deskripsi_produk" name="deskripsi_produk" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label for="isi_produk">Detail Produk</label>
            <textarea id="isi_produk" name="isi_produk" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label for="itinerary">Itinerary</label>
            <textarea id="itinerary" name="itinerary" rows="8" required></textarea>
        </div>

        <div class="field">
            <label for="gambar_produk">Gambar Produk</label>
            <input class="input" name="gambar_produk" type="file" required />
          </div>
          
        <button type="submit" class="btn">Simpan</button>
    </form>
</main>

<!-- jQuery, Bootstrap JS, dan Summernote JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    // Inisialisasi Summernote pada textarea dengan ID 'isi_produk' dan 'itinerary'
    $(document).ready(function() {
        $('#isi_produk').summernote({
            placeholder: 'Tulis detail produk di sini...',
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
        $('#itinerary').summernote({
            placeholder: 'Tulis itinerary di sini...',
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
