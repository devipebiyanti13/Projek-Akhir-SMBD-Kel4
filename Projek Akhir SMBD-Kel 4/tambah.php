<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Tambah data hanya berlaku untuk admin!');
            location.href = 'index.php';
        </script>";
    } else {
        header("Location: login.php");
        exit;
    }
}



if (isset($_POST["tambah"])) {

    $tambah = tambah_data_menu();

    echo $tambah > 0

        ? "<script>

        alert('Data berhasil ditambah!');

        location.href = 'index.php';

    </script>"

        : "<script>

        alert('Data gagal ditambah!');

        location.href = 'index.php';

    </script>";

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('src/img/background2.jpg');
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
</head>

<body>
    <div class="container">
        <h1>Tambah Data Masakan</h1>
        <a class="btn btn-success fw-bold" href="index.php">Kembali</a>
        <form action="tambah.php" method="POST" enctype="multipart/form-data">
            <div class="table-responsive-md my-3">
                <table class="table">
                    <tr>
                        <td><label for="nama">Nama Makanan</label></td>
                        <td>:</td>
                        <td><input autocomplete="off" type="text" name="nama" id="nama" required></td>
                    </tr>
                    <tr>
                        <td><label for="harga">Harga</label></td>
                        <td>:</td>
                        <td><input min="0" type="number" name="harga" id="harga" required></td>
                    </tr>
                    <tr>
                        <td><label for="gambar">Gambar</label></td>
                        <td>:</td>
                        <td><input type="file" name="gambar" accept="image/*" required></td>
                    </tr>
                    <tr>
                        <td><label for="kategori">Kategori</label></td>
                        <td>:</td>
                        <td>
                            <select name="kategori" id="kategori">
                                <option selected value="Makanan">Makanan</option>
                                <option value="Fast Food">Fast Food</option>
                                <option value="Snack">Snack</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Minuman">Minuman</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Status</label></td>
                        <td>:</td>
                        <td>
                            <label for="tersedia"><input type="radio" name="status" id="tersedia" value="tersedia" checked>Tersedia</label>
                            <label for="tidak-tersedia"><input type="radio" name="status" id="tidak-tersedia" value="tidak tersedia">Tidak Tersedia</label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><button class="btn" name="tambah">Tambah</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>
</body>

</html>
