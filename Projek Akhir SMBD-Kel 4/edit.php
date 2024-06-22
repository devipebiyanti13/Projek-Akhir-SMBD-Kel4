<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Edit data hanya berlaku untuk admin!');
            location.href = 'index.php';
        </script>";
        exit;
    } else {
        header("Location: login.php");
        exit;
    }
}



if (isset($_POST["edit"])) {

    $edit = edit_data_menu();

    if ($edit > 0) {

        echo "<script>

                alert('Data berhasil diubah!');

                location.href = 'index.php';

            </script>";

    } else if ($edit == 0) {

        echo "<script>

                alert('Data tidak ada yang diubah!');

                location.href = 'index.php';

            </script>";

    } else {

        echo "<script>

                alert('Data gagal diubah!');

                location.href = 'index.php';

            </script>";

    }

}

$id_menu = $_GET["id_menu"];

$menu = ambil_data("SELECT * FROM menu WHERE id_menu = $id_menu")[0];

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('src/img/background.jpg');
            background-size: cover;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 6px;
            margin-bottom: 16px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
        }

        button:hover {
            background-color: #28a745;
            border: 1px solid #28a745;
        }
    </style>

    <title>Edit Data</title>

</head>



<body>

    <div class="container">

        <h1>Edit Data Masakan</h1>

        <a class="btn btn-success fw-bold" href="index.php">Kembali</a>

        <form action="edit.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_menu" value="<?= $menu["id_menu"]; ?>">

            <input type="hidden" name="gambar-lama" value="<?= $menu["gambar"]; ?>">

            <input type="hidden" name="kode_menu" value="<?= $menu["kode_menu"]; ?>">

            <div class="table-responsive-md my-3">

                <table class="table">

                    <tr>

                        <td><label for="nama">Nama Makanan</label></td>

                        <td>:</td>

                        <td><input type="text" name="nama" id="nama" value="<?= $menu["nama"]; ?>" required></td>

                    </tr>

                    <tr>

                        <td><label for="harga">Harga</label></td>

                        <td>:</td>

                        <td><input min="0" type="number" name="harga" id="harga" value="<?= $menu["harga"]; ?>" required></td>

                    </tr>

                    <tr>

                        <td><label for="gambar">Gambar</label></td>

                        <td>:</td>

                        <td>

                            <img src="src/img/<?= $menu["gambar"]; ?>" width="70"><br><br>

                            <input type="file" name="gambar" accept="image/*">

                        </td>

                    </tr>

                    <tr>

                        <td><label for="kategori">Kategori</label></td>

                        <td>:</td>

                        <td>

                            <select name="kategori" id="kategori">

                                <option value="Makanan" <?= $menu["kategori"] == "Makanan" ? "selected" : ""; ?>>Makanan</option>

                                <option value="Fast Food" <?= $menu["kategori"] == "Fast Food" ? "selected" : ""; ?>>Fast Food</option>

                                <option value="Snack" <?= $menu["kategori"] == "Snack" ? "selected" : ""; ?>>Snack</option>

                                <option value="Dessert" <?= $menu["kategori"] == "Dessert" ? "selected" : ""; ?>>Dessert</option>

                                <option value="Minuman" <?= $menu["kategori"] == "Minuman" ? "selected" : ""; ?>>Minuman</option>

                            </select>

                        </td>

                    </tr>

                    <tr>

                        <td><label for="status">Status</label></td>

                        <td>:</td>

                        <td>

                            <label for="tersedia"><input type="radio" name="status" id="tersedia" value="tersedia" <?= $menu["status"] == "tersedia" ? "checked" : ""; ?>>Tersedia</label>

                            <label for="tidak-tersedia"><input type="radio" name="status" id="tidak-tersedia" value="tidak tersedia" <?= $menu["status"] == "tidak tersedia" ? "checked" : ""; ?>>Tidak Tersedia</label>

                        </td>

                    </tr>

                    <tr>

                        <td></td>

                        <td></td>

                        <td><button class="btn btn-primary" name="edit">Edit</button></td>

                    </tr>

                </table>

            </div>

        </form>

    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>

</body>



</html>