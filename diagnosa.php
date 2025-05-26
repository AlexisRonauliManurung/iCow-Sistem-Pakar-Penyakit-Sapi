<?php
session_start();
include 'data_gejala.php';
include 'data_penyakit.php';
include 'koneksi.php';

// Fungsi untuk menampilkan hasil diagnosa
function show_result() {
    global $penyakit, $gejala, $solusi, $koneksi;
    
    $gejala_input = $_SESSION['gejala_terpilih'] ?? [];
    $hasil = [];
    
    // Hitung kecocokan dengan semua penyakit
    foreach ($penyakit as $nama => $aturan) {
        $intersect = array_intersect($aturan, $gejala_input);
        $match = count($intersect);
        $total = count($aturan);
        $persentase = round(($match / $total) * 100);
        
        if ($persentase >= 70) {  // Ambil penyakit dengan kecocokan >70%
            $hasil[$nama] = $persentase;
        }
    }
    
    arsort($hasil);
    $gejala_terpilih = implode(", ", array_map(function($g) use ($gejala) {
        return $gejala[$g] ?? $g;
    }, $gejala_input));
    
    // Simpan ke database jika ada hasil
    if (!empty($hasil)) {
        $top = array_key_first($hasil);
        $persen = $hasil[$top];
        $gejala_esc = mysqli_real_escape_string($koneksi, $gejala_terpilih);
        $penyakit_esc = mysqli_real_escape_string($koneksi, $top);
        mysqli_query($koneksi, "INSERT INTO hasil_diagnosa (gejala_terpilih, penyakit, persentase)
            VALUES ('$gejala_esc', '$penyakit_esc', $persen)");
    }
    
    // Tampilkan hasil
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Hasil Diagnosa</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="h4">Hasil Diagnosa</h1>
            </div>
            <div class="card-body">
                <?php if (empty($hasil)): ?>
                    <div class="alert alert-warning">
                        <strong>Kesimpulan:</strong> Berdasarkan gejala yang dipilih, sapi tidak terdeteksi mengidap penyakit tertentu.
                    </div>
                <?php else: ?>
                    <div class="mb-4">
                        <h2 class="h5 text-primary">Penyakit Utama Terdeteksi</h2>
                        <div class="alert alert-success">
                            <p><strong>Penyakit:</strong> <?= htmlspecialchars($top) ?></p>
                            <p><strong>Persentase Kecocokan:</strong> <?= $persen ?>%</p>
                            <p><strong>Solusi Penanganan:</strong> <?= htmlspecialchars($solusi[$top] ?? 'Tidak tersedia') ?></p>
                        </div>
                    </div>
                    
                    <?php if (count($hasil) > 1): ?>
                        <div class="mb-4">
                            <h3 class="h5 text-primary">Penyakit Lain Yang Mungkin:</h3>
                            <ul class="list-group">
                                <?php foreach($hasil as $nama => $persen): ?>
                                    <?php if ($nama != $top): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= htmlspecialchars($nama) ?>
                                            <span class="badge bg-primary rounded-pill"><?= $persen ?>%</span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <div class="mt-4">
                    <a href="index.php" class="btn btn-primary me-2">Kembali ke Beranda</a>
                    <a href="diagnosa.php" class="btn btn-outline-primary">Diagnosa Baru</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    session_destroy();
}

$penyakit_keys = array_keys($penyakit);

// Jika belum mulai diagnosa
if (!isset($_SESSION['mulai'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mulai'])) {
        $_SESSION['mulai'] = true;
        $_SESSION['index_penyakit'] = 0;
        $_SESSION['index_gejala'] = 0;
        $_SESSION['gejala_terpilih'] = [];
        header("Location: diagnosa.php");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Mulai Diagnosa</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container mt-5">
        <div class="card shadow text-center">
            <div class="card-header bg-primary text-white">
                <h1 class="h4">Sistem Pakar Diagnosa Penyakit Sapi</h1>
            </div>
            <div class="card-body">
                <p class="lead">Sistem akan menanyakan beberapa gejala untuk mendiagnosa penyakit pada sapi Anda.</p>
                <form method="POST" class="mt-4">
                    <button type="submit" name="mulai" class="btn btn-primary btn-lg">Mulai Diagnosa</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Proses jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jawaban'])) {
    $jawaban = $_POST['jawaban'] ?? '';
    $penyakit_skrg = $penyakit_keys[$_SESSION['index_penyakit']];
    $gejala_list = $penyakit[$penyakit_skrg];
    $gejala_skrg = $gejala_list[$_SESSION['index_gejala']];

    if ($jawaban === 'ya') {
        $_SESSION['gejala_terpilih'][] = $gejala_skrg;

        $intersect = array_intersect($gejala_list, $_SESSION['gejala_terpilih']);
        if (count($intersect) === count($gejala_list)) {
            show_result();
            exit;
        }

        $_SESSION['index_gejala']++; 
    } else {
        if ($_SESSION['index_gejala'] === 0) {
            $_SESSION['index_penyakit']++;
            $_SESSION['index_gejala'] = 0;
        } else {
            $_SESSION['index_gejala']++;
        }
    }

    if ($_SESSION['index_gejala'] >= count($gejala_list)) {
        $_SESSION['index_penyakit']++;
        $_SESSION['index_gejala'] = 0;
    }
}


// Tampilkan pertanyaan berikutnya
if ($_SESSION['index_penyakit'] < count($penyakit_keys)) {
    $penyakit_skrg = $penyakit_keys[$_SESSION['index_penyakit']];
    $gejala_list = $penyakit[$penyakit_skrg];

    if ($_SESSION['index_gejala'] < count($gejala_list)) {
        $gejala_kode = $gejala_list[$_SESSION['index_gejala']];
        $pertanyaan = $gejala[$gejala_kode];
        $progress = round((($_SESSION['index_penyakit'] * 100) / count($penyakit_keys)));
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Pertanyaan Gejala</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="style.css">
        </head>
        <body class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Pertanyaan Diagnosa</span>
                    <span><?= $progress ?>%</span>
                </div>
                <div class="card-body">
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?= $progress ?>%" 
                             aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    
                    <h2 class="h5">Apakah sapi mengalami gejala berikut?</h2>
                    <p class="lead bg-light p-3 rounded"><?= htmlspecialchars($pertanyaan) ?></p>
                    
                    <form method="POST" class="mt-4 d-flex justify-content-between">
                        <button type="submit" name="jawaban" value="tidak" class="btn btn-danger btn-lg">Tidak</button>
                        <button type="submit" name="jawaban" value="ya" class="btn btn-success btn-lg">Ya</button>
                    </form>
                    
                    <div class="mt-4">
                        <a href="diagnosa.php?reset=1" class="btn btn-outline-secondary">Ulangi Diagnosa</a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Jika semua pertanyaan sudah selesai
show_result();
?>