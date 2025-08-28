<?php
// produk.php

// Pastikan file config.php sudah tersedia
include "config.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Pilihan paket terbaik untuk perjalanan ibadah Anda.">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Paket Tour & Travel Tebaik — Taman Wisata Surga</title>
    <link rel="shortcut icon" href="assets/TWS TP.png" type="image/x-icon">
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
        }

        /* Header */
        .header {
            text-align: center;
            padding: 2rem;
            background: var(--primary);
            color: var(--light);
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .header p {
            margin-top: .5rem;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Container utama untuk daftar produk */
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Kartu produk */
        .product-card {
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: block; /* Agar seluruh kartu bisa diklik */
            text-decoration: none; /* Menghilangkan garis bawah pada link */
            color: var(--dark);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .product-card-body {
            padding: 1.5rem;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .product-card h3 {
            margin: 1rem 0 0.5rem;
            font-size: 1.2rem;
            color: var(--dark);
            font-weight: 600;
        }

        .product-card .harga {
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .product-card-button {
            background: var(--primary);
            border: none;
            color: var(--light);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .product-card-button:hover {
            background: #e46f00;
        }

        .no-products {
            grid-column: 1 / -1;
            text-align: center;
            color: var(--muted);
            font-style: italic;
            padding: 2rem;
        }
    </style>
</head>
<body>

<?php include "view/header.php" ?>

    <header class="header">
        <h1>Daftar Paket Travel Wisata</h1>
        <p>Pilihan paket terbaik untuk perjalanan ibadah Anda.</p>
    </header>

    <main class="product-list">
        <?php
        $query = "SELECT * FROM produk ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($p = mysqli_fetch_assoc($result)) {
                // Pastikan jalur gambar dimulai dari direktori yang benar
                $image_path = htmlspecialchars($p['gambar']);
                $product_id = base64_encode($p['id']);
                echo "
                <a href='detailproduct?id=".$product_id."' class='product-card'>
                    <img src='assets/{$image_path}' alt='Gambar {$p['judul']}'>
                    <div class='product-card-body'>
                        <h3>{$p['judul']}</h3>
                        <p class='harga'>Rp. {$p['harga']} Juta</p>
                        <span class='product-card-button'>Detail Paket</span>
                    </div>
                </a>
                ";
            }
        } else {
            echo "<p class='no-products'>Tidak ada paket yang tersedia saat ini.</p>";
        }
        ?>
    </main>

</body>
</html>
