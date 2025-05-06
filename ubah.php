<?php
require 'proses/init.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['is_login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$menu = query("SELECT * FROM menu WHERE id=$id")[0];
$kategori = query("SELECT kategori FROM kategori");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah - Resto⭐5</title>

    <!-- Bootstrap CSS 5 -->
    <link rel="stylesheet" href="vendor/bootstrap5/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- My Style -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #dbe9f4, #f3f6fb);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #1e3a8a;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
        }

        .navbar-nav .nav-link {
            color: white;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-header {
            background-color: #1e3a8a;
            color: white;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #94a3b8;
            padding: 12px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.4);
        }

        .custom-select,
        .custom-file-label {
            border-radius: 8px;
            border: 1px solid #94a3b8;
            font-size: 16px;
        }

        .custom-file-label {
            background-color: #f1f5f9;
        }

        .btn-my-color {
            background-color: #2563eb;
            color: white;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-my-color:hover {
            background-color: #1e40af;
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: #64748b;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #475569;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">Resto⭐5</a>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card bg-light">
                    <div class="card-header text-center">
                        <h4>Form Ubah Data Menu</h4>
                    </div>
                    <div class="card-body">
                        <form action="proses/ubah_proses.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                            <input type="hidden" name="gambarHidden" value="<?= $menu['gambar']; ?>">

                            <div class="form-group">
                                <label for="nama">Nama Menu</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $menu['nama']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $menu['harga']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="custom-select" id="kategori" name="kategori" required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['kategori']; ?>" <?= $menu['kategori'] == $k['kategori'] ? 'selected' : ''; ?>>
                                            <?= $k['kategori']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar Menu</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar"><?= $menu['gambar']; ?></label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="index.php" class="btn btn-back">Kembali</a>
                                <button type="submit" name="ubah" class="btn btn-my-color">Ubah Data Menu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="vendor/Jquery/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap JS 5 -->
    <script src="vendor/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script src="assets/js/script.js"></script>
</body>

</html>
