<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 320px;
            margin: auto;
            padding: 30px;
            background: #f9f9f9;
            border: 2px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            color: #333;
        }

        h2 {
            font-size: 24px;
            color: #6c5ce7;
            margin-bottom: 5px;
        }

        p {
            font-size: 16px;
            margin: 5px 0;
            color: #777;
        }

        .line {
            border-top: 1px dashed #aaa;
            margin: 20px 0;
        }

        .item {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin: 6px 0;
        }

        .highlight {
            font-weight: bold;
            color: #2d3436;
        }

        .thankyou {
            text-align: center;
            font-style: italic;
            margin-top: 30px;
            font-size: 14px;
            color: #6c5ce7;
        }

        .qr {
            text-align: center;
            margin-top: 20px;
        }

        .qr img {
            width: 100px;
            opacity: 0.6;
        }

        @media print {
            body {
                border: none;
                margin: 0;
                box-shadow: none;
                background: white;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <h2 style="text-align: center;">Resto⭐5</h2>
    <p style="text-align: center;">Struk Pembayaran #<?= strtoupper(substr(md5(time()), 0, 6)); ?></p>
    <div class="line"></div>

    <div class="item">
        <span>Total:</span>
        <span class="highlight">Rp <?= number_format($_SESSION['total'], 2, ',', '.'); ?></span>
    </div>
    <div class="item">
        <span>Bayar:</span>
        <span class="highlight">Rp <?= number_format($_SESSION['bayar'], 2, ',', '.'); ?></span>
    </div>
    <div class="item">
        <span>Kembali:</span>
        <span class="highlight">Rp <?= number_format($_SESSION['kembali'], 2, ',', '.'); ?></span>
    </div>

    <div class="line"></div>

    <div class="qr">
        <img src="https://api.qrserver.com/v1/create-qr-code/?data=Terima+Kasih+dari+Restomenu&size=100x100" alt="QR Code">
        <p style="font-size: 12px; color: #aaa;">Scan untuk promo spesial dan menarik!</p>
    </div>

    <div class="thankyou">
        Terima kasih telah berkunjung ke Resto⭐5 guys! 🍽️<br>
        Semoga harimu menyenangkan guys!
    </div>
</body>
</html>
