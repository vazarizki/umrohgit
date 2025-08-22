<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

/* ===== Footer ===== */
  footer {
    margin-top: 2rem;
    background: #0f0f0f;
    color: #eaeaea;
  }
.brand img{
    border:0px;
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
<footer>
  <div class="container foot">
    <div>
      <div class="brand" style="margin-bottom:.6rem"><img src="./assets/TWS TP.png" alt=""><b style="color:#fff">Taman Wisata Surga</b></div>
      <p class="muted">Penyelenggara perjalanan ibadah Umroh & Haji. Layanan ramah, aman, dan sesuai syariah.</p>
    </div>
    <div><h4>Layanan</h4><a href="#paket">Paket Umroh</a><br><a href="#fitur">Layanan</a><br><a href="#promo">Promo</a></div>
    <div><h4>Perusahaan</h4><a href="#">Tentang</a><br><a href="#artikel">Artikel</a><br><a href="#">Kebijakan Privasi</a></div>
    <div><h4>Kontak</h4><span class="muted">Jl. Contoh No.123, Jakarta</span><br><a href="#">info@tamanwisatasurga.com</a><br><a href="#">+62 812-0000-0000</a></div>
  </div>
  <div class="container copyright">© 2025 Taman Wisata Surga.</div>
</footer>

</body>
</html>