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
           <div class="price">Rp <?= htmlspecialchars($p['harga']) ?> Juta</div>
           <div class="cta-row">
               <button class="btn" >Pesan</button>
               <a class="btn outline" href="detailproduct.php?id=<?= htmlspecialchars($p['id']) ?>">Detail</a>
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
   <img src="https://dummyimage.com/140x42/efefef/999.png&text=Garuda" alt="Garuda">
   <img src="https://dummyimage.com/140x42/efefef/999.png&text=Saudia" alt="Saudia">
   <img src="https://dummyimage.com/140x42/efefef/999.png&text=BSI" alt="BSI">
   <img src="https://dummyimage.com/140x42/efefef/999.png&text=IATA" alt="IATA">
   <img src="https://dummyimage.com/140x42/efefef/999.png&text=Visa" alt="Visa">
   <img src="https://dummyimage.com/140x42/efefef/999.png&text=Asosiasi" alt="Asosiasi">
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
