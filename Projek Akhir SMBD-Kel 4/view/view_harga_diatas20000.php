<?php
session_start(); 

require_once "../function.php";

if (!isset($_SESSION["akun-admin"])) {
    header("Location: login.php"); 
    exit;
}

$koneksi = mysqli_connect("localhost", "root", "", "pwl_kasir_restoran");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk menampilkan view menu dengan harga di atas 20000
$query = "SELECT * FROM view_harga_diatas20000";
// $result = mysqli_query($conn, $query);
// while ($row = mysqli_fetch_assoc($result)) {
//     echo '<img src="src/img/' . $row["gambar"] . '" width="150">';
// }

$data = ambil_data($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu Makanan di Atas 20000</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <div class="container">
        <h1 class="text-center mb-4">Daftar Menu Makanan dengan Harga di Atas 20000</h1>
        <div class="row">
            <?php foreach ($data as $m) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <h5 class="card-header"><?= $m["nama"]; ?></h5>
                        <div class="card-body">
                        <p><img class="rounded" src="../src/img/<?= htmlspecialchars($m["gambar"]); ?>" width="150"></p>
                        <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= htmlspecialchars($m["kode_menu"]); ?>">
                        <table class="table table-striped table-responsive-sm">

                            <tr>

                                <td>Harga</td>

                                <td>:</td>

                                <td class="card-text">Rp<?= $m["harga"]; ?></td>

                            </tr>

                            <tr>

                                <td>Kategori</td>

                                <td>:</td>

                                <td class="card-text"><?= $m["kategori"]; ?></td>

                            </tr>

                            <tr>

                                <td>Status</td>

                                <td>:</td>

                                <td class="card-text"><?= $m["status"]; ?></td>

                            </tr>

                            <tr>

                                <td>Jumlah</td>

                                <td>:</td>

                                <td class="card-text"><input min="0" type="number" name="jumlah<?= $i; ?>"></td>

                            </tr>

                        </table>

                        <?php if (isset($_SESSION["akun-admin"])) { ?>

                        <p>

                            <a class="btn btn-lg btn-warning" title="Edit" href="edit.php?id_menu=<?= $m["id_menu"]; ?>">

                                <i class="bi bi-pencil-fill"></i>

                            </a>

                            <a class="btn btn-lg btn-danger" title="Hapus" href="hapus.php?id_menu=<?= $m["id_menu"]; ?>" onclick="return confirm('Ingin Menghapus Menu?')">

                                <i class="bi bi-trash3-fill"></i>

                            </a>

                        </p>

                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
