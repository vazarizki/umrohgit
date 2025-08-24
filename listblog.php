<?php
// koneksi database
include "config.php";

// ambil data artikel
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);
$articles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

$related = $conn->query("SELECT id, judul FROM blog ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Berita terbaru seputar umroh & haji">
  <link rel="shortcut icon" href="assets/TWS TP.png" type="image/x-icon">
  <title>Taman Wisata Surga - Blog</title>
  <link rel="stylesheet" href="style.css">
</head>

<style>
    /* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background: #141414;
  color: #fff;
  line-height: 1.6;
}
.hero{
    height:2%;
}

.hero img{
width: 100%;
height: 300px;
}

/* Layout */
.container {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 20px;
  padding: 20px;
}

/* Articles */
.articles {
  display: block;
  gap: 20px;
}

.card {
background: #f7f7f7;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.2s ease;
  display: flex;             /* biar sejajar kiri-kanan */
  align-items: flex-start;   /* gambar sejajar ke atas */
  padding: 10px;
  margin-top:10px;
}

.card:hover {
  transform: scale(1.01);
}

.card img {
  width: 80px;   /* kecilkan ukuran gambar */
  height: 80px;  /* biar kotak */
  object-fit: cover; /* gambar tetap proporsional */
  border-radius: 6px;
  margin-right: 15px;
}

.card-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.card-content .category {
  font-size: 0.85rem;
  color: #ff7f00;
  font-weight: bold;
  text-transform: uppercase;
}

.card-content h2 {
  margin: 10px 0;
  font-size: 1.2rem;
  color: #363636ff;
}

.card-content p {
  font-size: 0.85rem;
  color: #aaa;
}

/* Sidebar */
.sidebar {
  background: ;
  border-radius: 8px;
  padding: 15px;
}

.sidebar h3 {
  margin-bottom: 12px;
  color: #ff7f00;
}

.sidebar ul {
  list-style: none;
}

.sidebar li {
  margin-bottom: 8px;
}

.sidebar a {
  color: black;
  text-decoration: none;
  font-size: 0.9rem;
}

.sidebar a:hover {
  color: #ff7f00;
}

/* Responsive */
@media (max-width: 900px) {
  .container {
    grid-template-columns: 1fr;
  }
.card {
  background: #f7f7f7ff;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.2s ease;
  display: block;
}
.card-content span{
    display: none;
}
.card img {
  width: 100%;
  height: auto;
}
.articles h2{
    font-size:14px;
}
}

</style>

<body>

  <!-- Header -->
  <?php include "view/header.php"; ?>

  <div class="hero">
    <img src="assets/slider1.jpeg" alt="">
  </div>

  
  <!-- Main Content -->
  <main class="container">
    <!-- Articles -->
    <section class="articles">
      <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $row): ?>
          <article class="card">
            <article class="card">
  <a href="blog.php?id=<?= $row['id'] ?>" style="display:flex; text-decoration:none; color:inherit;">
    <img src="<?= $row['gambar'] ?>" alt="Gambar Artikel">
    <div class="card-content">
      <span class="category"><?= htmlspecialchars($row['deskripsi']) ?></span>
      <h2><?= htmlspecialchars($row['judul']) ?></h2>
    </div>
  </a>
</article>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Belum ada artikel.</p>
      <?php endif; ?>
    </section>

    <!-- Sidebar -->
    <aside class="sidebar">
      <h3>Recent posts</h3>
      <ul>
        <?php while($row = $related->fetch_assoc()): ?>
        <li>
           <img src="" alt="">
          <a href="blog.php?id=<?php echo $row['id']; ?>">
            <?php echo htmlspecialchars($row['judul']); ?>
        </li>
         <?php endwhile; ?>
      </ul>
    </aside>
  </main>

  <!-- Footer -->
<?php include "view/footer.php"; ?>

</body>
</html>
