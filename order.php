<!DOCTYPE html>
<html>
<head>
    <title>Penyimpanan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #287094;
        }
        
        h1 {
            color: #333;
        }
        
        .pesan {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f7f7f7;
            border-radius: 5px;
        }
        
        .pesan h3 {
            margin-top: 0;
            color: #333;
        }
        
        .pesan p {
            margin-bottom: 5px;
        }
        
        .pesan span {
            font-weight: bold;
        }
        
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mendapatkan data pesanan dari form
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];

        // Membuat format pesanan
        $order = "Kode: " . $kode . ", Nama: " . $nama . ", Email: " . $email . "\n";

        // Menyimpan pesanan dalam file .txt
        $file = 'pesanan.txt';
        file_put_contents($file, $order, FILE_APPEND | LOCK_EX);

        echo "<div class='pesan'>";
        echo "<h3>Terima kasih, pesanan Anda telah diterima!</h3>";
        echo "<p>Detail pesanan:</p>";
        echo "<p><span>Kode:</span> " . $kode . "</p>";
        echo "<p><span>Nama:</span> " . $nama . "</p>";
        echo "<p><span>Email:</span> " . $email . "</p>";
        echo "</div>";
    } else {
        echo "<div class='error'>Terjadi kesalahan dalam pengiriman pesanan.</div>";
    }

    // Membaca isi file pesanan.txt
    $file = 'pesanan.txt';
    if (file_exists($file)) {
        $pesanan = file_get_contents($file);
        if (!empty($pesanan)) {
            echo "<h1>Pesanan yang telah diterima:</h1>";
            echo "<div class='pesan'>";
            echo nl2br($pesanan);
            echo "</div>";
        } else {
            echo "<div class='error'>Belum ada pesanan yang diterima.</div>";
        }
    } else {
        echo "<div class='error'>Belum ada pesanan yang diterima.</div>";
    }
    ?>
</body>
</html>
