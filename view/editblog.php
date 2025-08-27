<?php
// editblog.php

// PENTING: Selalu panggil session_start() di awal skrip
session_start();

// Periksa apakah pengguna sudah login
// Jika tidak ada session 'admin_id', arahkan kembali ke halaman login.
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../akun/login.php");
    exit();
}

include "../config.php";

$message = "";
$message_color = "black";
$current_image = "";

// Pastikan ada ID blog di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data blog (termasuk path gambar) dari database
    $stmt = $conn->prepare("SELECT judul, isi, gambar, deskripsi FROM blog WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $blog_data = $result->fetch_assoc();
        $judul = $blog_data['judul'];
        $isi = $blog_data['isi'];
        $deskripsi = $blog_data['deskripsi'];
        $current_image = $blog_data['gambar']; // Ambil path gambar yang ada
    } else {
        $message = "Artikel tidak ditemukan.";
        $message_color = "red";
    }
    $stmt->close();
} else {
    $message = "ID artikel tidak disediakan.";
    $message_color = "red";
}

// Logika untuk mengedit blog saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul_baru = $_POST['judul'];
    $deskripsi_baru = $_POST['deskripsi'];
    $isi_baru = $_POST['isi'];
    $new_image_path = $current_image; // Secara default, gunakan gambar lama

    // Validasi input
    if (empty($judul_baru) || empty($isi_baru) || empty($deskripsi_baru)) {
        $message = "Judul, deskripsi, dan isi artikel tidak boleh kosong.";
        $message_color = "red";
    } else {
        // Cek apakah ada file gambar baru yang diunggah
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $target_dir = "../assets/";
            // Pastikan folder uploads sudah ada dan writable
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            $file_extension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $new_file_name = uniqid('blog_', true) . '.' . $file_extension;
            $target_file = $target_dir . $new_file_name;

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                $new_image_path = $target_file;
                $message = "Gambar berhasil diunggah.";
                $message_color = "green";
                // Hapus gambar lama jika ada, untuk menghindari file menumpuk
                if (!empty($current_image) && file_exists($current_image)) {
                    unlink($current_image);
                }
            } else {
                $message = "Gagal mengunggah gambar baru.";
                $message_color = "red";
                // Jangan lanjutkan proses update jika gagal upload
                // Gunakan die() atau exit()
                die();
            }
        }

        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("UPDATE blog SET judul = ?, isi = ?, gambar = ?, deskripsi = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $judul_baru, $isi_baru, $new_image_path, $deskripsi_baru, $id);

        if ($stmt->execute()) {
            $message = "Artikel berhasil diperbarui!";
            $message_color = "green";
            // Perbarui data yang ditampilkan di form
            $judul = $judul_baru;
            $isi = $isi_baru;
            $deskripsi = $deskripsi_baru;
            $current_image = $new_image_path;
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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Artikel — CMS Travel Umroh</title>
    
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <style>
        /* Menggunakan skema warna yang sama untuk konsistensi */
        :root{
            --bg: #0b1020;
            --panel: #111731;
            --panel-2: #0f1430;
            --text: #e8ecff;
            --muted: #a4b0d3;
            --brand: #7aa2ff;
            --brand-2:#3b82f6;
            --ok: #22c55e;
            --danger: #ef4444;
            --chip: #1e293b;
            --border: #223158;
            --shadow: 0 10px 30px rgba(0,0,0,.25);
            --radius: 16px;
        }

        /* Reset dan styling dasar */
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        /* Container utama */
        .container {
            width: 100%;
            max-width: 700px; /* Ukuran yang lebih proporsional */
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 3rem;
            box-shadow: var(--shadow);
            position: relative; /* Untuk positioning tombol kembali */
        }
        
        /* Tombol Kembali */
        .back-btn {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            text-decoration: none;
            color: var(--muted);
            font-size: 1rem;
            transition: color 0.2s ease;
        }
        .back-btn:hover {
            color: var(--brand);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--brand);
            margin-bottom: 2rem;
            text-align: center;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .label {
            font-weight: 500;
            color: var(--muted);
            font-size: 0.9rem;
        }

        /* Desain input yang lebih halus */
        .input, .input--textarea, .input--file {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.04);
            color: var(--text);
            transition: all 0.3s ease;
        }
        .input:focus, .input--textarea:focus, .input--file:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 2px rgba(122, 162, 255, 0.2);
            outline: none;
            background: rgba(255, 255, 255, 0.08);
        }

        .input--textarea {
            resize: vertical;
            min-height: 250px;
        }
        
        /* Style untuk Summernote */
        .note-editor {
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            background: rgba(255, 255, 255, 0.04) !important;
        }
        .note-toolbar.panel-default {
            background-color: var(--panel-2) !important;
            border-bottom: 1px solid var(--border) !important;
        }
        .note-editable {
            background-color: rgba(255, 255, 255, 0.04) !important;
            color: var(--text) !important;
            padding: 12px !important;
        }
        .note-placeholder {
            color: rgba(255, 255, 255, 0.3) !important;
        }
        .note-popover, .note-tooltip {
            background-color: var(--panel-2) !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
        }
        .note-popover .btn, .note-tooltip .btn {
            background-color: var(--panel-2) !important;
            color: var(--text) !important;
        }
        
        .image-preview {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            border: 1px solid var(--border);
        }

        /* Tombol yang lebih modern */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            cursor: pointer;
            background: linear-gradient(45deg, var(--brand), var(--brand-2));
            color: #fff;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(60, 130, 240, 0.2);
        }
        
        .message {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 1rem;
            font-weight: 500;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tambahkan tombol kembali -->
        <a href="../backend.php#blog" class="back-btn">&larr; Kembali ke Dashboard</a>
        <h2>Edit Artikel Blog</h2>
        <?php if (!empty($message)): ?>
            <p class="message" style="color: <?php echo $message_color; ?>; border-color: <?php echo $message_color; ?>;"><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (isset($judul) && isset($isi)): ?>
        <form class="form" action="editblog.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            
            <div class="form-group">
                <label for="judul" class="label">Judul Artikel</label>
                <input type="text" id="judul" name="judul" class="input" value="<?= htmlspecialchars($judul) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi" class="label">Meta Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" class="input" value="<?= htmlspecialchars($deskripsi) ?>" required>
            </div>

            <div class="form-group">
                <label for="isi" class="label">Isi Artikel</label>
                <textarea id="summernote" name="isi" class="input input--textarea" required><?= htmlspecialchars($isi) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="gambar" class="label">Gambar Saat Ini</label>
                <?php if (!empty($current_image) && file_exists($current_image)): ?>
                    <img src="<?= htmlspecialchars($current_image) ?>" alt="Gambar Blog" class="image-preview">
                <?php else: ?>
                    <p style="color:var(--muted)">Tidak ada gambar saat ini.</p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="gambar" class="label">Ganti Gambar (opsional)</label>
                <input type="file" id="gambar" name="gambar" class="input input--file">
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
        <?php endif; ?>
    </div>

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
