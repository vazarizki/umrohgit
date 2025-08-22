<?php
include "../config.php";

// Pastikan parameter 'id' ada di URL
if(!isset($_GET['id'])) {
    die("ID produk tidak ditemukan.");
}

$id = $_GET['id'];
$data = null;

// Ambil data produk dari database
$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    die("Produk tidak ditemukan.");
}

// Proses update data produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $isi = $_POST['isi'];
    $stmt_update = $conn->prepare("UPDATE produk SET judul = ?, harga = ?, deskripsi = ?, isi = ? WHERE id = ?");
    $stmt_update->bind_param("sissi", $judul, $harga, $deskripsi, $isi, $id);

    if ($stmt_update->execute()) {
        header("Location: ../backend.php");
        exit();
    } else {
        echo "Error: " . $stmt_update->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Produk</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --bg-color: #f7fafc;
            --card-bg: #ffffff;
            --text-color: #2d3748;
            --label-color: #4a5568;
            --border-color: #e2e8f0;
            --primary-color: #4c51bf;
            --primary-hover: #434190;
            --cancel-color: #a0aec0;
            --cancel-hover: #718096;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background-color: var(--card-bg);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--text-color);
        }

        form div {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--label-color);
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
            color: var(--text-color);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(76, 81, 191, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        button, .btn-link {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        .btn-link {
            background-color: var(--cancel-color);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-link:hover {
            background-color: var(--cancel-hover);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Produk</h1>

        <form method="POST">
            <div>
                <label for="judul">Judul Produk:</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>
            </div>
            <div>
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" required>
            </div>
            <div>
                <label for="deskripsi">Meta Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" value="<?= htmlspecialchars($data['deskripsi']) ?>" required>
            </div>
             <div>
                <label for="isi">Isi Produk</label>
                <input type="text" id="isi" name="isi" value="<?= htmlspecialchars($data['isi']) ?>" required>
            </div>
            <div class="actions">
                <button type="submit">Simpan Perubahan</button>
                <a href="../backend.php" class="btn-link">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>