<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "restoran");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

function cekPesananDiTransaksi($koneksi, $id_pesanan) {
    $result = $koneksi->query("SELECT * FROM transaksi WHERE id_pesanan = $id_pesanan");
    return $result->num_rows > 0;
}

// Ambil data dari tabel pesanan
$pesanan_result = $koneksi->query("SELECT * FROM pesanan");

// Cek apakah ada data pesanan
if ($pesanan_result->num_rows > 0) {
    // Lakukan loop untuk setiap data pesanan
    while ($pesanan_row = $pesanan_result->fetch_assoc()) {
        // Ambil nilai yang diperlukan dari data pesanan
        $id_pesanan = $pesanan_row['id_pesanan'];
        $id_menu = $pesanan_row['id_menu'];
        $jumlah = $pesanan_row['jumlah'];

        // Ambil harga dari menu berdasarkan ID menu
        if (!cekPesananDiTransaksi($koneksi, $id_pesanan)) {
            // Ambil harga dari menu berdasarkan ID menu
            $menu_result = $koneksi->query("SELECT harga FROM menu WHERE id_menu = $id_menu");
            $menu_row = $menu_result->fetch_assoc();
            $harga_menu = $menu_row['harga'];

            // Hitung total harga berdasarkan harga menu dan jumlah pesanan
            $total_harga = $harga_menu * $jumlah;

            // Simpan data ke dalam tabel transaksi
            $transaksi_insert = $koneksi->query("INSERT INTO transaksi (id_pesanan, waktu, total) VALUES ($id_pesanan, NOW(), $total_harga)");
        }
    }
} else {
    echo "<p>No data found in pesanan table</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['simpan'])) {
        // Loop untuk menyimpan data bayar dan menghitung kembali
        foreach ($_POST['bayar'] as $id_transaksi => $nilai_bayar) {
            // Ambil total dari database berdasarkan id_transaksi
            $query_total = "SELECT total FROM transaksi WHERE id_transaksi = $id_transaksi";
            $result_total = $koneksi->query($query_total);

            if ($result_total->num_rows > 0) {
                $row_total = $result_total->fetch_assoc();
                $total_harga = $row_total['total'];

                // Hitung kembali
                $kembali = $nilai_bayar - $total_harga;

                // Update query untuk menyimpan nilai bayar dan kembali
                $query_update = "UPDATE transaksi SET bayar = $nilai_bayar, kembali = $kembali WHERE id_transaksi = $id_transaksi";

                if ($koneksi->query($query_update) === TRUE) {
                    echo "Data bayar berhasil disimpan.";
                } else {
                    echo "Error: " . $query_update . "<br>" . $koneksi->error;
                }
            } else {
                echo "No data found for transaction ID: $id_transaksi";
            }
        }
    } elseif (isset($_POST['hapus'])) {
        $id_transaksi = $_POST['hapus'];
        // Query untuk menghapus data dari tabel transaksi
        $query_delete = "DELETE FROM transaksi WHERE id_transaksi = $id_transaksi";

        if ($koneksi->query($query_delete) === TRUE) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Error: " . $query_delete . "<br>" . $koneksi->error;
        }
    }
}

// Ambil data dari tabel transaksi
$result = $koneksi->query("SELECT * FROM transaksi");
?>

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

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #777;
        }

        .layer_tabel {
            background: #D8EFD3;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 80%;
            border-collapse: separate;
            border-spacing: 0;
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
<div class="layer_tabel">
    <h1>Transaksi Pesanan</h1>
    <form method="post"> <!-- Tambahkan method="post" untuk mengirimkan data dengan POST -->
        <table border="1">
            <tr>
                <th>ID Transaksi</th>
                <th>ID Pesanan</th>
                <th>Waktu</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembali</th>
                <th>Opsi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Tampilkan data dalam tabel
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_transaksi']; ?></td>
                        <td><?php echo $row['id_pesanan']; ?></td>
                        <td><?php echo $row['waktu']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td>
                            <input type="number" name="bayar[<?php echo $row['id_transaksi']; ?>]" class="form-control" placeholder="Bayar">
                        </td>
                        <td><?php echo $row['kembali']; ?></td>
                        <td>
                            <button type="submit" name="simpan" class="btn">Simpan</button>
                            <button type="submit" name="hapus" value="<?php echo $row['id_transaksi']; ?>" class="btn">Hapus</button>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }

            // Tutup koneksi database
            $koneksi->close();
            ?>
        </table>
    </form> <!-- Tutup form -->
</div>

</body>
</html>
