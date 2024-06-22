<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Pelanggan Harian</title>
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
        <h1>Jumlah Pelanggan Harian</h1>
        <table border="1">
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Pelanggan</th>
            </tr>
            <?php
            // Koneksi ke database
            $koneksi = new mysqli("localhost", "root", "", "restoran");

            if ($koneksi->connect_error) {
                die("Koneksi gagal: " . $koneksi->connect_error);
            }

            // Ambil data dari view jumlah_pelanggan_harian
            $result = $koneksi->query("SELECT * FROM jumlah_pelanggan_harian");

            if ($result->num_rows > 0) {
                // Tampilkan data dalam tabel
                while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['jumlah_pelanggan']; ?></td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='2'>Tidak ada data ditemukan</td></tr>";
            }

            // Tutup koneksi database
            $koneksi->close();
            ?>
        </table>
    </div>
</body>
</html>
