<?php
require 'proses/init.php';
$daftarMenu = query("SELECT * FROM menu");

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $daftarMenu = cari($keyword);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
         body {
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        background: linear-gradient(135deg, #8f6ed5, #b8c0ff);
        background-attachment: fixed;
        background-size: cover;
        color: #333;
    }
    .container {
        background: rgba(255, 255, 255, 0.4); /* Efek transparan putih */
        backdrop-filter: blur(10px); /* Efek blur di container */
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        .navbar {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }
        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
        }
        .btn-my-color {
            background: linear-gradient(135deg, #ff6a00, #ee0979);
            border: none;
            color: #fff;
            font-weight: 600;
        }
        .btn-my-color:hover {
            background: linear-gradient(135deg, #ee0979, #ff6a00);
            color: #fff;
        }
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        h1 {
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
        }
        footer {
            background: #ffffff;
            padding: 20px 0;
            margin-top: 50px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 14px;
            color: #aaa;
        }
    </style>

    <title>Pesan-Resto⭐5</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">Resto⭐5</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="keranjang.php" class="btn btn-my-color mr-2">Keranjang</a>
                    <a href="login.php" class="btn btn-light">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col">
                <h1>Explore Our Menu</h1>
                <p class="text-muted">Pilih makanan and minuman favoritmu sekarang jangan sampai ketinggalan!</p>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="input-group shadow-sm">
                        <input type="text" class="form-control" placeholder="Cari menu favoritmu..." name="keyword" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-my-color" type="submit" name="cari">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <?php if (empty($daftarMenu)) : ?>
                <div class="col text-center">
                    <p class="text-danger">Menu tidak ditemukan, yuk cari yang lain!</p>
                </div>
            <?php else : ?>
                <?php foreach ($daftarMenu as $m) : ?>
                    <div class="col-md-3 mb-4 d-flex align-items-stretch">
                        <div class="card">
                            <img src="assets/image/<?= $m['gambar']; ?>" class="card-img-top" alt="<?= $m['nama']; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $m['nama']; ?></h5>
                                <p class="text-muted mb-4"><?= 'Rp ' . number_format($m['harga'], 0, ',', '.'); ?></p>
                                <form action="keranjang.php" method="post">
                                    <input type="hidden" name="id" value="<?= $m['id']; ?>">
                                    <button type="submit" name="pesan" class="btn btn-my-color btn-block">Pesan Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; <?= date('Y'); ?> Resto⭐5. All rights reserved.</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="vendor/Jquery/jquery-3.5.0.min.js"></script>
    <script src="vendor/bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>
