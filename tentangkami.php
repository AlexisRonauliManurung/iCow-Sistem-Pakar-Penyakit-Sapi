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

      /* Animasi saat load */
      .animate-img, .animate-text {
        opacity: 0;
        transform: scale(0.95);
        transition: opacity 1s ease, transform 1s ease;
      }

      .animate-img.show, .animate-text.show {
        opacity: 1;
        transform: scale(1);
      }

      /* Efek hover pada gambar */
      .animate-img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(246, 151, 89, 0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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
              <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="diagnosa.php">Diagnosa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tentang Kami</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Tentang Saya - Bagian 1 -->
    <div class="container mt-5">
      <div class="row align-items-center">
        <div class="col-md-5 text-center">
          <img src="Eci.jpg" alt="Foto Saya" class="rounded-circle animate-img" width="220" height="220" style="object-fit: cover; border: 4px solid #f69759;">
        </div>
        <div class="col-md-7 animate-text">
          <h2 class="mb-4 text-md-start text-center">Alexis Ronauli Manurung <br> 2215061109</h2>
          <p class="fs-5 text-justify" style="text-align: justify;">
          Mahasiswa yang berkuliah di <strong>Universitas Lampung</strong> dengan program studi Teknik Informatika angkatan 2022. iCow ini merupakan kualifikasi untuk nilai Ujian Tengah Semester mata kuliah Sistem Pakar. Hobi bermain gitar dan piano sambil bernyanyi, main game Valo, Roblox, dan game viral (iya saya fomo) lainnya.
          </p>
        </div>
      </div>
    </div>

    <!-- Tentang Saya - Bagian 2 -->
    <div class="container mt-5">
      <div class="row align-items-center">
        <div class="col-md-7 animate-text">
          <h2 class="mb-4 text-md-end text-center">Mohammad Malvin Rafi <br> 2215061074 </h2>
          <p class="fs-5 text-justify" style="text-align: justify;">
            Hai! Saya adalah pengembang dari sistem pakar <strong>iCow</strong>. Dengan latar belakang teknologi dan ketertarikan terhadap dunia peternakan, saya ingin menciptakan solusi digital yang bermanfaat dan praktis. Harapan saya, iCow bisa menjadi teman setia peternak dalam merawat sapi-sapinya. Terus semangat dan jangan ragu pakai iCow ya!
          </p>
        </div>
        <div class="col-md-5 text-center">
          <img src="rajamewing.jpg" alt="Foto Saya" class="rounded-circle animate-img" width="220" height="220" style="object-fit: cover; border: 4px solid #f69759;">
        </div>
      </div>
    </div>

    <!-- Script Bootstrap dan animasi -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const items = document.querySelectorAll(".animate-img, .animate-text");
        items.forEach(item => {
          setTimeout(() => {
            item.classList.add("show");
          }, 200);
        });
      });
    </script>
  </body>
</html>
