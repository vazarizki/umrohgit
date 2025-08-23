<?php
include "config.php";

if (!isset($_GET['id'])) {
    die("Produk tidak ditemukan.");
}

$id = (int) $_GET['id'];
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
  <title><?= htmlspecialchars($p['judul']) ?> - Detail Produk</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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
  flex: 3;
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
  font-size: 15px;
  color: #4a4a4a;
  line-height: 1.6;
}

/* Bagian CTA */
.cta-form {
  flex: 1.5;
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
.btn{
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
    <p class="product-desc"><?= nl2br(htmlspecialchars($p['deskripsi'])) ?></p>

<!-- Tabs -->
<div class="tabs">
  <p class="d-inline-flex gap-1">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseFaq" role="button" aria-expanded="false" aria-controls="collapseExample">
    FaQ
    </a>

<div class="collapse" id="collapseFaq">
<div class="card card-body">
<ul>
    <li>
      <strong>Umum</strong>
      <ul>
        <li><strong>Q:</strong> Apa perbedaan Umroh dan Haji?<br>
            <strong>A:</strong> Haji wajib dilakukan pada bulan Dzulhijjah, sedangkan Umroh bisa dilakukan kapan saja sepanjang tahun.</li>
        <li><strong>Q:</strong> Apakah anak-anak boleh ikut?<br>
            <strong>A:</strong> Boleh, tapi ibadahnya belum wajib hingga dewasa.</li>
        <li><strong>Q:</strong> Apakah lansia bisa ikut?<br>
            <strong>A:</strong> Bisa, selama kondisi kesehatan memungkinkan.</li>
      </ul>
    </li>

    <li>
      <strong>Pendaftaran & Administrasi</strong>
      <ul>
        <li><strong>Q:</strong> Dokumen apa saja yang dibutuhkan?<br>
            <strong>A:</strong> Paspor (min. berlaku 7 bulan), KTP, KK, buku nikah (untuk pasangan), akta lahir (anak), pas foto.</li>
        <li><strong>Q:</strong> Apakah perlu visa?<br>
            <strong>A:</strong> Ya, visa resmi Arab Saudi diurus pihak travel.</li>
        <li><strong>Q:</strong> Kapan sebaiknya mendaftar?<br>
            <strong>A:</strong> Umroh minimal 1–2 bulan sebelum berangkat, Haji reguler bisa antre belasan tahun.</li>
      </ul>
    </li>

    <li>
      <strong>Biaya & Paket</strong>
      <ul>
        <li><strong>Q:</strong> Berapa biaya Umroh?<br>
            <strong>A:</strong> Kisaran mulai 25–40 juta rupiah, tergantung fasilitas & musim.</li>
        <li><strong>Q:</strong> Apa saja yang termasuk biaya?<br>
            <strong>A:</strong> Tiket pesawat, hotel, transportasi, visa, makan, bimbingan ibadah.</li>
        <li><strong>Q:</strong> Apakah ada biaya tambahan?<br>
            <strong>A:</strong> Ya, seperti pembuatan paspor, vaksin meningitis, perlengkapan Umroh, bagasi lebih.</li>
      </ul>
    </li>

    <li>
      <strong>Kesehatan & Persiapan</strong>
      <ul>
        <li><strong>Q:</strong> Apakah wajib vaksin?<br>
            <strong>A:</strong> Vaksin meningitis wajib, kadang ada tambahan sesuai aturan terbaru.</li>
        <li><strong>Q:</strong> Bagaimana menjaga kesehatan?<br>
            <strong>A:</strong> Minum cukup air, gunakan masker, bawa obat pribadi, jaga pola makan & istirahat.</li>
        <li><strong>Q:</strong> Apa perlengkapan yang harus dibawa?<br>
            <strong>A:</strong> Kain ihram, mukena, pakaian nyaman, sandal/sepatu ringan, obat pribadi, sajadah, Al-Qur’an.</li>
      </ul>
    </li>

    <li>
      <strong>Perjalanan & Fasilitas</strong>
      <ul>
        <li><strong>Q:</strong> Berapa lama Umroh?<br>
            <strong>A:</strong> Rata-rata 9–12 hari tergantung paket.</li>
        <li><strong>Q:</strong> Apakah ada pembimbing ibadah?<br>
            <strong>A:</strong> Ya, travel resmi selalu menyediakan pembimbing.</li>
        <li><strong>Q:</strong> Bagaimana akomodasi di Mekkah & Madinah?<br>
            <strong>A:</strong> Hotel sesuai paket (bintang 3–5), dengan jarak tertentu dari Masjidil Haram/Nabawi.</li>
      </ul>
    </li>

    <li>
      <strong>Lain-lain</strong>
      <ul>
        <li><strong>Q:</strong> Bagaimana memastikan travel terpercaya?<br>
            <strong>A:</strong> Pastikan travel berizin Kemenag, punya jadwal jelas & testimoni jamaah baik.</li>
        <li><strong>Q:</strong> Apa yang dilakukan jika tertinggal rombongan?<br>
            <strong>A:</strong> Tetap tenang, hubungi pembimbing/travel, dan menuju titik kumpul yang disepakati.</li>
      </ul>
    </li>
  </ul>
</div>
</div>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Itinerary
  </button>
  </p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
<ul>
    <li>
      <strong>Hari 1: Keberangkatan dari Indonesia</strong>
      <ul>
        <li>Berkumpul di bandara (Soekarno Hatta / sesuai kota keberangkatan).</li>
        <li>Briefing dari pembimbing dan tim travel.</li>
        <li>Proses check-in dan imigrasi.</li>
        <li>Penerbangan menuju Jeddah / Madinah (sesuai maskapai dan paket).</li>
      </ul>
    </li>

    <li>
      <strong>Hari 2: Tiba di Madinah</strong>
      <ul>
        <li>Tiba di Bandara Madinah.</li>
        <li>Proses imigrasi & pengambilan bagasi.</li>
        <li>Menuju hotel, check-in, istirahat.</li>
        <li>Shalat berjamaah di Masjid Nabawi.</li>
        <li>Ziarah ke Raudhah (sesuai jadwal).</li>
      </ul>
    </li>

    <li>
      <strong>Hari 3: Ibadah di Madinah</strong>
      <ul>
        <li>Shalat berjamaah di Masjid Nabawi.</li>
        <li>Ziarah sekitar Madinah:
          <ul>
            <li>Makam Baqi’</li>
            <li>Masjid Quba</li>
            <li>Masjid Qiblatain</li>
            <li>Jabal Uhud</li>
          </ul>
        </li>
        <li>Kembali ke hotel & persiapan ibadah.</li>
      </ul>
    </li>

    <li>
      <strong>Hari 4: Madinah → Makkah (Umroh Pertama)</strong>
      <ul>
        <li>Shalat Subuh di Masjid Nabawi.</li>
        <li>Berangkat menuju Makkah.</li>
        <li>Miqat di Dzulhulaifah (Bir Ali) untuk niat Umroh.</li>
        <li>Tiba di Makkah, check-in hotel.</li>
        <li>Pelaksanaan Umroh pertama (Tawaf, Sa’i, Tahallul).</li>
      </ul>
    </li>

    <li>
      <strong>Hari 5: Ibadah di Masjidil Haram</strong>
      <ul>
        <li>Shalat berjamaah di Masjidil Haram.</li>
        <li>Ibadah mandiri: Tawaf sunnah, tilawah, dzikir.</li>
        <li>Waktu bebas untuk memperbanyak ibadah.</li>
      </ul>
    </li>

    <li>
      <strong>Hari 6: Ziarah Kota Makkah</strong>
      <ul>
        <li>Ziarah:
          <ul>
            <li>Jabal Tsur</li>
            <li>Jabal Rahmah (Arafah)</li>
            <li>Muzdalifah & Mina</li>
            <li>Jabal Nur (Gua Hira – dilihat dari bawah)</li>
          </ul>
        </li>
        <li>Kembali ke hotel.</li>
        <li>Umroh sunnah (opsional, bersama pembimbing).</li>
      </ul>
    </li>

    <li>
      <strong>Hari 7: Ibadah di Masjidil Haram</strong>
      <ul>
        <li>Shalat berjamaah di Masjidil Haram.</li>
        <li>Perbanyak ibadah (Tawaf sunnah, doa, dzikir).</li>
        <li>Waktu bebas: tilawah, kajian, atau istirahat.</li>
      </ul>
    </li>

    <li>
      <strong>Hari 8: Tawaf Wada & Persiapan Pulang</strong>
      <ul>
        <li>Shalat Subuh di Masjidil Haram.</li>
        <li>Pelaksanaan Tawaf Wada (perpisahan).</li>
        <li>Packing, check-out hotel.</li>
        <li>Menuju Jeddah; city tour opsional (Corniche, Masjid Terapung, pusat oleh-oleh).</li>
        <li>Menuju bandara untuk kepulangan.</li>
      </ul>
    </li>

    <li>
      <strong>Hari 9: Tiba di Indonesia</strong>
      <ul>
        <li>Tiba di bandara tujuan Indonesia.</li>
        <li>Imigrasi, pengambilan bagasi.</li>
        <li>Program selesai.</li>
      </ul>
    </li>
  </ul>
</div>
</div>
</div>
  </div>

  <!-- Bagian Kanan: CTA Form -->
  <div class="cta-form">
    <h2>Tertarik?</h2>
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
