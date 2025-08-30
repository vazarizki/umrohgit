<?php
include "config.php";

if (!isset($_GET['id'])) {
    die("Produk tidak ditemukan.");
}

$id = $_GET['id'];
$id = base64_decode($id);
$sql = "SELECT * FROM produk WHERE id=$id LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Produk tidak ditemukan.");
}

$p = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/TWS TP.png" type="image/x-icon">
    <title><?= htmlspecialchars($p['judul']) ?> | Taman Wisata Surga</title>
    <meta name="description" content="<?= htmlspecialchars($p['isi']) ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<style>
/* Reset & base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: #ffffff;
  color: #1a1a1a;
  line-height: 1.5;
  font-size: 16px;
}

/* Container utama */
.container {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 24px;
  padding: 32px 5%;
  max-width: 1280px;
  margin: 0 auto;
}

/* Bagian Produk */
.product-detail {
  flex-grow: 1; /* Biarkan elemen ini tumbuh untuk mengambil sisa ruang */
  background: #ffffff;
  padding: 24px;
  border-radius: 12px;
  border: 1px solid #f0f0f0;
}

.product-img {
  width: 100%;
  max-height: auto;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 16px;
}

.product-title {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 12px;
  color: #1a1a1a;
  padding-left: 8px;
  border-left: 4px solid #ff6200;
}

.product-desc {
  font-size: 20px;
  color: #4a4a4a;
  line-height: 1.6;

}
.harga {
  font-size:20px;
}
.harga strong{
  color: #ff6200;
}

/* Bagian CTA */
.cta-form {
  flex-shrink: 0; /* Hindari elemen ini menyusut */
  width: 400px; /* Atur lebar tetap */
  position: sticky;
  top: 24px;
  background: #ffffff;
  border: 1px solid #f5f5f5;
  padding: 24px;
  border-radius: 12px;
}

.cta-form h2 {
  font-size: 20px;
  font-weight: 600;
  color: #ff6200;
  margin-bottom: 8px;
}

.cta-form p {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 16px;
}

.cta-form input,
.cta-form textarea {
  width: 100%;
  padding: 10px 12px;
  margin-bottom: 12px;
  border: 1px solid #e5e7eb;
  border-radius: 6px;
  font-size: 14px;
  background: #fafafa;
  transition: border-color 0.2s ease;
}

.cta-form input:focus,
.cta-form textarea:focus {
  border-color: #ff6200;
  outline: none;
}

.cta-form button {
  background: #ff6200;
  color: #ffffff;
  border: none;
  padding: 12px;
  width: 100%;
  font-size: 15px;
  font-weight: 500;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.cta-form button:hover {
  background: #e55b00;
}

/* Animasi */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}

.cta-form {
  animation: fadeIn 0.5s ease-in-out;
}

/*tabs */
.btn {
    border-radius:0px !important;
}

/* Responsive */
@media (max-width: 1024px) {
  .container {
    padding: 24px 4%;
    gap: 20px;
  }

  .product-detail {
    padding: 20px;
  }

  .cta-form {
    padding: 20px;
  }
}

@media (max-width: 768px) {
  .container {
    flex-direction: column;
    padding: 16px 3%;
  }

  .product-detail {
    order: 1;
    width: 100%;
    border: none;
    padding: 16px;
  }

  .cta-form {
    order: 2;
    position: relative;
    top: 0;
    width: 100%;
    margin-top: 16px;
    border: none;
    padding: 16px;
  }

  .product-title {
    font-size: 22px;
  }

  .product-img {
    max-height: auto;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 12px 2%;
  }

  .product-title {
    font-size: 20px;
    padding-left: 6px;
    border-left: 3px solid #ff6200;
  }

  .product-desc {
    font-size: 14px;
  }

  .cta-form h2 {
    font-size: 18px;
  }

  .cta-form p {
    font-size: 13px;
  }

  .cta-form input,
  .cta-form textarea {
    padding: 8px 10px;
    font-size: 13px;
  }

  .cta-form button {
    padding: 10px;
    font-size: 14px;
  }
}
</style>


<body>

<?php include "view/header.php"; ?>

<div class="container">
  <!-- Bagian Kiri: Konten Produk -->
  <div class="product-detail">


 <img src="assets/<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['gambar']) ?>" class="product-img">
  
   <h1 class="product-title"><?= htmlspecialchars($p['judul']) ?></h1>
    <h2 class="product-desc"><?= nl2br(htmlspecialchars($p['isi'])) ?></h2>
    <p class="harga">Mulai dari: <strong> Rp. <?= nl2br(htmlspecialchars($p['harga'])) ?> </strong></p>

<!-- Tabs -->
<div class="tabs">
  <p class="d-inline-flex gap-1">
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq" aria-expanded="false" aria-controls="collapseFaq">
    Detail Produk
    </button>
  
<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Itinerary
  </button>
  </p>
<div class="collapse" id="collapseFaq">
<div class="card card-body">
<ul>
    <li>
      <strong>Detail produk terkait</strong>
      <ul>
        <li> <div class="product-desc"><?= html_entity_decode($p['deskripsi']) ?></div></li>
    </li>
</ul>
</div>
</div>

<div class="collapse" id="collapseExample">
  <div class="card card-body">
<ul>
    <li>
      <strong>Jadwal lengkap kegiatan dan keberangkatan</strong>
      <ul>
        <li><div class="product-desc"><?= html_entity_decode($p['itinerary']) ?></div></li>
      </ul>
    </li>
  </ul>
</div>
</div>
</div>
  </div>

  <!-- Bagian Kanan: CTA Form -->
  <div class="cta-form">
    <h2>Tertarik dengan program <strong> <?= htmlspecialchars($p['judul']) ?></strong></h2>
    <p>Hubungi kami untuk info lebih lanjut.</p>
    <form  method="POST" id="ctaForm">
      <input type="hidden" name="product" value="<?= htmlspecialchars($p['judul']) ?>">
      <input type="text" name="nama" placeholder="Nama Anda" required>
      <input type="text" name="nomor" placeholder="Nomor Handphone" required>
      <input type="email" name="email" placeholder="Email" required>
      <textarea name="pesan" rows="4" placeholder="Pesan..." required></textarea>
      <button type="submit">Kirim Pesan</button>
    </form>
  </div>
</div>

<div class="cta-form">
  

</div>


<script>
document.getElementById("ctaForm").addEventListener("submit", function(e) {
    e.preventDefault(); // cegah submit biasa

    const product = this.product.value;
    const nama    = this.nama.value;
    const nomor   = this.nomor.value;
    const email   = this.email.value;
    const pesan   = this.pesan.value;

    // nomor WA tujuan (format internasional TANPA +, TANPA spasi)
    const nomorWA = "6282249737228"; // contoh: +62 812-3456-789 → jadi 628123456789

    // encode pesan biar aman (tanda spasi, enter, dll)
    const text = encodeURIComponent(
        `Assalamualaikum warohmatullahi wabarokatuh, saya tertarik dengan, Paket  ${product}\n` +
        `Nama: ${nama}\n` +
        `Nomor: ${nomor}\n` +
        `Email: ${email}\n` +
        `Pesan: ${pesan}`
    );

    // redirect ke WA
    const url = `https://wa.me/${nomorWA}?text=${text}`;
    window.open(url, "_blank");
});
</script>

<?php include "view/footer.php"; ?>
</body>
</html>