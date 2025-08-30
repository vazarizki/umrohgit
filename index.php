<?php
include "config.php";

//ambil blog
$blog = $conn->query("SELECT * FROM blog");

if(!$blog){
    die("Error query blog: " . $conn->error);
}

$produk = $conn->query("SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" type="image/png" href="assets/TWS TP.png">
<title>Taman Wisata Surga | Travel Haji & Umroh Terpercaya</title>
<meta name="description" content="Travel Haji & Umroh modern: paket lengkap, artikel, testimoni, dan kontak.">
<link rel="preconnect" href="https://images.unsplash.com">
</head>

<style>
 
 :root {
   --primary: #ff7f00; /* orange */
   --dark: #141414; /* hitam */
   --text: #2b2b2b;
   --muted: #6b7280;
   --bg: #ffffff; /* putih dominan */
   --soft: #f6f7f9;
   --radius: 18px;
   --shadow: 0 10px 30px rgba(0, 0, 0, .06);
 }

 * {
   box-sizing: border-box;
 }

 html,
 body {
   margin: 0;
   padding: 0;
 }

 body {
   font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
   color: var(--text);
   background: var(--bg);
   line-height: 1.6;
 }

 a {
   color: var(--dark);
   text-decoration: none;
 }

 img {
   max-width: 100%;
   display: block;
 }

 .container {
   width: min(1200px, 100% - 2rem);
   margin-inline: auto;
 }

 .muted {
   color: var(--muted);
 }

 .btn {
   display: inline-flex;
   align-items: center;
   justify-content: center;
   gap: .5rem;
   padding: .75rem 1rem;
   border-radius: 999px;
   font-weight: 700;
   color: #fff;
   background: var(--primary);
   border: none;
   cursor: pointer;
   box-shadow: 0 8px 22px rgba(255, 127, 0, .25);
   transition: .18s transform, .18s box-shadow, .18s background;
 }

 .btn:hover {
   transform: translateY(-1px);
   box-shadow: 0 10px 26px rgba(255, 127, 0, .33);
   background: #f17300;
 }

 .btn.outline {
   background: #fff;
   color: var(--dark);
   border: 1px solid #ececec;
   box-shadow: none;
 }

 .btn.outline:hover {
   background: var(--soft);
 }

 .chip {
   background: #fff;
   border: 1px solid #ececec;
   padding: .5rem .9rem;
   border-radius: 999px;
   font-weight: 600;
   cursor: pointer;
 }

 .chip.active {
   background: var(--primary);
   border-color: var(--primary);
   color: #fff;
 }

 section {
   padding: 3.2rem 0;
 }

 .section-head {
   display: flex;
   align-items: end;
   justify-content: space-between;
   gap: 1rem;
   margin-bottom: 1.2rem;
 }

 .section-head h2 {
   margin: 0;
   font-size: clamp(1.2rem, 2.4vw, 1.6rem);
   color: var(--dark);
 }

 /* ===== Header / Navbar ===== */
 header {
   position: sticky;
   top: 0;
   z-index: 1000;
   background: rgba(255, 255, 255, .92);
   border-bottom: 1px solid #eee;
   backdrop-filter: saturate(180%) blur(8px);
   transition: box-shadow .25s ease, border-color .25s ease;
 }

 header.scrolled {
   box-shadow: var(--shadow);
   border-color: transparent;
 }

 .nav {
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap: 1rem;
   padding: .8rem 0;
 }

 .brand {
   display: flex;
   align-items: center;
   gap: .7rem;
 }

 .brand img {
   width: 50px;
   height: auto;
   object-fit: cover;
 }

 .brand b {
   color: var(--dark);
   font-style: italic;
 }

 .menu {
   display: flex;
   align-items: center;
   gap: 1rem;
 }

 .menu a {
   font-weight: 600;
   padding: .55rem .8rem;
   border-radius: 999px;
 }

 .menu a:hover {
   background: var(--soft);
 }

 .hamburger {
   display: none;
   width: 44px;
   height: 44px;
   border-radius: 12px;
   border: 1px solid #ececec;
   background: #fff;
   align-items: center;
   justify-content: center;
   cursor: pointer;
 }

 .hamburger span,
 .hamburger::before,
 .hamburger::after {
   content: "";
   display: block;
   width: 22px;
   height: 2px;
   background: var(--dark);
   transition: transform .25s, opacity .25s;
 }

 .hamburger::before {
   transform: translateY(-6px);
 }

 .hamburger::after {
   transform: translateY(6px);
 }

 .hamburger.active span {
   opacity: 0;
 }

 .hamburger.active::before {
   transform: translateY(0) rotate(45deg);
 }

 .hamburger.active::after {
   transform: translateY(0) rotate(-45deg);
 }

 /* Drawer */
 .drawer {
   position: fixed;
   inset: 0 0 auto auto;
   width: 100%;
   height: 0;
   overflow: hidden;
   background: #fff;
   border-bottom: 1px solid #eee;
   box-shadow: var(--shadow);
   transition: height .28s;
 }

 .drawer.open {
   height: auto;
   margin-top: 20%;
   z-index: 2000;
 }

 .drawer .menu-col {
   display: grid;
   gap: .5rem;
   padding: 1rem;
 }

 .drawer a {
   background: var(--bg);
   border-radius: 14px;
 }

 @media (max-width: 980px) {
   .menu {
     display: none;
   }

   .hamburger {
     display: inline-flex;
   }
 }

 /* ===== Hero Slider ===== */
 .hero {
   position: relative;
   padding: 0;
   background-color: #fbf8f8;
 }

 .hero .track {
   position: relative;
   overflow: hidden;
   border-radius: 0 0 26px 26px;
   background: #fbf8f8;
 }

 .hero .slides {
   display: flex;
   transition: transform .6s ease;
 }

 .hero .slide {
   min-width: 100%;
   display: grid;
   grid-template-columns: 1.1fr .9fr;
   gap: 1.2rem;
   align-items: center;
 }

 .hero .text {
   padding: 30px;
 }

 .kicker {
   display: inline-block;
   background: #fff;
   color: var(--dark);
   font-weight: 800;
   border-radius: 999px;
   padding: .35rem .8rem;
   margin-bottom: .8rem;
   border: 1px solid #eee;
 }

 .hero h1 {
   margin: .2rem 0;
   font-size: clamp(1.6rem, 3.2vw, 2.4rem);
   line-height: 1.2;
   color: var(--dark);
 }

 .hero p {
   margin: .6rem 0 1rem;
   color: #333;
 }

 .hero .img-wrap {
   position: relative;
   padding: 30px;
 }

 .hero .img {
   border-radius: 26px;
   overflow: hidden;
   border: 1px solid #eee;
   box-shadow: var(--shadow);
 }

 .hero .img img {
   max-width: 100%;
   height: auto;
   object-fit: cover;
 
 }

 .hero .dots {
   display: flex;
   gap: .45rem;
   justify-content: center;
   margin: 10px;
 }

 .hero .dot {
   width: 8px;
   height: 8px;
   border-radius: 999px;
   background: #ddd;
   cursor: pointer;
 }

 .hero .dot.active {
   background: var(--primary);
 }

 @media (max-width: 900px) {
   .hero .slide {
     grid-template-columns: 1fr;
   }

   .hero .img img {
     display: none;
   }

   section .hero {
     padding: 0;
   }

   .hero .img-wrap {
     padding: 0px;
   }
 }

 /* ===== Trend / Carousel cards ===== */
 .hscroll {
   display: flex;
   gap: 1rem;
   overflow: auto;
   padding-bottom: .4rem;
   scroll-snap-type: x mandatory;
 }

 .hscroll::-webkit-scrollbar {
   height: 8px;
 }

 .hscroll::-webkit-scrollbar-thumb {
   background: #e6e6e6;
   border-radius: 999px;
 }

 .trend-card {
   scroll-snap-align: start;
   flex: 0 0 280px;
   background: #fff;
   border: 1px solid #eee;
   border-radius: 16px;
   overflow: hidden;
   box-shadow: var(--shadow);
   transition: transform .2s;
 }

 .trend-card:hover {
   transform: translateY(-4px);
 }

 .trend-card .thumb img {
   height: 200px;
   object-fit: cover;
   width: 100%;
 }

 .trend-card .body {
   padding: .9rem;
 }

 .trend-card .title h2{
   font-weight:500;
   font-size:20px;
   color: var(--dark);
 }

 .trend-card .small {
   font-size: .86rem;
   color: var(--muted);
 }

 /* ===== Icon Feature row ===== */
 .feature-row {
   display: grid;
   grid-template-columns: repeat(4, 1fr);
   gap: 1rem;
 }

 .feature {
   background: #fff;
   border: 1px solid #eee;
   border-radius: 16px;
   box-shadow: var(--shadow);
   padding: 1rem;
   display: flex;
   align-items: center;
   gap: .8rem;
 }

 .feature img {
   width: 44px;
   height: 44px;
   border-radius: 12px;
   object-fit: cover;
 }

 @media (max-width: 900px) {
   .feature-row {
     grid-template-columns: repeat(2, 1fr);
   }
 }

 @media (max-width: 520px) {
   .feature-row {
     grid-template-columns: 1fr;
   }
 }

   /* ===== paket filter ===== */
@media (max-width: 520px){
   .filterPaket{
    display: flex;
    gap:.5rem;
    flex-wrap:nowrap;
   }
   #paket .section-head{
    display: block;
   }
    .section-head h2 {
      font-size: 16px;
      padding-bottom: 10px;
    }
}
 /* ===== Product slider-like cards ===== */
 .grid {
   display: grid;
   gap: 1rem;
   grid-template-columns: repeat(4, 1fr);
 }

 @media (max-width: 1100px) {
   .grid {
     grid-template-columns: repeat(3, 1fr);
   }
 }

 @media (max-width: 780px) {
   .grid {
     grid-template-columns: repeat(2, 1fr);
   }
 }

 @media (max-width: 520px) {
   .grid {
     grid-template-columns: 1fr;
   }
 }

 .card {
   background: #fff;
   border: 1px solid #eee;
   border-radius: 18px;
   overflow: hidden;
   box-shadow: var(--shadow);
   display: flex;
   flex-direction: column;
   transition: transform .2s;
 }

 .card:hover {
   transform: translateY(-4px);
 }

 .thumb {
   position: relative;
   aspect-ratio: 4/3;
 }

 .thumb img {
   width: 100%;
   height: 100%;
   object-fit: cover;
   transition: transform .4s ease;
 }

 .card:hover .thumb img {
   transform: scale(1.06);
 }

 .tag {
   position: absolute;
   left: 10px;
   top: 10px;
   background: #000a;
   color: #fff;
   padding: .35rem .6rem;
   border-radius: 999px;
   font-size: .75rem;
   backdrop-filter: blur(4px);
 }

 .body {
   padding: 1rem;
   display: grid;
   gap: .45rem;
 }

 .title {
   font-weight: 800;
   color: var(--dark);
 }

 .meta {
   display: flex;
   gap: .6rem;
   align-items: center;
   color: var(--muted);
   font-size: .9rem;
   flex-wrap: wrap;
   white-space: nowrap;
   overflow: hidden;
   text-overflow: ellipsis;
 }
 .price {
   font-weight: 900;
   color: var(--primary);
   font-size: 1.05rem;
 }

 .cta-row {
   display: flex;
   gap: .5rem;
   margin-top: .6rem;
 }

 /* ===== Promo banner (app) ===== */
 .banner {
   background: linear-gradient(135deg, #fff 0%, #fff 45%, #fff1e6 100%);
   border: 1px solid #eee;
   border-radius: 24px;
   box-shadow: var(--shadow);
   padding: 1.2rem;
   display: grid;
   grid-template-columns: 1fr .9fr;
   gap: 1rem;
   align-items: center;
 }

 .banner .phone {
   justify-self: end;
 }

 .phone img {
   max-width: 320px;
   border-radius: 24px;
   border: 1px solid #eee;
   box-shadow: 0 14px 40px rgba(0, 0, 0, .08);
 }

 @media (max-width: 900px) {
   .banner {
     grid-template-columns: 1fr;
   }

   .phone {
     justify-self: center;
   }
 }

 /* ===== Entertainment style cards ===== */
 .promo-grid {
   display: grid;
   gap: 1rem;
   grid-template-columns: 1.2fr .8fr;
 }

 .promo-grid .stack {
   display: grid;
   gap: 1rem;
 }

 .promo {
   position: relative;
   border-radius: 18px;
   overflow: hidden;
   border: 1px solid #eee;
   box-shadow: var(--shadow);
   background: #fff;
 }

 .promo img {
   width: 100%;
   height: 100%;
   object-fit: cover;
   aspect-ratio: 16/10;
 }

 .promo .overlay {
   position: absolute;
   inset: 0;
   background: linear-gradient(0deg, rgba(0, 0, 0, .45), transparent 60%);
   color: #fff;
   display: flex;
   align-items: end;
   padding: 1rem;
 }

 @media (max-width: 900px) {
   .promo-grid {
     grid-template-columns: 1fr;
   }
 }

 /* ===== Articles ===== */
 .articles {
   display: grid;
   gap: 1rem;
   grid-template-columns: repeat(3, 1fr);
 }

 .post {
   border: 1px solid #eee;
   border-radius: 16px;
   overflow: hidden;
   box-shadow: var(--shadow);
   background: #fff;
 }

 .post .thumb img {
   aspect-ratio: 16/9;
 }

 .post .body {
   padding: 1rem;
 }

 @media (max-width: 900px) {
   .articles {
     grid-template-columns: repeat(2, 1fr);
   }
 }

 @media (max-width: 560px) {
   .articles {
     grid-template-columns: 1fr;
   }
 }

 /* ===== Footer ===== */
 footer {
   margin-top: 2rem;
   background: #0f0f0f;
   color: #eaeaea;
 }

 .foot {
   display: grid;
   gap: 1.2rem;
   grid-template-columns: 2fr 1fr 1fr 1fr;
   padding: 2rem 0;
 }

 .foot h4 {
   margin: .2rem 0 .6rem;
   font-size: 1rem;
   color: #fff;
 }

 .foot a {
   color: #d7d7d7;
 }

 .foot a:hover {
   color: #fff;
 }

 .copyright {
   border-top: 1px solid #222;
   padding: 1rem 0;
   color: #bbb;
   font-size: .9rem;
 }

 @media (max-width: 900px) {
   .foot {
     grid-template-columns: 1fr 1fr;
   }
 }

 @media (max-width: 560px) {
   .foot {
     grid-template-columns: 1fr;
   }
 }

 /* ===== Reveal on scroll ===== */
 .reveal {
   opacity: 0;
   transform: translateY(18px);
   transition: opacity .6s ease, transform .6s ease;
 }

 .reveal.show {
   opacity: 1;
   transform: none;
 }

</style>

<body>


<!-- Drawer -->
<div class="drawer" id="drawer">
 <div class="container">
   <div class="menu-col">
    <a href="listproduk">Paket</a>
    <a href="/#trend">Promo</a>
    <a href="./listblog">Artikel</a>
    <a href="tentangkami">Tentang Kami</a>
    <a href="#kontak">Kontak</a>
   </div>
 </div>
</div>

<!-- Header -->
<header id="header">
 <div class="container nav">
   <div class="brand">
     <img src="assets/TWS TP.png" alt="Logo">
     <b>Jalanmu Menuju Baitullah</b>
   </div>
   <nav class="menu">
     <a href="listproduk">Paket</a>
     <a href="/#trend">Promo</a>
     <a href="./listblog.php">Artikel</a>
     <a href="tentangkami.php">Tentang Kami</a>
     <a href="#kontak">Kontak</a>
     <button class="btn" onclick="scrollToEl('#paket')">✈️ Cek Paket</button>
   </nav>
   <button class="hamburger" id="hamburger" aria-label="Menu"><span></span></button>
 </div>
</header>


<!-- Hero Slider -->
<section class="hero">
 <div class="track container">
   <div class="slides" id="heroSlides">
     <!-- Slide 1 -->
     <div class="slide">
       <div class="text">
         <span class="kicker">Resmi & Terpercaya</span>
         <h1>Wujudkan Umroh Impian <span style="color:var(--primary)">• Mulai dari 25 Juta </span>  Fasilitas Nyaman, Pembimbing Berpengalaman</h1>
         <p class="muted">Penerbangan langsung, hotel dekat Masjidil Haram & Nabawi.</p>
         <div style="display:flex;gap:.6rem;flex-wrap:wrap">
           <button class="btn" onclick="scrollToEl('#paket')">Lihat Paket</button>
           <a class="btn outline" href="https://wa.link/1cz4on">Konsultasi Gratis</a>
         </div>
       </div>
       <div class="img-wrap">
         <div class="img">
           <img src="assets/slider1.jpeg" alt="Hero 1">
         </div>
       </div>
     </div>
     <!-- Slide 2 -->
     <div class="slide">
       <div class="text">
         <span class="kicker">Paket Populer</span>
         <h1>Umroh Plus Turki <span style="color:var(--primary)">12 Hari</span></h1>
         <p class="muted">City tour Istanbul & Bursa, kuliner halal, itinerary efisien.</p>
         <div style="display:flex;gap:.6rem;flex-wrap:wrap">
           <button class="btn" onclick="scrollToEl('#paket')">Ambil Promo</button>
           <a class="btn outline" href="#artikel">Lihat Itinerary</a>
         </div>
       </div>
       <div class="img-wrap">
         <div class="img">
           <img src="assets/slider2.jpeg" alt="Hero 2">
         </div>
       </div>
     </div>
     <!-- Slide 3 -->
     <div class="slide">
       <div class="text">
         <span class="kicker">Kemudahan</span>
         <h1>Booking Online & Manasik <span style="color:var(--primary)">Hybrid</span></h1>
         <p class="muted">Pendaftaran mudah, pembayaran aman, pendampingan ibadah sampai tuntas.</p>
         <div style="display:flex;gap:.6rem;flex-wrap:wrap">
           <button class="btn" onclick="scrollToEl('#bannerApp')">Download Brosur</button>
           <a class="btn outline" href="https://wa.link/1cz4on">Hubungi Admin</a>
         </div>
       </div>
       <div class="img-wrap">
         <div class="img">
           <img src="assets/slider3.jpeg" alt="Hero 3">
         </div>
       </div>
     </div>
   </div>
   <div class="dots" id="heroDots"></div>
 </div>
</section>

<!-- Trend Cards (carousel horizontal) -->
<section class="container reveal" id="trend">
 <div class="section-head">
   <h2>Info & Promo Terbaru</h2>
   <a class="muted" href="#">Lihat semua</a>
 </div>
 <div class="hscroll" id="trendScroll">
   <!-- 6+ dummy cards -->
   <?php while($p = $blog->fetch_assoc()): ?>
   <article class="trend-card">
     <div class="thumb"><img src="assets/<?= $p['gambar'] ?>" alt=""></div>
     <div class="body">
       <div class="title">
         <h2><a href="blog.php?id=<?= $p['id'] ?>"><?= $p['judul'] ?></a></h2>
       </div>
       <p class="small"><?= $p['deskripsi'] ?></p>
     </div>
   </article>
   <?php endwhile; ?>
 </div>
</section>

<!-- Feature Icons -->
<section id="fitur" class="container reveal">
 <div class="section-head">
   <h2>Layanan yang disediakan Taman Wisata Surga</h2>
   <span class="muted">Semua kebutuhan perjalanan ibadah dalam satu tempat</span>
 </div>
 <div class="feature-row">
   <div class="feature"><img src="https://media.istockphoto.com/id/482206266/photo/kaaba-in-mecca.jpg?s=612x612&w=0&k=20&c=wwzNu3XMQpCRVdAcBbeerUGaew0Fk2nGPQkH98Wj474=" alt=""><div><b>Beli Paket</b><div class="muted small">Pilih jadwal & maskapai</div></div></div>
   <div class="feature"><img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=1200&auto=format&fit=crop" alt=""><div><b>Manasik</b><div class="muted small">Online & tatap muka</div></div></div>
   <div class="feature"><img src="https://th.bing.com/th/id/OIP.6hU3r4FUC6QxLYQnoAP_FwHaEw?w=256&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt=""><div><b>Pembayaran Aman</b><div class="muted small">Rekening resmi</div></div></div>
   <div class="feature"><img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=1200&auto=format&fit=crop" alt=""><div><b>Poin Jamaah</b><div class="muted small">Kumpulkan & tukar</div></div></div>
 </div>
</section>

<!-- Product Cards -->
<section id="paket" class="container reveal show">
 <div class="section-head">
   <h2>Satu produk, beragam pilihan paket</h2>
   <div class="filterPaket" id="filters">
     <button class="chip active" data-filter="all">Semua</button>
     <button class="chip" data-filter="hemat">Hemat</button>
     <button class="chip" data-filter="reguler">Reguler</button>
   </div>
 </div>

 <div class="grid" id="productGrid">
   <!-- 6 dummy products -->

   <?php while($p = $produk->fetch_assoc()): ?>
   <article class="card" data-cat="hemat">
       <div class="thumb">
           <span class="tag">9 Hari</span>
           <!-- Perbaikan ada di sini: menambahkan 'assets/' -->
           <img src="assets/<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['judul']) ?>">
       </div>
       <div class="body">
           <div class="title"><?= htmlspecialchars($p['judul']) ?></div>
           <div class="meta">
               <!-- Perubahan di sini: menghapus htmlspecialchars untuk menampilkan konten HTML dari Summernote -->
              <!-- <span><?= $p['isi'] ?></span> -->
           </div>
           <div class="price">Rp <?= htmlspecialchars($p['harga']) ?> </div>
           <div class="cta-row">
               <button class="btn" >Pesan</button>
               <?php
                  $product_id = base64_encode($p['id']);
               ?>
               <a class="btn outline" href="detailproduct.php?id=<?= htmlspecialchars($product_id) ?>">Detail</a>
           </div>
       </div>
   </article>
<?php endwhile; ?>
</div>
</section>

<!-- Banner App 
<section id="bannerApp" class="container reveal">
 <div class="banner">
   <div>
     <h2>akses lebih mudah dengan aplikasi Barokah Travel</h2>
     <p class="muted">Pantau jadwal, pembayaran, & informasi keberangkatan dalam satu genggaman.</p>
     <div style="display:flex;gap:.6rem;flex-wrap:wrap">
       <a class="btn" href="#">Unduh di App Store</a>
       <a class="btn outline" href="#">Dapatkan di Google Play</a>
     </div>
   </div>
   <div class="phone"><img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800&auto=format&fit=crop" alt="App Mockup"></div>
 </div>
</section>
-->

<!-- Promo / Entertainment style -->
<section id="promo" class="container reveal">
 <div class="section-head">
   <h2>Beragam layanan & promo untukmu</h2>
   <span class="muted">Tonton dokumentasi, main kuis berhadiah, dan dengarkan kajian</span>
 </div>
 <div class="promo-grid">
   <article class="promo">
     <img src="https://th.bing.com/th/id/OIP.Bw0xo9AG0fpzxr7MWsacMAHaD2?w=296&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt="">
     <div class="overlay"><div><b>Video Perjalanan Umroh</b><div class="muted" style="color:#f3f4f6">Tonton dokumentasi jamaah terbaru</div></div></div>
   </article>
   <div class="stack">
     <article class="promo">
       <img src="https://th.bing.com/th/id/OIP.1vQ7vt7DGhMqXpi7IwDlqwHaEo?w=256&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt="">
       <div class="overlay"><div><b>Kuis Interaktif</b><div class="muted" style="color:#f3f4f6">Menangkan voucher potongan</div></div></div>
     </article>
     <article class="promo">
       <img src="https://images.unsplash.com/photo-1483721310020-03333e577078?q=80&w=1200&auto=format&fit=crop" alt="">
       <div class="overlay"><div><b>Kajian & Doa-Doa</b><div class="muted" style="color:#f3f4f6">Streaming setiap pekan</div></div></div>
     </article>
   </div>
 </div>
</section>


<!-- Articles 
<section id="artikel" class="container reveal">
 <div class="section-head">
   <h2>Artikel Terbaru</h2>
   <a class="muted" href="#">Selengkapnya</a>
 </div>
 <div class="articles">
   <article class="post">
     <div class="thumb"><img src="https://th.bing.com/th/id/OIP.1vQ7vt7DGhMqXpi7IwDlqwHaEo?w=256&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt=""></div>
     <div class="body">
       <b>Panduan Persiapan Umroh</b>
       <p class="muted">Checklist dokumen & perlengkapan penting.</p></div>
   </article>
   <article class="post">
     <div class="thumb"><img src="https://th.bing.com/th/id/OIP.0tmjYqs50dH79exsdzV2RQHaFj?w=224&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt=""></div>
     <div class="body"><b>Pilih Paket Sesuai Kebutuhan</b><p class="muted">Hemat, reguler, VIP atau plus tour.</p></div>
   </article>
   <article class="post">
     <div class="thumb"><img src="https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?q=80&w=1200&auto=format&fit=crop" alt=""></div>
     <div class="body"><b>Tips Ibadah Nyaman</b><p class="muted">Kebugaran, adab perjalanan, dan manasik.</p></div>
   </article>
 </div>
</section>
   -->


<!-- Partners & CTA -->
<section class="container reveal" id="kontak">
 <div class="section-head">
   <h2>Partner & Sertifikasi</h2>
   <span class="muted">Maskapai, bank syariah, dan asosiasi resmi</span>
 </div>
 <div class="hscroll" aria-label="partners">
   <img src="data:image/png;base64,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" alt="Garuda">
   <img src="data:image/png;base64,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" alt="Saudia">
   <img src="data:image/png;base64,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" alt="Emirates">
   <img src="data:image/png;base64,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" alt="Etihad">
   <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAYEAAACDCAMAAABcOFepAAAAxlBMVEX///9cBjJQWWdYACtTACJaAC9WAChOABiEWGtRAB5OABdUACRZAC1VACa2nahbADFHUWCYdYRMABPh2NtAS1v07fFIUmFMABH49PbJt7/cz9U+SVlPABtkHT6oi5eylqKWm6PAq7Tr4+fUxcxoKESnq7Hn6OrPv8bZ293O0NPw8fLBw8eOZXeceYjEr7mkhJJrcn15Q1u3ur+LkJh/TGJiEzpyNlFEAAB/hY6sr7WLX3J6RVyCUWZyeYNaYm+FipMxPlA9AAC2vnX3AAAb8UlEQVR4nO1daWOqOhPWIq4oalFxX7tb7WpP19P7///Um4UlM5CQ0N7bD2/nwzkUA4Q8yewZCoVf+qVfyiL/+Gw5u+5st9Vtp3M9361X/vc+4O1lPhwurx9H33tbE/LdTms4bHUef64L6eSv52/TWr1WapTLZcuyyL+N0qTb2Gxb3zdcfq3cqNVK5dK1stXtS2c2n7eWu+HZenRMaUWpx8jvRcTO0p9H67Phbtmaz/ed7dutug9nlXKpVmuUu4avtX/Zz5e7M94fQuSRyxZ5JJ2x1beH29eHt+1+vjs2u2tIx/PD06Rh2cUEuU65VBm8LXv5bozobMLvalvKZtNmudkoEarVJpNKpVIn1CU0gERP0Z8qlcmkRoAtlRrNcrl5UPdhW+Z9KG/N+t6pNVmHWH/4I2kXG+SZZMI6juVY5WapVhkc5iuzOxd680235CQHXyCrVLldfgNDCt++ODlTNeuUlb1RU1m5vgqFmhvMrZpZ3/dNzQ44je6t8vUQjapPGcPPyap1r02xxeSHb1+0XlTtZrovm0alubIPw1rYsDY06vy8od8Hp3urO1aj266FLiZckqy0CREIFkKmWdl+DYNd9PbFumpFfQ2BpbIP1eh9rapR55eltKe5tu2mnbfq6m4EtHobwEG2ahUieXdrItvOlvPtplKD/KA86HyFF73GT6upOrg3mG5JBFqqLvTiSVCsGwm3YQ08xmmQidqtNB2XcAciQ3E33EEn+57zOrjObgyqQ9ip3nDbLQH53ChrYZtKvbrwAiqN5UtyoDlT9UGcyWqsMEEEnNvWcD1a+YxW69YbGidCkyxRv9qAW7old542v/3l40S8t11/yLsMACetKxjapmwxZYipQkQLGjCVp15HXLFBNCSuEoW6CVVMmg+qPhyEezhTk96HehynhLwn44TZVGWvvOGwBhaAVZELsGUJ8OWyldNAmIpINuRT1Xdvt509sQeoOTA6XvX4TPMLDwCCRqvATveoTTAaMf2cKOe3rqILxwPxDnUT5X0EEUjhMbMBWgaDteJ+swEQIJM3FU/0t12xtT0wWr4hreviE13VQEmoCiZNhshNpWs4lzIUV0DHoPtpCBRGNQiBrXjHTgW0fMoa0l0X3Hug5LUSeoHSqqKaIOm0/TICZfAaGYYhpFU3E4HCcQ0qRnLNeAtEgF3LHozjJuAAdZPZw6kHQM8yCVIJSujazvgGO6jPFCcGJkFPA4HCEDQqunXZm0AAKjrscNUE06duvApaSFC5NWOJDnmIoUVF6RbJckcptSHBGSRBoPAGF7pklszAvdyJnmBdTSAjMuUBU6ytmSmDlPZwDZiY/oygHKbU1Tcxe2AGyRCA0kIC8Rnsx0B3KuHrzDQiKIdZ7zZGNyhg18zEWJAk7QyFRobJL4s8XoZA4QAmmltKWeg9oNcUS2qlVaQZZF6OERd5S1iNRVP/8FcR8EsJB4KtHyXwbXFspQggj0ol5R1vwVA4Gb5cQBvARpsmfpVVYgko3kJGM+CtMEYASyI2Qvo3KWohcAaFfYrC1gKGRXFgYpQgJtc1EIVpvt3UJaoihIDpEkpIIkLWm/blj1oIoKmW9JH4dbASG2ZaJWSkKoMDk8O7jzQFQ2kOV7gpAoEksiEO+u45PQR8KC2biQHegpdwG2az0IfqbklbjgWKeBlaZbahLIZrII3FqohLIvt1AyDQf4epFgKFDATwGtEXw5yuwSJwJ7oA8re2qiukT5lFVedfQWDFdfDaEIoDfVmsiQCcpAkEXqA+NjA1ihCCusrciF9GxN4BCHPDWC1CwAw+LoncRqEHZ0FF16zY6CEATf8G8kugh5sGqwk9QDaiKQk486HTDUaaDGXxlxDgLhu66uE7aMtiTQTgEGPDHQWf6uZuZhQp0nOsBE4tagT70HdlZhd/BYEAemoED6E6qGsX6yGAJjke4iJ0DRpFKDj5kA3pTaBAh+nSCb8FfNAsSPIVBKaM/VnMSwDTctRBtZj0EDiGLh+0yNeQRxnLYUrIth3oKHPcFuU8bwQhrJuYVV9AIHh1niUD9Qnb0buFHgKQzWK/EPKLGJs0ySdouYiXnHMFCxLaRUY+6i8gwHl/EBZCHrqJnptbDwG4xjGXrUC/SNfgDSI6htqWzghyBhD6P+YQwolBAkx+BAItONRMoPtM0zMDfDIyBHzI4ZCyeZyHhyfIgbIkW50ObNHQAM6p0FLKj0Cw+isBz0QeIr14sRYCQ2U0Gc0+rKpqEgyXK3MeOPEsIbeUfgNdLkyplReBQAOLtG/kJdVzEWohAFiVO0FSEglRc/86I+Rjy4xUBapoLPaRMmgQKYRT1wCBYO7FqiH0juiF63QQ2IF3q+H1/ZjXJwUIieJMLtLhiFXitQJZpZWRbS5QbgQ45xRCQkgr1DJLNBDogUwAC8sXGGompoH2CwBawylsZdjVAQMQ1TKoDBpk7eRFIJiZoivWBWxIyzmkgcBBXFpOGU9xmHJkFpsRCJocRTvjNoH0FNPVkUaQdODKKC8CXPUBjmDoZtUK1GQj8CYyaHuS6N8Oso8c2SKMehDIYkndnLMcmJ8F/cP6HtacCIz4nAH5WSs4j3TyqLMQ6B1EVK1ysnsogmmiBorkIwQGytZBYADqXUiUaDuHciIQaCBQa3uFKp2GcygDgXlF/L12SJGyiP2aJ4sEhLKe1H6JYLrXQCMfMTJd51A+BAJrDGVro+QtDQ8NtIkh6zzeO6KCaw1Sb1fVSibKJoSAcvasufTHbnBoumu76PMhEChjWOuFTlqNPU0AAXta3Xb2s9ZyuZx33kp1MZ/NGbymd+0WKqM5zQHSdaTUqgYicMXjvBSsT2mmruVCIFDGXKz6dSBTzs5ChdLLtqxyk+03bJQdAUy70X2VjSxKFTANs0aE1oAKgcCJlIwHu7AvAz3n0DIPAoE1logHIydtdv4YRCCNXKvUfdzLu/UImxuGmGIyQCBwxyRzIpBWoJlGnguBwI+VtD83yL2SxRMyEXDdt7myTwgBo+0LImEE5PM3SHa1mwl1E0XsNaOVeRAIJG6K7o3cc5mOygQXwltQMxNZUfu8CGBtVCGJZ/wd02Y4Ugb1FLM8CATjlpIhieKJmQoplMSb7fYWpaHaWfPomxDA+wAU+RaBgpDG5ZEyqJczkgOBwDWeyuWRcphlmye1UZyEV85YRt8kB5A1qYjzBLEx5zXtR5RFq6WQ5kAgsMZS1xjcm5fJCpMxskQ2fEWtUB3QO+etQQERUOwHC0RdegUDFDFV7m4NyRyBQN5I3M9II8tghSlRyjniyBlK3RtkveYbIDiNdHX5gAFIIBpBT60WUzRHIMC5me7NR6GODG9xWpz4FVckUPopsVci59ZsxMHl8aVA2DYkMwtmz2lljxkj0AsMX0kwuodS6tXBorSsxd4EbUlIBGVEQqUpcgYpUahQvnTDkL71Rqx3ujl4PeK0Ptu1ZrPrAxJj3eyA0c4UgdAH7W6vZ6QPu7OoD8PlfLbvoC6og0WpeaNo6546FRalu+VIWWSEU15khkzk+6H74+kG+QmrFUQ3v7NCQNi+0UicgstPA4EoGsf36Id9mNA+NJrNxKYmZSbxY+oupi2qgaHKQUOBkazQioweULRZMnWx0ppJGpt7TRFY1mQPk5ByVkr2DyBxXmzIw/4oQcC28tWH0Mx8nBnXR8nez2GKwAZbrZmkYoUSBLBKoaplgHbTdnOpoyjaLBXEjUw/FqbsHFJDBNamy1AdtpLtI9uj7Wm2LZ3aaFrmU4bQTjVZsooxAyhq+MaGZgi8Gi8BFSv0XQkCiaUm3+I4gnMinyhGOrTMJxEqDlYgACu8AA05mNTrQZm8BpKEmb4xMwQii7XJawaGBfqoMKZ94LUBkUIvZ4W+I9tPvMIqaVca/IIt3YwYezqhxFvJoJ0FYFtVVrRyPQrqVa54gUqiDe6Wyzlev1lWmRkXCpWx5vV8megDrSI2XC5bc+QckrNC35Lu6Eb7U4kJLjONkSKZYwMHzvqUMaHQ3JJpSgEhPiExXSMysshWwbBkZOWgvY/yvBW/Kd9Tj03jRK5WSKMv7uMr4EGwy+lMKHxQVhIIMlGKFbV6ZoRAyC6z4uGo6I6UFfqKuhI9XOJMahpDmWGwpT8iqE/JYlvhW2XK1ibyjantdJM4cah7Z5oZWGOShQl6qqzoHVZJZRUbkIaivY0wIljmSOYKDFtlQwzr1WQV3jJBIGzbyFzoKJ1Wxgp7yhpbVRytkaWEwxSNdM+9iqB3ryxJuwvHNTvyhaKVGb6xuQEC4bhmZ9ejpH4ZK1RXePJxyWjZ2LTgIjDcUY338Unezg90LreW7WxDVqJabML4vhKBMEVeY5LhaKXEZblS15k7w9EaWclX6FMwLDuLjAGZPRxOKh2DA9cdU1a82esjECljGrsTkEIqYYUwMpV8ty2uXSJh0UNUHsVIIYXecGnGbZgZrrVPEkUrlXNCH4HQWaO1Q+cMyeL0nX3Qnk3mXvjYRSdTSaHqalbnCoobWVA03Eeip2ohWSzu9EgQtGdUCITTWk/hRrI4fVBgnl/KTFljPiT5ysIKCuOaQf4uXD/S8GSo8uqFgHC0W5WxAFV3BQIRz9ZLCMF+3NTFC+P6aQXkOtgdPEjXNXfgld3kPgMZ9YC7U5ocE+nXqtksEIpWqnYTwD2AirTLUGXT3KWCZXGqVYbrTqc0KSI+ZDfSVZFtzuou0JyTesHD/YK6m2WxF1VhlR00EYhUNt0SUrgIXppVBhFIjW8l+JBMFBwAO1VXyhZ6CRh2VxoeDnuhu0cS199T1GuBXkF5SYAwIq5d0hRlDqVqeUM4cVM9eB2sD9XS5ZDvwurBWtuZqqADEym3Dj2SdlPnruIV0b2ljhwoMeXp9+Gmc/1Sgg7iHykfqFhqsI6EPlTspneyZ4PlXNKwCh4gANJXi2x3/arayF+oqH3m6CEQ8TX9QopYI0upfQZzRCQrNWGX2RLv8Arm/TbSNj2B9lMwT+vyuRWpFQZpqTj9UmakwJqr8r3k0+DlDMq7Y43MthNNoEEuMzReMB+SiYIeHFKrqfTRLSciYK6i8nrkHjEpHIQdMzIZDusOS93OUXVfk72KOHspKcOhOSgLb/lNzIdKshogt1C0D16kuuPxLTCFnbrC4R4xAJN8sEQ1WMn6WUF5KYtzR2EfE68XrgablLSIUVUkN1om0gMGsvHaw29AlOudVAxG1S4UGlOVmh/JSs19SZxQsRCZBEVISRCI0qKMammi6mspnnsUYJQhgO0bauHIxmJdRluJBq9L1HbVOsCvZUm2aYYUFe0w27CPQ2WStJ2RuoxhQJFqlRHuQfSCc3CxyQU/PyFHAGf3q0wuf4s+RuaUJo+d+dmIhrOP163O4wR+LM6uHNQLO/I1G25WxswzPayCdmCmh1Ji+1bTJg9vjgcO6wP4EyLypKBEeWtFhe7RoYvWjF0u1ejnj7qVSQmldtqTaYaRFaePmb19QhlMrwWMlkp6WYaonKRZEcGkSYB9b4hVKkLaCaOgOFHoBGeHut7Hv8r1Q6aRGznaTcsZj/AETF1DqBiCk6Yy+ZHzyjQ3PPEhQCTKDtoIrHHQWOqj4zTaVmqWm7gGUyc7krAaODRNuuzYxjUriApvO065QalpObaTpsovS7bt0G3UrImd6hho1ehdmpbtmiZlEjnv2rbVpD1olh3HRl7aKXl48Ct5ultRmFDbJjEo2IZv0pp+u9W2pRlEjPxdtVlJ/TZuRPZUI5SzbRw6s/lse7CfTDORWk+l4uahMyOXz66rh6n1lKLozJ6c6e2Wttm/3E7t0lPKjZqPD/sZ+X3TLBt2oXAYlB8P1f1sTvrQedg8Np/AINca08PLnj19e5iW/1Eg4A9qxU2VvA2716zzdpg2s76X4Y/mVWdQqTUo+nR+kRkJM627L5lerlXKkSb5K/hCfi/lFr0e6EJaE7+XPNKlHvoguQ//hn/5ylfsJR6OX1By3Wg4328fDpvNdDrd3KIdy+XcxVh+KSetpiiZZ5Khi/7St9ML/ojbwPxDcL/0JWrhb12WXPPPsP3SV2jkIGPdriu/IfpL307Ih0pZ0STnNthfyknXXWSuuTUd4+CXvo92Fexvtb/2ufpfMiWslhbp1qy8dQJ/KRdVkz7vyqux4ftLX6B5N+E1sro5S8b+Ui4alZLfVi095i2Y+Us5qHdIftnU7r5g4+Dk7g6eOL0kKu0pP76k//v+5enp+flp1IAK9VN4DWkq/u1fkquC4/Pn5/O4GWkIWoqXXl7cnZzcXcDf/03yR4wxH/9rvpvOIBlFwO6688/2GF7197PdH7/z47vPseeNx5+f47E39m44VgvSwPsUIfA/296NeI+rz/5nOJCLsfc3OHz/7JMrF2LLC/L8E370Pmbkee9XQoPZ4bAP/9UlTTdAb9IdbPzCZtBtpGHwHdrjrpIMIThPIKJ93z9qX4GLFv2jo/49P77yjo6OPt7/3v/5oEd8mE/pYVtcORfkzFicun/74R0KBXpd8DKX9MojT2z53u9z7O7Hfe/v3cXV4qjf/7yIfj9+cpzBfMX+1Xzr1aNm7QGaqTNp0Z1xwh6y1SbgEp1vUR6PH5FaaldQ6LhNhvsdnHmmpxb8mA5tcHxOB4+P1s0RuoiC5ok4kj9DzkNv4YVwPTPwFnHDc+9ozFouvKN2cMmf9lHcgAYQG9e0+JSiCA2gZV2WcoVpN3Ccp2HvybHinMJlhYd5Ro9P3+RQexPTFewaDt2zSe4Bpn5HEGhzxiAiULjsHwXjzC8SLmHg/In/JuP6ER6/08siFvWBFsGfPsfjfCysqptFfCu/OBg8rgrsX18ntb1ad7XzfzuHB8KT54fbkMP5DxWXJd7sB07m93p0aRZ5S92SlXgFOp2j8eZEx7f9zI/PBQQKJ+1gnH2GQMwpzhlzacd886QdDefp+EjE+HwMnkd/ZQd/CDOMLr+Ib01otQr+9acaouC2lONj7tGjrDJPfaK+tW9DoLBuch9FOSUDgw3I0dGReI7O+3AAAQIXTCjQo3tBVBQ4EwKQ3MTTfNGnP0b3IBJCBOtvP2BeHupECvWUKSQh0Q/L5EZgSBNgCAIr+lnw70Og0Ns0qGeommIS37dv3uHgKRDgUz1sIowYRzGG5HIcs6R+n+HTj34TJcGpF4gTuhaiJum0ch2dhA66jTs3AiwZla4BuhH2GxEg/K7bKKblv1x63tVVG/JwjkAgVpMIcI7O5vx5dN67AKN85UWQ3nke5TCCnL7zYklAlgBnT1S9AtMgQauSo5VaTSuv5EBgzafnv4ZAoZWun520Pc4ARFksRUAQ0UxjDc8v2h98lENIyB/hzT7a93zFxObCR8SVTsehRLhk3BBaeYD8upOV3M5NwFwILA//cPf9v4eAhBg7oExdlMVMfQwQOBUR+IgnL5ev4Xlytag0+V6kb154FBawYrjsGdPRfo+RYpJkvJCbw2ePrhqBdTcnAv68XHMqP4MA4RanwYgITFiGwAk1u0Jm8hEP6vmY3qUfQ3LljcPZ/N6nknsBBTcVxpTvEXgi3rRoM1Hi/ZGyItdWIjAbTPIh0CrTUkM/hMAHl4MfR8CeSkfg8p6YTHErwWxbtCmHuY/Z0J9+yHJOPcbO2IrxImX1ss3h++jHrMnvB+LcOzpJXQg0UTUFgTN+1x5RH2siAv562ZonaJkIFa42E6as/wwC54HApKMp8GmMAPnt5v3D67c9gUmcxtoQV5xiNkSYUGBNEHC4kk+tjuhkYBnf3HnjiDORG/bbHAOCMzBPGPlbmlubRGD7Dxv2UZPooOIamJcqJVqxEFPXha6N4wpNf/0xBEKByRTEmE8nEThiOjz0Ht2E11x43CN0FPIywtsCpCKBcAe1V24Z94EGRv0SIQYe/IEMTIWli2MERk6DV46c0R3OfA8kq0JnNWSJzXZtIziHaa2zxuOL80MIEE0kmJZUkemH/ss0LsTGBTg/mWLE5vx9m48X8w3RNfXeDl1Gz+1Ax/Lb0Ojg9oSHdJ/Lk77HmZH3LJ7vhdviEAI0Nyqo3UlrqgoI0KFOJWqYCgnc+wYt5rGu/RACi377/NIndElHM/ZtiggE2igT1pA5XIbaUCgcWNO/dEVFq+Wof3PJn/AHQfhH1GYFunrni050Oo0mNNRE6yZCBM6eikUZAuXa4zSFXJrCIBRQ2Vq03sfwhxCgvMcbM/c/10MWwQ8pCHBVRWTb3ONG2NCVF/pzAt8QscECmXsVP4ENq3A9NQM9yNYCOv+IHICc1jTcWq7PEtroiu5CDhAYQgRKkswQ//jgiN9O2VouQerxh3ShkzYZHq/db7fJfxETL8DRiSwyxrk/xOvv+E/v7ZB9UTZEpv9NO+TiH0d9MvzkCQQDimDM6BgPS0dAtNgo9ep20a2TEU1qo/TbIgECO4CA4gMtdNde/JGXrUX3gNg/JImpDRrwiMtTNu8CX9BVmk3MFMr2vXA9k98fl7EDgrV9vxyHI3vh9e8vCfn0nyvBF1FQI8C0quhJ2zJh6XR4kgisYwTodqkYAUV9BlqDNI4SVrs1Qs2fQeDOE+1g5j0LpjhdA6FnLtYxmQY5FgftnRlW/dipzN1z0Yn3viewrSPglVYhUBDtcFoBiA9FNgLMtZNhkdFvs8X71dY7SnTv/Q8g8AFUEW4z8dl8l4pA4YappIK1dNeGHlEOYz/kNUSNErWnk7ZoeVMTBKi3It8WjQffsYvc3aBEoKWLAP3MBf7OztmPSOILD8Ym2YTmI/aMEeBjzLiOYMWGQV8cqAlP3PfBJGe6UxytbKNI84cArRe4jSj1GuH307IR0OJC3eS2z59B4B2OD2M9gVX2LEQprwSezPiQqJKy+GNbuAk3afkxwccDCskfgdGxFQEQEEQMQT0Gms3ZWYsQ0UadakskWhktRKBBP4tDT9JaUc5rS0a0koz1As/R6gfNPTukm8D/GwSIgu/BM7GywoKRwUAzuytUYRgfGsdz/g5HFkQP3Em7L8rtwAoLFwhDQDC7YvnNdKFoCfCaoeybwizPA7gYyrE9wIq90K8WpLUTiSUuWPAcs7fZxSzJ7b9BQMwm4XTfD60y0fcPEOAu6VgUXHpInF4IcZZ+IuLSF6wy9gxhORHVNrCDTwnOgsA/y/gySIiA8Td05PSfIHD52R6j8TkfU8tgQY7uPXIQjPoJPY6m+YlH28RWwY3XBllChXa7HSyt53Fb5E+UFvTqz/PgOHhYQBcf9PF/F4ubcd/7EFSoZd1S0pOAgLqlNtFsleOB43T/TQSuTk7u8bn7xcnzgg78YnFysgi5ED0Zz9W/5M+TRcS/rxYnC3CPE0L8aHGywB7O078LcjGf6c/0GcD5c7444ilzIGGusHyrKumVI0ALHNgv6qa69ODTCk1vb7f/fzm2l+dCcqoZXTdzfZvhl3LQaj4nc9NvzUFO4dSWFG75pe8mf1IqPc0Lr5VGV6iST1UhecnNX/pOomm21i31VbgD+jetFtHbE83F+WVC/w35k1rpqVW4rZcGrFjR7p9Bt0vEsKUuRvNL30er5fKYADFcBprKju0Ucqr/yq71/wECLXNPv5NTaAAAAABJRU5ErkJggg==" alt="Qatar">
 </div>
 <div style="margin-top:1rem;display:flex;gap:.6rem;flex-wrap:wrap">
   <a class="btn" href="https://wa.link/1cz4on">📞 Telepon</a>
   <a class="btn outline" href="https://wa.link/1cz4on">💬 WhatsApp</a>
 </div>
</section>

<!-- Footer -->
<footer>
 <div class="container foot">
   <div>
     <div class="brand" style="margin-bottom:.6rem"><img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?q=80&w=200&auto=format&fit=crop" alt=""><b style="color:#fff">Barokah Travel</b></div>
     <p class="muted">Penyelenggara perjalanan ibadah Umroh & Haji. Layanan ramah, aman, dan sesuai syariah.</p>
   </div>
   <div><h4>Layanan</h4><a href="#paket">Paket Umroh</a><br><a href="#fitur">Layanan</a><br><a href="#promo">Promo</a></div>
   <div><h4>Perusahaan</h4><a href="#">Tentang</a><br><a href="#artikel">Artikel</a><br><a href="#">Kebijakan Privasi</a></div>
   <div><h4>Kontak</h4><span class="muted">Jl. Contoh No.123, Jakarta</span><br><a href="#">info@barokahtravel.id</a><br><a href="#">+62 812-0000-0000</a></div>
 </div>
 <div class="container copyright">© 2025 Barokah Travel — Dummy desain gabungan modern.</div>
</footer>

<script>
/* Helpers */
const $ = (s, p=document)=>p.querySelector(s);
const $$ = (s, p=document)=>[...p.querySelectorAll(s)];
function scrollToEl(sel){ const t=$(sel); if(!t) return; window.scrollTo({top:t.offsetTop-80,behavior:'smooth'}) }

/* Header shadow */
const header = $('#header');
addEventListener('scroll', ()=> header.classList.toggle('scrolled', scrollY>10));

/* Drawer / Hamburger */
const hamburger = $('#hamburger');
const drawer = $('#drawer');
hamburger.addEventListener('click', ()=>{hamburger.classList.toggle('active');drawer.classList.toggle('open')});
drawer.addEventListener('click', e=>{ if(e.target.closest('a')){drawer.classList.remove('open');hamburger.classList.remove('active')} });

/* Smooth anchor */
$$('a[href^="#"]').forEach(a=>a.addEventListener('click', e=>{
 const id=a.getAttribute('href'); if(id.length>1){ e.preventDefault(); drawer.classList.remove('open'); hamburger.classList.remove('active'); scrollToEl(id); }
}));

/* Hero slider */
const slidesWrap = $('#heroSlides');
const slides = $$('#heroSlides .slide');
const dotsWrap = $('#heroDots');
let idx=0;
slides.forEach((_,i)=>{const d=document.createElement('div');d.className='dot'+(i===0?' active':'');d.addEventListener('click',()=>go(i));dotsWrap.appendChild(d)});
function go(i){ idx=(i+slides.length)%slides.length; slidesWrap.style.transform=`translateX(-${idx*100}%)`; $$('#heroDots .dot').forEach((d,j)=>d.classList.toggle('active',j===idx)); }
setInterval(()=>go(idx+1),2500);

/* Horizontal drag-to-scroll for carousels */
['trendScroll'].forEach(id=>{
 const el = document.getElementById(id);
 let isDown=false,startX,scrollLeft;
 el.addEventListener('mousedown',e=>{isDown=true;el.classList.add('drag');startX=e.pageX-el.offsetLeft;scrollLeft=el.scrollLeft});
 el.addEventListener('mouseleave',()=>isDown=false);
 el.addEventListener('mouseup',()=>isDown=false);
 el.addEventListener('mousemove',e=>{ if(!isDown) return; e.preventDefault(); const x=e.pageX-el.offsetLeft; const walk=(x-startX)*1.2; el.scrollLeft=scrollLeft-walk; });
});

/* Filter products */
const chips = $$('#filters .chip');
chips.forEach(c=>c.addEventListener('click',()=>{
 chips.forEach(x=>x.classList.remove('active')); c.classList.add('active');
 const cat=c.dataset.filter;
 $$('#productGrid .card').forEach(card=> card.style.display=(cat==='all'||card.dataset.cat===cat)?'':'');
}));

/* Reveal on scroll */
const io = new IntersectionObserver((entries)=>{
 entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('show'); io.unobserve(e.target); }});
},{threshold:.14});
$$('.reveal').forEach(el=> io.observe(el));
</script>
</body>
</html>
