<?php
require 'proses/init.php';
$daftarMenu = query("SELECT * FROM menu");

if (!isset($_SESSION['is_login'])) {
    header("Location: pesan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Resto⭐5</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- My Style -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .main {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            margin-top: 50px;
            box-shadow: 0px 15px 30px rgba(0,0,0,0.2);
        }
        h1 {
            font-size: 36px;
            font-weight: 700;
            color: #6c5ce7;
        }
        .navbar {
            background: #fff;
            padding: 15px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #6c5ce7;
        }
        .btn-my-color {
            background-color: #6c5ce7;
            color: #fff;
            border-radius: 25px;
            padding: 10px 25px;
            transition: 0.3s;
        }
        .btn-my-color:hover {
            background-color: #5a4bcf;
            transform: translateY(-3px);
        }
        .table {
            background: #fff;
            color: #333;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }
        .table th {
            background: #6c5ce7;
            color: #fff;
            text-align: center;
        }
        .menu-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            transition: 0.3s;
        }
        .menu-image:hover {
            transform: scale(1.05);
        }
        .search-bar {
            border-radius: 30px;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="pesan.php">🍽️ Resto⭐5</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navCollapse">
            <div class="navbar-nav ms-auto">
                <a class="nav-item nav-link btn btn-my-color btn-sm text-white me-2" href="pesan.php">
                    <i class="fa-solid fa-cart-shopping"></i> Pesan
                </a>
                <a href="proses/logout_proses.php" class="nav-item nav-link btn btn-danger btn-sm text-white">
                    <i class="fa-solid fa-right-from-bracket"></i> Log out
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container main">
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>📜 Daftar Menu</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="tambah.php" class="btn btn-my-color">
                <i class="fa-solid fa-plus"></i> Tambah Menu
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="row mb-3">
        <div class="col-md-5">
            <input type="text" class="form-control search-bar" id="searchInput" placeholder="🔍 Cari menu..">
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="menuTable">
                    <?php if (empty($daftarMenu)) : ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger p-4">❌ Tidak ada menu tersedia</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($daftarMenu as $m) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($m['nama']); ?></td>
                            <td><?= htmlspecialchars($m['kategori']); ?></td>
                            <td><?= 'Rp ' . number_format($m['harga'], 0, ',', '.'); ?></td>
                            <td><img src="assets/image/<?= htmlspecialchars($m['gambar']); ?>" class="menu-image"></td>
                            <td>
                                <a href="ubah.php?id=<?= $m['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <a href="proses/hapus_proses.php?id=<?= $m['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah kamu yakin?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#menuTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

</body>
</html>
