<?php
// Pastikan file config.php sudah tersedia
include "config.php";

// Set koneksi database

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sitemap - Taman Wisata Surga</title>
    <style>
        /* Menggunakan skema warna yang konsisten */
        :root {
            --primary: #ff7f00;   /* Orange */
            --dark: #141414;      /* Hitam */
            --light: #ffffff;     /* Putih */
            --muted: #6b7280;     /* Abu */
            --border: #e5e7eb;    /* Border abu-abu terang */
            --shadow: 0 4px 6px rgba(0,0,0,0.05);
            --radius: 10px;
        }

        /* Reset dan styling dasar */
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        /* Header */
        .hero {
            text-align: center;
            padding: 2rem;
            background: var(--primary);
            color: var(--light);
            margin-bottom: 2rem;
        }

        .hero h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .hero p {
            margin-top: .5rem;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Sitemap list */
        .sitemap-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sitemap-list li {
            background: #f9f9f9;
            border-left: 4px solid var(--primary);
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .sitemap-list a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .sitemap-list a:hover {
            color: var(--primary);
        }

        .sitemap-list ul {
            list-style: none;
            padding-left: 2rem;
            margin-top: 0.5rem;
        }
        
        .sitemap-list ul li {
            background: none;
            border: none;
            padding: 0.5rem 0;
            margin: 0;
            box-shadow: none;
        }

        .no-products {
            color: var(--muted);
            font-style: italic;
        }

    </style>
</head>
<body>

<?php include "view/header.php" ?>

    <header class="hero">
        <h1>Sitemap Website</h1>
        <p>Struktur halaman dan tautan untuk navigasi.</p>
    </header>

    <div class="container">
        <ul class="sitemap-list">
            <li>
                <a href="index.php">Halaman Utama</a>
            </li>
            <li>
                <a href="listproduk.php">Halaman Daftar Produk</a>
                <?php
                // Ambil daftar produk dari database
                $query = "SELECT id, judul FROM produk ORDER BY id DESC";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo "<ul>";
                    while ($p = mysqli_fetch_assoc($result)) {
                        echo "<li><a href='detailproduct.php?id={$p['id']}'>Detail Produk: " . htmlspecialchars($p['judul']) . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='no-products'>Tidak ada produk yang ditemukan.</p>";
                }
                ?>
            </li>
            <li>
                <a href="listblog.php">Halaman Blog</a>
            </li>
        </ul>
    </div>
    
<?php include "view/footer.php" ?>

</body>
</html>
