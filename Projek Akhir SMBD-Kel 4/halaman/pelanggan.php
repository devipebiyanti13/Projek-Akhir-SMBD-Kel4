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
        .btn-delete {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-delete:hover {
            background-color: #d32f2f;
        }
        .btn-back {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            display: block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="layer_tabel">
    <h2>Daftar Pelanggan</h2>

    <?php
    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "restoran");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Cek apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pesan'])) {
        // Ambil data dari form
        $nama = $_POST['nama'];
        $no_meja = $_POST['no_meja'];

        // Simpan data pelanggan ke dalam database
        $sql = "INSERT INTO pelanggan (nama, no_meja) VALUES ('$nama', '$no_meja')";

        if ($koneksi->query($sql) === TRUE) {
            echo "Data pelanggan berhasil disimpan";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }

    // Cek apakah ada request untuk menghapus data
    if (isset($_GET['hapus'])) {
        $id_pelanggan = $_GET['hapus'];
        $sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";

        if ($koneksi->query($sql) === TRUE) {
            echo "Data pelanggan berhasil dihapus";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }

    // Ambil data dari tabel pelanggan
    $result = $koneksi->query("SELECT id_pelanggan, nama, no_meja FROM pelanggan");

    if ($result->num_rows > 0) {
        // Tampilkan data dalam tabel
        echo '<table border="1">
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nomor Meja</th>
                    <th>Opsi</th>
                </tr>';
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id_pelanggan']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['no_meja']}</td>
                    <td>
                        <form action='' method='GET' style='display:inline-block;'>
                            <input type='hidden' name='hapus' value='{$row['id_pelanggan']}'>
                            <button type='submit' class='btn-delete'>Hapus</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo '</table>';
    } else {
        echo "<p>No data found</p>";
    }

    $koneksi->close();
    ?>

    <!-- Kembali Button -->
    <!-- <a href="../index.php" class="btn-back">Kembali</a> -->
</div>
</body>
</html>
