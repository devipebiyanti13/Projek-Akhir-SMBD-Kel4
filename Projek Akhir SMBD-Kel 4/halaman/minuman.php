<?php
// Memanggil session_start() hanya jika belum aktif
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Menggunakan __DIR__ untuk path absolut
require_once __DIR__ . "/../function.php";

if (!isset($_SESSION["akun-admin"])) {
    header("Location: login.php"); 
    exit;
}

$koneksi = mysqli_connect("localhost", "root", "", "restoran");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$result = $koneksi->query("CALL tampilkan_minuman()");

if (!$result) {
    die("Error executing stored procedure: " . $koneksi->error);
}

$menu = [];
while ($row = $result->fetch_assoc()) {
    $menu[] = $row;
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu Makanan di Atas 20000</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        <style>
        body {
            background-image: url('..src/img/background2.jpg');
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .card-body img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .btn-group {
            margin-top: 10px;
        }

        .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #ffca2c;
            border-color: #ffca2c;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #e74a5a;
            border-color: #e74a5a;
        }
    </style>
</head>
<body>
<!-- Menu Masakan -->
<div class="row">
        
</div>
</body>
</html>
