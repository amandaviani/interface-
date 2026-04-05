<?php
require_once 'TransferBank.php';
require_once 'EWallet.php';
require_once 'QRIS.php';
require_once 'COD.php';
require_once 'VirtualAccount.php';

// ✅ FIX: inisialisasi variabel biar ga error
$hasil_proses = "";
$hasil_struk = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nominal = $_POST['nominal'];
    $metode = $_POST['metode'];

    $pembayaran = null;

    if ($metode == "TransferBank") {
        $pembayaran = new TransferBank($nominal);
    } elseif ($metode == "EWallet") {
        $pembayaran = new EWallet($nominal);
    } elseif ($metode == "QRIS") {
        $pembayaran = new QRIS($nominal);
    } elseif ($metode == "COD") {
        $pembayaran = new COD($nominal);
    } elseif ($metode == "VirtualAccount") {
        $pembayaran = new VirtualAccount($nominal);
    }

    if ($pembayaran != null) {
        $hasil_proses = $pembayaran->prosesPembayaran();
        $hasil_struk = $pembayaran->cetakStruk();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir Pembayaran</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #ffe6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(255, 105, 180, 0.3);
        }

        h2 {
            text-align: center;
            color: #ff4da6;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ff4da6;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #e60073;
        }

        .struk {
            margin-top: 20px;
            background: #fff0f5;
            padding: 15px;
            border-radius: 10px;
            border: 1px dashed #ff99cc;
        }

        .struk h3 {
            text-align: center;
            color: #ff4da6;
        }

        .line {
            border-top: 1px dashed #ccc;
            margin: 10px 0;
        }

        .center {
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>💳 Kasir Pembayaran</h2>

    <form method="POST" action="">
        <label>Nominal (Rp):</label>
        <input type="number" name="nominal" min="1" required>

        <label>Metode:</label>
        <select name="metode" required>
            <option value="" disabled selected>-- Pilih Metode --</option>
            <option value="TransferBank">Transfer Bank</option>
            <option value="EWallet">E-Wallet</option>
            <option value="QRIS">QRIS</option>
            <option value="COD">COD</option>
            <option value="VirtualAccount">Virtual Account</option>
        </select>

        <button type="submit">💖 Bayar Sekarang</button>
    </form>

    <!-- ✅ FIX: pakai !empty biar aman -->
    <?php if (!empty($hasil_proses)): ?>
        <div class="struk">
            <h3>🧾 STRUK PEMBAYARAN</h3>

            <div class="line"></div>

            <p><strong>Status:</strong><br><?= $hasil_proses ?></p>

            <div class="line"></div>

            <p><?= $hasil_struk ?></p>

            <div class="line"></div>

            <p class="center">Terima kasih 💕</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>