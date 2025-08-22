<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Paket Travel Umroh & Haji</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    :root {
    --primary: #ff7f00;   /* Orange */
    --dark: #141414;      /* Hitam */
    --light: #ffffff;     /* Putih */
    --muted: #6b7280;     /* Abu */
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: var(--light);
    color: var(--dark);
}

header {
    text-align: center;
    padding: 2rem;
    background: var(--primary);
    color: var(--light);
}

header h1 {
    margin: 0;
    font-size: 2rem;
}

header p {
    margin-top: .5rem;
    font-size: 1rem;
}

.product-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.product-card {
    background: var(--light);
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 1rem;
    text-align: center;
    transition: 0.3s;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0,0,0,0.1);
}

.product-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

.product-card h3 {
    margin: 1rem 0 0.5rem;
    font-size: 1.1rem;
    color: var(--dark);
}

.product-card .harga {
    font-weight: bold;
    color: var(--primary);
    margin-bottom: 1rem;
}

.product-card button {
    background: var(--primary);
    border: none;
    color: var(--light);
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.product-card button:hover {
    background: #e46f00;
}

</style>

<body>

<?php include "view/header.php"; ?>

    <main class="product-list">
        <?php
        $query = "SELECT * FROM produk ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($p = mysqli_fetch_assoc($result)) {
                echo "
                <div class='product-card'>
                    <img src='{$p['gambar']}' alt='{$p['deskripsi']}'>
                    <h3>{$p['judul']}</h3>
                    <p class='harga'>{$p['harga']}</p>
                    <button>Detail Paket</button>
                </div>
                ";
            }
        } else {
            echo "<p>Tidak ada paket tersedia.</p>";
        }
        ?>
    </main>

</body>
</html>
