<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iCow - Sistem Pakar Sapi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #fff6f1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding-top: 80px;
      }

      .navbar-custom {
        background-color: #f69759;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }

      .navbar-nav .nav-link {
        color: white !important;
        font-weight: 500;
        transition: color 0.3s;
      }

      .navbar-nav .nav-link:hover {
        color: #ffe5d0 !important;
      }

      .hero {
        text-align: center;
        padding: 60px 20px;
        background-color: #ffe3d0;
        border-radius: 312px;
        margin: 30px auto;
        max-width: 800px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      }

      .hero h1 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 20px;
      }

      .hero p {
        font-size: 1.2rem;
        color: #555;
      }

      .cow-gallery {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px auto;
        flex-wrap: wrap;
      }

      .cow-gallery img {
        width: 250px;
        height: 180px;
        object-fit: cover;
        border-radius: 20px;
        border: 4px solid #f69759;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
      }

      .cow-gallery img:hover {
        transform: scale(1.05);
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="icow_logo.png" alt="iCow Logo" width="75" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="diagnosa.php">Diagnosa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tentangkami.php">Tentang Kami</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="hero">
        <h1>Selamat Datang di iCow</h1>
        <p>Sistem Pakar Diagnosis Penyakit Sapi Berbasis Web</p>
      </div>

      <div class="cow-gallery">
        <img src="sapi 1.jpeg" alt="Sapi 1">
        <img src="sapi 2.jpg" alt="Sapi 2">
        <img src="sapi 3.webp" alt="Sapi 3">
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
