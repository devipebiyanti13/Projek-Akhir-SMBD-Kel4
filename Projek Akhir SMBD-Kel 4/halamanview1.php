<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"]) && !isset($_SESSION["akun-user"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["transaksi"])) {
    $menu = ambil_data("SELECT * FROM transaksi");
} else if (isset($_GET["pesanan"])) {
    $menu = ambil_data("SELECT p.kode_pesanan, tk.nama_pelanggan, p.kode_menu, p.jumlah
                        FROM pesanan AS p
                        JOIN transaksi AS tk ON (tk.kode_pesanan = p.kode_pesanan)
                      ");
} else if (isset($_GET["view_harga_diatas20000"])) {
    $menu = ambil_data("CREATE VIEW view_harga_diatas20000 AS
                        SELECT nama, gambar, harga, kategori, STATUS, id_menu
                        FROM menu
                        WHERE harga > 20000;");
} else {
    if (!isset($_GET["search"])) {
        $menu = ambil_data("SELECT * FROM menu ORDER BY kode_menu DESC");
    } else {
        $key_search = $_GET["key-search"];
        $menu = ambil_data("SELECT * FROM menu WHERE nama LIKE '%$key_search%' OR
                                                    harga LIKE '%$key_search%' OR
                                                    kategori LIKE '%$key_search%' OR
                                                    `status` LIKE '%$key_search%'
                                                    ORDER BY kode_menu DESC
        ");
    }
}


if (isset($_POST["pesan"])) {
    $pesanan = tambah_data_pesanan();
    echo $pesanan > 0
    ? "<script>
        alert('Pesanan Berhasil Dikirim!');
    </script>"
    : "<script>
        alert('Pesanan Gagal Dikirim!');
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/bootstrap-icons-1.8.3/bootstrap-icons.css">
    <title>Beranda</title>
    <style>
        body {
            background-image: url('src/img/background2.jpg');
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        .container-fluid.position-fixed.top-0 {
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        .container-fluid.position-fixed.top-0 .text-white.h3 {
            display: flex;
            align-items: center;
        }

        .container-fluid.position-fixed.top-0 .btn {
            transition: background-color 0.3s, color 0.3s;
        }

        .container-fluid.position-fixed.top-0 .btn:hover {
            background-color: #dc3545;
            color: #fff;
        }

        #dropdown-menu {
            display: none;
            z-index: 999;
            top: 60px;
            background-color: rgba(0, 0, 0, 0.9);
        }

        #dropdown-menu ul {
            list-style: none;
            padding: 0;
        }

        #dropdown-menu ul li a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
        }

        #dropdown-menu ul li a:hover {
            background-color: #007bff;
            color: white;
        }

        .container {
            margin-top: 80px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header -->
    <div class="container-fluid position-fixed top-0 bg-dark p-2 d-flex justify-content-between">
        <div class="text-white h3 d-flex">
            <span id="menu-list" role="button"><i class="bi bi-list"></i></span>
            <span class="mx-3">Restoran</span>
        </div>
        <a class="btn btn-danger fw-bold" href="logout.php" onclick="return confirm('Ingin Logout?')">Logout</a>
    </div>
    <!-- List Menu -->
    <div id="dropdown-menu" class="container-fluid position-fixed float-start bg-dark text-white w-auto vh-100">
        <ul>
            <br>
            <li><a class="text-decoration-none p-2 h5 text-light" href="index.php">MENU</a></li><br>
            <?php if (isset($_SESSION["akun-admin"])) { ?>
            <li><a class="text-decoration-none p-2 h5 text-light" href="index.php?pesanan">PESANAN</a></li><br>
            <li><a class="text-decoration-none p-2 h5 text-light" href="index.php?transaksi">TRANSAKSI</a></li>
            <?php } ?>
        </ul>
    </div>

    <!-- Content -->
    <div class="container">
    <?php
    if (isset($_GET["pesanan"])) include "halaman/pesanan.php";
    else if (isset($_GET["transaksi"])) include "halaman/transaksi.php";
    else include "view/view_harga_diatas20000.php";
    ?>
    </div>
    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>
    <script src="src/js/beranda.js"></script>
</body>
</html>
