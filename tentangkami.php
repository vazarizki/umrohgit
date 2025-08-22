<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Taman Wisata Surga</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<style>
    body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #ffffff;
    color: #333333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.about-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #ffffff 60%, #ff6200 100%);
}

.section-title {
    font-size: 2.5rem;
    color: #000000;
    text-align: center;
    margin-bottom: 40px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.about-content {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

.intro-text {
    font-size: 1.2rem;
    font-weight: 400;
    color: #333333;
    margin-bottom: 20px;
}

.about-content p {
    font-size: 1rem;
    color: #555555;
}

.vision-mission {
    margin-bottom: 40px;
}

.vision-mission h2 {
    font-size: 2rem;
    color: #000000;
    text-align: center;
    margin-bottom: 30px;
}

.vision-mission-content {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
}

.vision, .mission {
    flex: 1;
    background-color: #000000;
    color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    min-width: 300px;
    transition: transform 0.3s ease;
}

.vision:hover, .mission:hover {
    transform: translateY(-5px);
}

.vision h3, .mission h3 {
    font-size: 1.5rem;
    color: #ff6200;
    margin-bottom: 15px;
}

.contact-info {
    text-align: center;
    background-color: #ff6200;
    color: #ffffff;
    padding: 30px;
    border-radius: 10px;
}

.contact-info h2 {
    font-size: 1.8rem;
    margin-bottom: 20px;
}

.contact-info p {
    font-size: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }

    .about-content {
        padding: 20px;
    }

    .vision-mission-content {
        flex-direction: column;
    }

    .vision, .mission {
        min-width: 100%;
    }

    .contact-info {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 1.8rem;
    }

    .about-content {
        padding: 15px;
    }

    .vision-mission h2 {
        font-size: 1.5rem;
    }

    .contact-info h2 {
        font-size: 1.3rem;
    }
}
</style>

<body>

<!--header -->
<?php include "view/header.php"; ?>


    <section class="about-section">
        <div class="container">
            <h1 class="section-title">Tentang Kami</h1>
            <div class="about-content">
                <p class="intro-text">
                    Taman Wisata Surga adalah perusahaan penyedia jasa perjalanan ibadah Umroh dan Haji yang berdiri dengan komitmen memberikan pelayanan terbaik, aman, nyaman, dan terpercaya serta memberikan pelayanan yang terbaik dengan segala fasilitas dan kemudahan bagi para tamu Allah.
                </p>
                <p>
                    Dengan pengalaman, keahlian, dan dedikasi tinggi, kami hadir untuk mempermudah <strong>"Jalanmu Menuju Baitullah"</strong> untuk melaksanakan ibadah di Tanah Suci.
                </p>
            </div>

            <div class="vision-mission">
                <h2>Visi dan Misi</h2>
                <div class="vision-mission-content">
                    <div class="vision">
                        <h3>Visi</h3>
                        <p>Menjadi penyedia jasa perjalanan ibadah yang terpercaya, profesional, dan mengutamakan kepuasan, kenyamanan, serta keselamatan para jamaah dalam perjalanan spiritualnya.</p>
                    </div>
                    <div class="mission">
                        <h3>Misi</h3>
                        <p>Menghadirkan layanan ibadah yang mudah, terjangkau, dan bermakna sehingga setiap jamaah dapat beribadah dengan khusyuk tanpa khawatir urusan teknis.</p>
                    </div>
                </div>
            </div>

            <div class="contact-info">
                <h2>Alamat Kantor</h2>
                <p>Jalan Syech Quro, Krajan, Ruko Grand Palumbon Sari, Nomor RT. 002 RW. 009 Palumbonsari, Karawang Timur Kabupaten Karawang</p>
            </div>
        </div>
    </section>

<?php include "view/footer.php"; ?>
</body>
</html>