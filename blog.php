<?php
include "config.php";

if (!isset($_GET['id'])) {
    die("Artikel tidak ditemukan");
}
$id = (int) $_GET['id'];
$blog = $conn->query("SELECT * FROM blog WHERE id=$id LIMIT 1");

if ($blog->num_rows == 0) {
    die("Artikel tidak ditemukan");
}

$p = $blog->fetch_assoc();

// Ambil artikel utama
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = $conn->prepare("SELECT * FROM blog WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$artikel = $result->fetch_assoc();

// Ambil 5 artikel lain sebagai "Recent posts"
$related = $conn->query("SELECT id, judul FROM blog WHERE id != $id ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="assets/TWS TP.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= $p['deskripsi'] ?>">
  <title><?= $p['judul'] ?></title>
  <link rel="stylesheet" href="style.css">
</head>

<style>
    /* Global Style */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  background: #fff;
  color: #333;
  line-height: 1.6;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: auto;
}
/* Main Layout */
.main-content {
  display: flex;
  gap: 30px;
  margin: 20px 0;
}

.article {
  flex: 3;
  padding: 30px;
}

.article h1 {
  font-size: 28px;
  margin-bottom: 10px;
}

.article .date {
  color: gray;
  font-size: 14px;
  margin-bottom: 15px;
}

.article h2 {
  margin-top: 20px;
  font-size: 22px;
}

.article-img {
  width: 100%;
  margin: 15px 0;
  border-radius: 6px;
}

/* Sidebar */
.sidebar {
  flex: 1;
  background: #f8f8f8;
  padding: 15px;
  border-radius: 6px;
}

.sidebar h3 {
  margin-bottom: 10px;
  font-size: 18px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  text-decoration: none;
  color: #002b5b;
}

.sidebar a:hover {
  text-decoration: underline;
}

/* Footer */
.footer {
  background: #002b5b;
  color: white;
  text-align: center;
  padding: 15px 0;
  margin-top: 30px;
}

/* Responsive */
@media (max-width: 768px) {
  .main-content {
    flex-direction: column;
  }

}

</style>

<body>

  <!-- Header -->
  <?php include "view/header.php"; ?>


  <!-- Main Content -->
  <main class="container main-content">
    <!-- Article -->
    <article class="article">
      <h1><?= $p['judul'] ?></h1>
      <p class="date">27.03.2025</p>
      <img src="assets/<?= htmlspecialchars($p['gambar']) ?>" alt="Malaysia Flag" class="article-img">

      <div>
        <p><?= $p['isi'] ?></p>
      </div>
    </article>

    <!-- Sidebar -->
    <aside class="sidebar">
      <h3>Recent posts</h3>
      <ul>
        <?php while($row = $related->fetch_assoc()): ?>
        <li>
            <img src="assets/<?= htmlspecialchars($p['gambar']) ?>" alt="">
          <a href="blog.php?id=<?php echo $row['id']; ?>">
            <?php echo htmlspecialchars($row['judul']); ?>
            
        </li>
          <?php endwhile; ?>
      </ul>
    </aside>
  </main>

  <!-- Footer -->
<?php include "view/footer.php" ?>

</body>
</html>
