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
    $menu = ambil_data("SELECT * FROM pesanan");
    include "halaman/tabelpesanan.php";
} else if (isset($_GET["makanan"])) {
    $menu = ambil_data("CALL tampilkan_makanan()");
    include "halaman/makanan.php";
}else if (isset($_GET["minuman"])) {
    $menu = ambil_data("CALL tampilkan_minuman()");
    include "halaman/minuman.php";
}else if (isset($_GET["view_harga_diatas20000"])) {
    $menu = ambil_data("SELECT * FROM menu WHERE harga > 20000");
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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pesan"])) {
    $pelanggan = $_POST["pelanggan"];
    $no_meja = $_POST["no_meja"];
    
    $conn = new mysqli("localhost", "root", "", "restoran");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Simpan data pelanggan
    $stmt = $conn->prepare("INSERT INTO pelanggan (nama, no_meja) VALUES (?, ?)");
    $stmt->bind_param("ss", $pelanggan, $no_meja);

    if ($stmt->execute()) {
        $id_pelanggan = $stmt->insert_id;  // Ambil ID pelanggan yang baru disimpan

        // Simpan data pesanan
        $total_items = count($_POST) / 4;  // Jumlah total item yang dipesan
        for ($i = 1; $i <= $total_items; $i++) {
            if (isset($_POST["kode_menu$i"]) && !empty($_POST["jumlah$i"])) {
                $kode_pesanan = uniqid("PESANAN_");  // Buat kode pesanan unik
                $id_menu = $_POST["id_menu$i"];
                $kode_menu = $_POST["kode_menu$i"];
                $jumlah = $_POST["jumlah$i"];

                $stmt2 = $conn->prepare("INSERT INTO pesanan (id_pelanggan, kode_pesanan, id_menu, kode_menu, jumlah) VALUES (?, ?, ?, ?, ?)");
                $stmt2->bind_param("isisi", $id_pelanggan, $kode_pesanan, $id_menu, $kode_menu, $jumlah);

                if (!$stmt2->execute()) {
                    echo "<script>alert('Pesanan Gagal Dikirim!');</script>";
                }
            }
        }
        echo "<script>alert('Pesanan Berhasil Dikirim!');</script>";
    } else {
        echo "<script>alert('Pesanan Gagal Dikirim!');</script>";
    }

    $stmt->close();
    $conn->close();
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
            color: white.
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
            <?php
            if (isset($_SESSION["akun-admin"])) { ?>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/tabelpesanan.php">PESANAN</a></li>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/tabeltransaksi.php">TRANSAKSI</a></li>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/pelanggan.php">PELANGGAN</a></li><br>

                <li><a class="text-decoration-none p-2 h5 text-light">Data Harian</a></li>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/view2.php">Data Pengunjung</a></li>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/view3.php">Data Penjualan</a></li>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/view4.php">Data Pendapatan</a></li>
                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/view5.php">Data Menu Terlaris</a></li><br>

                <li><a class="text-decoration-none p-2 h5 text-light" href="halaman/aktivitas.php">Aktivitas</a></li>
            <?php } ?>

        </ul>
    </div>

    <!-- Content -->
    <div class="container">
        <nav class="navbar navbar-light">
            <form action="index.php" method="GET" class="form-inline d-flex">
                <input class="form-control mx-sm-2" type="search" autocomplete="off" name="key-search" placeholder="Cari..">
                <button class="btn btn-success mx-2" name="search">Search</button>
            </form>
        </nav>
        <?php if (isset($_SESSION["akun-admin"])) { ?>
        <nav class="navbar navbar-light">
            <a class="btn btn-success fw-bold mx-2" href="tambah.php">+ Tambah Menu Masakan</a>
            <a class="btn btn-success fw-bold mx-2" href="index.php?view_harga_diatas20000">Harga di atas 20000</a>
            <a class="btn btn-success fw-bold mx-2" href="halaman/menu_yang_masih_tersedia.php">Daftar Menu Yang Tersedia</a>
            <a class="btn btn-success fw-bold mx-2" href="index.php?makanan">Makanan</a>
            <a class="btn btn-success fw-bold mx-2" href="index.php?minuman">Minuman</a>
        </nav>
        <?php } ?>
        
        <form action="index.php" method="POST"> <!-- Formulir untuk pemesanan -->
            <div class="d-flex">
                <div class="d-flex flex-column">
                    <input class="form-control mx-sm-2 my-2 w-auto" type="text" name="pelanggan" placeholder="Nama Pelanggan" required autocomplete="off">
                    <input class="form-control mx-sm-2 mt-2 w-auto" type="text" name="no_meja" placeholder="Nomor Meja" required autocomplete="off">
                    <button type="submit" class="btn btn-success my-2 mx-2" name="pesan">Pesan</button>
                </div>
            </div>
            <div class="row">
                <?php 
                $i = 1;
                foreach ($menu as $m) { ?>
                    <div class="col-sm-4 mx-auto m-2">
                        <div class="card">
                            <h5 class="card-header bg-info"><?= htmlspecialchars($m["nama"]); ?></h5>
                            <div class="card-body">
                                <p><img class="rounded" src="src/img/<?= htmlspecialchars($m["gambar"]); ?>" width="150"></p>
                                <input type="hidden" name="id_menu<?= $i; ?>" value="<?= htmlspecialchars($m["id_menu"]); ?>">
                                <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= htmlspecialchars($m["kode_menu"]); ?>">
                                <table class="table table-striped table-responsive-sm">
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td class="card-text">Rp<?= htmlspecialchars($m["harga"]); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>:</td>
                                        <td class="card-text"><?= htmlspecialchars($m["kategori"]); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td class="card-text"><?= htmlspecialchars($m["status"]); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td class="card-text"><input min="0" type="number" name="jumlah<?= $i; ?>"></td>
                                    </tr>
                                </table>
                                <?php if (isset($_SESSION["akun-admin"])) { ?>
                                <p>
                                    <a class="btn btn-lg btn-warning" title="Edit" href="edit.php?id_menu=<?= htmlspecialchars($m["id_menu"]); ?>">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a class="btn btn-lg btn-danger" title="Hapus" href="hapus.php?id_menu=<?= htmlspecialchars($m["id_menu"]); ?>" onclick="return confirm('Ingin Menghapus Menu?')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php $i++; } ?>
            </div>
        </form>


        <?php
        // Sisipkan halaman tergantung pada parameter GET yang diterima
        if (isset($_GET["pesanan"])) {
            include "halaman/tabelpesanan.php";
        } else if(isset($_GET["transaksi"])) {
            include "halaman/tabeltransaksi.php";
        } else if(isset($GET["pelanggan"])) {
           include "halaman/tabelpelanggan.php";
        }
        ?>

    </div>
    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>
    <script src="src/js/beranda.js"></script>
</body>
</html>

