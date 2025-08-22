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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CMS Travel Umroh — Admin</title>
  <link rel="stylesheet" href="assets/css/admin.css" />
</head>

<style>

    :root{
  --bg: #0b1020;
  --panel: #111731;
  --panel-2: #0f1430;
  --text: #e8ecff;
  --muted: #a4b0d3;
  --brand: #7aa2ff;
  --brand-2:#3b82f6;
  --ok: #22c55e;
  --danger: #ef4444;
  --chip: #1e293b;
  --border: #223158;
  --shadow: 0 10px 30px rgba(0,0,0,.25);
  --radius: 16px;
}

*{ box-sizing: border-box; }
html,body{ margin:0; padding:0; }
body{
  font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
  background: linear-gradient(180deg, #0b1020, #0b1020 40%, #0b1a3a 100%);
  color: var(--text);
  min-height: 100vh;
  display: grid;
  grid-template-columns: 260px 1fr;
}

/* SIDEBAR */
.sidebar{
  position: sticky;
  top: 0;
  height: 100vh;
  background: linear-gradient(180deg, #0d1430, #0b1020 60%);
  border-right: 1px solid var(--border);
  padding: 28px 18px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.brand{
  font-weight: 700;
  font-size: 20px;
  letter-spacing: .4px;
  color: var(--brand);
}
.nav{ display: grid; gap: 8px; }
.nav__link{
  text-decoration: none;
  color: var(--text);
  opacity: .8;
  padding: 10px 12px;
  border-radius: 10px;
  transition: .2s ease;
  display: block;
}
.nav__link:hover{ background: rgba(122,162,255,.1); opacity: 1; }
.nav__link.active{ background: rgba(122,162,255,.15); color: #fff; }
.sidebar__foot{ margin-top: auto; color: var(--muted); }

/* MAIN */
.main{
  min-width: 0;
  display: grid;
  grid-template-rows: auto 1fr auto;
}
.topbar{
  display:flex;
  align-items:center;
  justify-content: space-between;
  padding: 20px 28px;
  border-bottom: 1px solid var(--border);
  background: rgba(10,15,35,.6);
  backdrop-filter: blur(6px);
  position: sticky;
  top: 0;
  z-index: 5;
}
.badge{
  background: var(--chip);
  border: 1px solid var(--border);
  padding: 6px 10px;
  border-radius: 999px;
  font-size: 12px;
  color: var(--muted);
}

.section{
  padding: 24px 28px;
  display: grid;
  gap: 18px;
}
.section__header{
  display:flex;
  align-items:center;
  justify-content: space-between;
}
.section__title{
  margin: 0;
  font-size: 22px;
  letter-spacing: .2px;
}

.grid{ display:grid; gap: 16px; }
.grid--stats{ grid-template-columns: repeat(3, minmax(0,1fr)); }
.grid--2{ grid-template-columns: repeat(2, minmax(0,1fr)); }

.card{
  background: linear-gradient(180deg, var(--panel), var(--panel-2));
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 18px;
  box-shadow: var(--shadow);
}
.stat{
  padding: 20px;
}
.stat__label{ color: var(--muted); font-size: 14px; }
.stat__value{ font-size: 32px; font-weight: 700; margin-top: 6px; }
.stat__hint{ color: var(--muted); font-size: 12px; margin-top: 6px; }

.btn{
  display:inline-flex; align-items:center; justify-content:center;
  gap:8px; text-decoration:none; cursor:pointer;
  background: var(--brand);
  color:#0b1020; border: 1px solid rgba(255,255,255,.15);
  padding: 10px 14px; border-radius: 12px; font-weight: 700;
  transition: .2s ease;
}
.btn:hover{ background: var(--brand-2); color:#fff; }
.btn--ghost{
  background: transparent; color: var(--text);
  border: 1px solid var(--border);
}
.btn--ghost:hover{ background: rgba(255,255,255,.06); }

.input{
  width: 100%;
  background: rgba(255,255,255,.04);
  border: 1px solid var(--border);
  color: var(--text);
  border-radius: 12px;
  padding: 10px 12px;
  outline: none;
}
.input::placeholder{ color: #98a5cd; }
.input--textarea{ resize: vertical; }

.field{ display: grid; gap: 8px; }
.label{ font-size: 14px; color: var(--muted); }

.form{ display: grid; gap: 16px; }
.form__actions{ display:flex; gap:10px; }

.tablewrap{ display: grid; gap: 12px; }
.table__actions{ display:flex; justify-content: flex-end; }
.table__scroll{ overflow-x: auto; border-radius: 12px; border: 1px solid var(--border); }
.table{
  width: 100%; border-collapse: collapse; min-width: 720px;
  background: transparent;
}
.table th,.table td{
  text-align: left; padding: 12px 14px; border-bottom: 1px solid var(--border);
}
.table thead th{ font-size: 13px; color: var(--muted); text-transform: uppercase; letter-spacing: .4px; }
.col-actions{ width: 160px; }
.actions{ display:flex; gap:10px; align-items:center; }
.link{ color: var(--brand); text-decoration: none; }
.link:hover{ text-decoration: underline; }
.link--danger{ color: var(--danger); }

.chip{
  display:inline-block; padding: 4px 10px; border-radius: 999px;
  background: var(--chip); border: 1px solid var(--border); color: var(--muted);
  font-size: 12px;
}
.chip--success{ background: rgba(34,197,94,.1); border-color: rgba(34,197,94,.3); color:#9ff0b9; }

.list{ margin: 8px 0 0; padding-left: 18px; color: var(--muted); }
.list li{ margin: 6px 0; }

.footer{
  border-top: 1px solid var(--border);
  color: var(--muted);
  padding: 16px 28px;
  background: rgba(10,15,35,.4);
}

/* RESPONSIVE */
@media (max-width: 1080px){
  body{ grid-template-columns: 82px 1fr; }
  .sidebar{ padding: 20px 10px; align-items: center; }
  .brand{ display:none; }
  .nav{ gap: 6px; }
  .nav__link{ text-align: center; padding: 10px; font-size: 13px; }
  .nav__link::after{ content: attr(data-label); display:block; font-size:11px; color: var(--muted); }
  .grid--stats{ grid-template-columns: 1fr; }
  .grid--2{ grid-template-columns: 1fr; }
}
@media (max-width: 640px){
  .section{ padding: 18px; }
  .topbar{ padding: 16px 18px; }
}

</style>
<body>
  <aside class="sidebar">
    <div class="brand"><a href="home.php">CMS Umroh</a></div>
    <nav class="nav">
      <a href="#dashboard" class="nav__link active">Dashboard</a>
      <a href="#produk" class="nav__link">Produk</a>
      <a href="#blog" class="nav__link">Blog</a>
      <a href="#about" class="nav__link">Tentang</a>
    </nav>
    <div class="sidebar__foot">
      <small>© 2025</small>
    </div>
  </aside>

  <main class="main">
    <header class="topbar">
      <h1>Panel Admin</h1>
      <div class="topbar__right">
        <span class="badge">Admin</span>
        <!-- nanti bisa diganti tombol logout -->
      </div>
    </header>

    <!-- DASHBOARD -->
    <section id="dashboard" class="section">
      <h2 class="section__title">Ringkasan</h2>
      <div class="grid grid--stats">
        <div class="card stat">
          <div class="stat__label">Total Produk</div>
          <div class="stat__value">—</div>
          <div class="stat__hint">otomatis dari DB</div>
        </div>
        <div class="card stat">
          <div class="stat__label">Total Artikel</div>
          <div class="stat__value">—</div>
          <div class="stat__hint">otomatis dari DB</div>
        </div>
        <div class="card stat">
          <div class="stat__label">Draft</div>
          <div class="stat__value">—</div>
          <div class="stat__hint">artikel/produk belum publish</div>
        </div>
      </div>
    </section>

    <!-- PRODUK -->
    <section id="produk" class="section">
      <div class="section__header">
        <h2 class="section__title">Produk</h2>
        <a class="btn" href="create/tambahproduk.php">+ Tambah Produk</a>
      </div>

      <!-- TABEL PRODUK -->
      <div class="card tablewrap">
        <div class="table__actions">
          <form class="search">
            <input type="text" class="input" placeholder="Cari produk…" />
            <button class="btn btn--ghost" type="button">Cari</button>
          </form>
        </div>
        <div class="table__scroll">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Harga</th>
                <th>gambar</th>
                <th class="col-actions">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- Contoh baris (nanti ganti pakai loop PHP) -->
                <?php while($p = $produk->fetch_assoc()): ?>
              <tr>
                <td>1</td>
                <td><?= $p['judul']?></td>
                <td>Rp. <?= $p['harga']?></td>
                <td><span class="chip chip--success">Publish</span></td>
                <td class="actions">
                  <a href="#" class="link">Edit</a>
                  <a href="#" class="link link--danger">Hapus</a>
                </td>
              </tr>
               <?php endwhile; ?>
              <!-- /Contoh -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- FORM PRODUK -->
      <div id="form-produk" class="card form">
        <h3>Tambah / Edit Produk</h3>
        <!-- nanti ubah action ke file PHP: action="products.php" method="POST" -->
        <form>
          <div class="grid grid--2">
            <div class="field">
              <label class="label">Judul Produk</label>
              <input class="input" name="title" type="text" placeholder="Paket Umroh Hemat" required />
            </div>
            <div class="field">
              <label class="label">Harga (Rp)</label>
              <input class="input" name="price" type="number" placeholder="25000000" required />
            </div>
            <div class="field">
              <label class="label">Durasi (hari)</label>
              <input class="input" name="duration" type="number" placeholder="9" />
            </div>
            <div class="field">
              <label class="label">Tanggal Keberangkatan</label>
              <input class="input" name="departure_date" type="date" />
            </div>
            <div class="field">
              <label class="label">URL Gambar (opsional)</label>
              <input class="input" name="image_url" type="url" placeholder="https://…" />
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="input" name="status">
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label class="label">Deskripsi</label>
            <textarea class="input input--textarea" name="description" rows="6" placeholder="Deskripsi singkat paket…"></textarea>
          </div>
          <div class="form__actions">
            <button class="btn" type="submit">Simpan</button>
            <button class="btn btn--ghost" type="reset">Reset</button>
          </div>
        </form>
      </div>
    </section>

    <!-- BLOG -->
    <section id="blog" class="section">
      <div class="section__header">
        <h2 class="section__title">Blog</h2>
        <a class="btn" href="create/tambahblog.php">+ Tulis Artikel</a>
      </div>

      <!-- TABEL BLOG -->
      <div class="card tablewrap">
        <div class="table__actions">
          <form class="search">
            <input type="text" class="input" placeholder="Cari artikel…" />
            <button class="btn btn--ghost" type="button">Cari</button>
          </form>
        </div>
        <div class="table__scroll">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Judul</th>
                <th class="col-actions">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- Contoh baris -->
              <?php while($p = $blog->fetch_assoc()): ?>
              <tr>
                <td><?= $p['id']?></td>
                <td><?= $p['judul']?></td>
                <td class="actions">
                  <a href="#" class="link">Edit</a>
                  <a href="#" class="link link--danger">Hapus</a>
                </td>
              </tr>
               <?php endwhile; ?>
              <!-- /Contoh -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- FORM BLOG -->
      <div id="form-blog" class="card form">
        <h3>Tulis / Edit Artikel</h3>
        <!-- nanti ubah action ke file PHP: action="blogs.php" method="POST" -->
        <form>
          <div class="grid grid--2">
            <div class="field">
              <label class="label">Judul</label>
              <input class="input" name="title" type="text" placeholder="Judul artikel" required />
            </div>
            <div class="field">
              <label class="label">Slug (URL)</label>
              <input class="input" name="slug" type="text" placeholder="judul-artikel" />
            </div>
            <div class="field">
              <label class="label">Tanggal</label>
              <input class="input" name="created_at" type="date" />
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="input" name="status">
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label class="label">URL Gambar (opsional)</label>
            <input class="input" name="image_url" type="url" placeholder="https://…" />
          </div>
          <div class="field">
            <label class="label">Konten</label>
            <textarea class="input input--textarea" name="content" rows="10" placeholder="Tulis konten artikel di sini…"></textarea>
          </div>
          <div class="form__actions">
            <button class="btn" type="submit">Simpan</button>
            <button class="btn btn--ghost" type="reset">Reset</button>
          </div>
        </form>
      </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="section">
      <h2 class="section__title">Tentang CMS</h2>
      <div class="card">
        <p>Template admin responsif berbasis HTML + CSS tanpa JS. 
          Silakan sambungkan form ke PHP (POST/GET) dan isi tabel dengan loop dari database.</p>
        <ul class="list">
          <li>Ganti <code>&lt;form&gt;</code> action ke endpoint PHP kamu</li>
          <li>Isi tabel pakai <code>while($row = ...)</code></li>
          <li>Tambahkan validasi dan keamanan (CSRF, sanitasi input) saat implementasi PHP</li>
        </ul>
      </div>
    </section>

    <footer class="footer">
      <small>Built for Travel Umroh CMS • HTML + CSS</small>
    </footer>
  </main>
</body>
</html>
