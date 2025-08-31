<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
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
    font-family: "Montserrat", sans-serif;
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
    border-radius: 10%;
    border: 2px solid var(--primary);
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

</style>

<body>
    
<!-- Drawer -->
<div class="drawer" id="drawer">
  <div class="container">
    <div class="menu-col">
     <a href="listproduk">Paket</a>
      <a href="index.php#trend">Promo</a>
      <a href="#trend">Artikel</a>
      <a href="tentangkami">Tentang Kami</a>
      <a href="./#bannerApp">Kontak</a>
    </div>
  </div>
</div>

<!-- Header -->
<header id="header">
  <div class="container nav">
    <div class="brand">
      <a href="./"><img src="assets/TWS TP.png" alt="Logo"></a>
      <b>Jalanmu Menuju Baitullah</b>
    </div>
    <nav class="menu">
      <a href="./listproduk">Paket</a>
      <a href="./#trend">Promo</a>
      <a href="./listblog">Artikel</a>
      <a href="tentangkami">Tentang Kami</a>
      <a href="./#bannerApp">Kontak</a>
      <button class="btn" onclick="scrollToEl('#paket')">✈️ Cek Paket</button>
    </nav>
    <button class="hamburger" id="hamburger" aria-label="Menu"><span></span></button>
  </div>
</header>

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
</script>
</body>
</html>