<?php
require 'proses/init.php';

$total = 0;
$kembali = 0;
$bayar = 0;

// Reset keranjang
if (isset($_POST['reset'])) {
    unset($_SESSION['pesan_cart']);
    header("Location: pesan.php");
    exit;
}

// Proses checkout
if (isset($_POST['checkout'])) {
    $_SESSION['total'] = $_POST['total'];
    $_SESSION['bayar'] = $_POST['bayar'];
    $_SESSION['kembali'] = $_POST['bayar'] - $_POST['total'];
    header("Location: nota.php");
    exit;
}

// Hapus item dari keranjang
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['pesan_cart'] as $cart => $values) {
        if ($values['item_id'] == $id) {
            unset($_SESSION['pesan_cart'][$cart]);
        }
    }
}

// Tambah ke keranjang
if (isset($_POST['pesan'])) {
    if (isset($_SESSION['pesan_cart'])) {
        $item_pesan_id = array_column($_SESSION['pesan_cart'], "item_id");
        if (!in_array($_POST['id'], $item_pesan_id)) {
            $count = count($_SESSION['pesan_cart']);
            $item_pesan = ['item_id' => $_POST['id']];
            $_SESSION['pesan_cart'][$count] = $item_pesan;
        } else {
            tampilAlert("Menu tersebut sudah ada di keranjang", 'pesan.php');
        }
    } else {
        $item_pesan = ['item_id' => $_POST['id']];
        $_SESSION['pesan_cart'][0] = $item_pesan;
    }

    header("Location: pesan.php");
    exit;
}

// Ambil isi keranjang
$carts = [];
if (isset($_SESSION['pesan_cart'])) {
    foreach ($_SESSION['pesan_cart'] as $item) {
        $menuId = $item['item_id'];
        $menu = query("SELECT * FROM menu WHERE id = $menuId");
        if ($menu) {
            $carts[] = $menu[0];
        }
    }
}

// Hitung total
foreach ($carts as $cart) {
    $total += $cart['harga'];
}

// Hitung kembalian
if (isset($_POST['bayar'])) {
    $bayar = $_POST['bayar'];
    $kembali = $bayar - $total;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Resto⭐5</title>

    <link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        background: linear-gradient(135deg, #8f6ed5, #b8c0ff);
        background-attachment: fixed;
        background-size: cover;
        color: #333;
    }
    .navbar {
        background: linear-gradient(90deg, #7f00ff, #00c6ff);
        border-radius: 0 0 20px 20px;
        padding: 10px 20px;
    }
    .navbar-brand {
        color: white;
        font-weight: bold;
        font-size: 24px;
    }
    .nav-link.btn {
        margin-left: 10px;
        font-weight: 500;
        border-radius: 8px;
        padding: 6px 16px;
    }
    .btn-pesan {
        background: linear-gradient(90deg, #ff6a00, #ee0979);
        color: white;
        border: none;
    }
    .btn-pesan:hover {
        background: linear-gradient(90deg, #ee0979, #ff6a00);
        color: white;
    }
    .btn-login {
        background: #007bff;
        color: white;
        border: none;
    }
    .btn-login:hover {
        background: #0056b3;
        color: white;
    }
    .main {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 20px;
        margin-top: 50px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .table th {
        background: linear-gradient(90deg, #7f00ff, #00c6ff);
        color: white;
        text-align: center;
    }
    .table td {
        text-align: center;
        vertical-align: middle;
        background-color: rgba(255, 255, 255, 0.5);
    }
    .btn-my-color {
        background: linear-gradient(90deg, #7f00ff, #00c6ff);
        color: white;
        border: none;
    }
    .btn-my-color:hover {
        background: linear-gradient(90deg, #00c6ff, #7f00ff);
        color: white;
    }
    .btn-danger {
        background: #ff4b5c;
        border: none;
    }
    .btn-danger:hover {
        background: #e60023;
        color: white;
    }
    .card {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    footer {
        text-align: center;
        font-size: 14px;
        margin-top: 50px;
        color: #888;
    }
    </style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="pesan.php">Resto⭐5</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navCollapse">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link btn btn-pesan btn-sm" href="pesan.php">Pesan</a>
                <a class="nav-item nav-link btn btn-login btn-sm" href="login.php">Login</a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container main">
    <h1 class="text-center mb-4">Keranjang Anda</h1>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (isset($carts) && count($carts) > 0): ?>
                        <?php foreach ($carts as $cart): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $cart['nama']; ?></td>
                                <td><?= $cart['kategori']; ?></td>
                                <td><?= 'Rp ' . number_format($cart['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="?id=<?= $cart['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Keranjang Anda kosong.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="card">
                <h4>Total Pembayaran</h4>
                <ul class="list-group">
                    <li class="list-group-item">Total: <span class="float-right">Rp <?= number_format($total, 0, ',', '.'); ?></span></li>
                    <li class="list-group-item">
                        Bayar:
                        <form action="" method="post" class="input-group">
                            <input type="number" class="form-control" name="bayar" autocomplete="off" required>
                            <div class="input-group-append">
                                <button class="btn btn-my-color" type="submit" name="refreshKembali">→</button>
                            </div>
                        </form>
                    </li>
                    <?php if (isset($bayar) && $bayar > 0): ?>
                        <li class="list-group-item">Kembalian: <span class="float-right">Rp <?= number_format($kembali, 0, ',', '.'); ?></span></li>
                    <?php endif; ?>
                </ul>

                <form action="" method="post">
                    <input type="hidden" name="total" value="<?= $total; ?>">
                    <input type="hidden" name="bayar" value="<?= $bayar; ?>">
                    <button type="submit" name="checkout" class="btn btn-my-color btn-block mt-3">Bayar / Pesan</button>
                </form>

                <form action="" method="post" class="mt-3">
                    <button type="submit" name="reset" class="btn btn-danger btn-block">Reset Keranjang</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
