<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restoran</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
            color: #555;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #777;
        }
        .layer_tabel {
            background: #D8EFD3;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9f5e9;
            color: #333;
        }
        .form-container {
            margin-top: 20px;
            text-align: center;
        }
        .input-group {
            display: inline-block;
            margin-top: 20px;
        }
        .input-group input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            width: 300px;
        }
        .input-group button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            background-color: #4CAF50;
            color: #fff;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .input-group button:hover {
            background-color: #45a049;
        }
        .delete-button {
            padding: 5px 10px;
            font-size: 14px;
            color: #fff;
            background-color: #ff6347;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #e5533d;
        }
        .message {
            text-align: center;
            margin: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .message.success {
            background-color: #4CAF50;
            color: white;
        }
        .message.error {
            background-color: #ff6347;
            color: white;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #d9534f;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            background-color: #c9302c;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "restoran");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Handle form submission for inserting new data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_pelanggan'], $_POST['kode_pesanan'], $_POST['id_menu'], $_POST['kode_menu'], $_POST['jumlah'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $kode_pesanan = $_POST['kode_pesanan'];
    $id_menu = $_POST['id_menu'];
    $kode_menu = $_POST['kode_menu'];
    $jumlah = $_POST['jumlah'];

    // Query untuk INSERT data pesanan baru
    $query_insert = "INSERT INTO pesanan (id_pelanggan, kode_pesanan, id_menu, kode_menu, jumlah) 
                     VALUES ('$id_pelanggan', '$kode_pesanan', '$id_menu', '$kode_menu', '$jumlah')";

    // Eksekusi query INSERT
    if ($koneksi->query($query_insert) === TRUE) {
        echo "Data pesanan berhasil ditambahkan.";
    } else {
        echo "Error: " . $query_insert . "<br>" . $koneksi->error;
    }
}

// Handle form submission for deleting data
if (isset($_POST['hapus'])) {
    $id_pesanan = $_POST['hapus'];

    // Query untuk DELETE data pesanan
    $query_delete = "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan";

    if ($koneksi->query($query_delete) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query_delete . "<br>" . $koneksi->error;
    }
}

// Query untuk SELECT data pesanan
$query_select = "SELECT * FROM pesanan";
$result = $koneksi->query($query_select);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_pesanan"])) {
    $id_pesanan = $_POST["id_pesanan"];
    echo "p";

    $stmt = $koneksi->prepare("CALL hapus_pesanan(?)");
    $stmt->bind_param("i", $id_pesanan);

    $stmt->close();
    $koneksi->close();
} 
?>

<div class="layer_tabel">
    <h2>Pesanan Customer</h2>

    <?php

    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        if ($message == 'success') {
            echo '<div class="message success">Pesanan berhasil dihapus!</div>';
        } else if ($message == 'error') {
            echo '<div class="message error">Gagal menghapus pesanan!</div>';
        }
    }

    // Tampilkan data pesanan
    if ($result->num_rows > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>ID Pelanggan</th>
                <th>Kode Pesanan</th>
                <th>ID Menu</th>
                <th>Kode Menu</th>
                <th>Jumlah</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($m = $result->fetch_assoc()) { ?>
                <tr style="background-color: white;">
                    <td><?= $i; ?></td>
                    <td><?= htmlspecialchars($m["id_pesanan"]); ?></td>
                    <td><?= htmlspecialchars($m["id_pelanggan"]); ?></td>
                    <td><?= htmlspecialchars($m["kode_pesanan"]); ?></td>
                    <td><?= isset($m["id_menu"]) ? htmlspecialchars($m["id_menu"]) : ""; ?></td>
                    <td><?= htmlspecialchars($m["kode_menu"]); ?></td>
                    <td><?= htmlspecialchars($m["jumlah"]); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <button type="submit" name="hapus" value="<?php echo $m['id_pesanan']; ?>" class="btn">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <p>No data available.</p>
    <?php } ?>

    <!-- Form untuk input ID Pesanan -->
    <div class="form-container">
        <form action="" method="GET">
            <div class="input-group">
                <input type="text" name="id_pesanan" placeholder="Masukkan ID Pesanan" required>
                <button type="submit">Lihat</button>
            </div>
        </form>
    </div>

    <!-- Form untuk memanggil stored procedure GetPesananDetails -->
    <div class="form-container">
        <form action="" method="GET">
            <div class="input-group">
                <input type="text" name="detail_id_pesanan" placeholder="Masukkan ID Pesanan untuk Detail" required>
                <button type="submit">Tampilkan Detail</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_GET['id_pesanan'])) {
        $id_pesanan = $_GET['id_pesanan'];

        // Panggil stored procedure dan tampilkan hasilnya
        $query = "CALL tampilkan_pesanan_dengan_id('$id_pesanan')";
        $result = $koneksi->query($query);

        if ($result->num_rows > 0) { ?>
            <div class="layer_tabel">
                <h2>Detail Pesanan untuk ID: <?= htmlspecialchars($id_pesanan); ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id_pesanan']); ?></td>
                                <td><?= htmlspecialchars($row['menu']); ?></td>
                                <td><?= htmlspecialchars($row['harga']); ?></td>
                                <td><?= htmlspecialchars($row['jumlah']); ?></td>
                                <td><?= htmlspecialchars($row['subtotal']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>No data found for ID Pesanan: <?= htmlspecialchars($id_pesanan); ?></p>
        <?php }
    }

    if (isset($_GET['detail_id_pesanan'])) {
        $detail_id_pesanan = $_GET['detail_id_pesanan'];

        // Panggil stored procedure GetPesananDetails
        $query = "CALL GetPesananDetails($detail_id_pesanan, @out_nama_pelanggan, @out_nama_menu, @out_jumlah, @out_total, @out_bonus)";
        $koneksi->query($query);

        // Ambil hasil dari output parameters
        $result = $koneksi->query("SELECT @out_nama_pelanggan AS nama_pelanggan, @out_nama_menu AS nama_menu, @out_jumlah AS jumlah, @out_total AS total, @out_bonus AS bonus");

        if ($result->num_rows > 0) { ?>
            <div class="layer_tabel">
                <h2>Detail Pesanan untuk ID: <?= htmlspecialchars($detail_id_pesanan); ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Nama Menu</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Bonus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                                <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                                <td><?= htmlspecialchars($row['jumlah']); ?></td>
                                <td><?= htmlspecialchars($row['total']); ?></td>
                                <td><?= htmlspecialchars($row['bonus']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>No data found for ID Pesanan: <?= htmlspecialchars($detail_id_pesanan); ?></p>
        <?php }
    }

    $koneksi->close();
    ?>
</div>
</body>
</html>
