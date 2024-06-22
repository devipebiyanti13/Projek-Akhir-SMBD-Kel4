<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas</title>
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
        .btn-delete {
            background-color: #d9534f;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="layer_tabel">
        <h1>Aktivitas</h1>
        <?php
        // Koneksi ke database
        $koneksi = new mysqli("localhost", "root", "", "restoran");

        if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
        }

        // Handle delete request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id_aktivitas = $_POST['delete_id'];
            $stmt = $koneksi->prepare("DELETE FROM aktivitas WHERE id_aktivitas = ?");
            $stmt->bind_param("i", $id_aktivitas);
            if ($stmt->execute()) {
                echo "<p>Data dengan ID $id_aktivitas berhasil dihapus.</p>";
            } else {
                echo "<p>Gagal menghapus data dengan ID $id_aktivitas.</p>";
            }
            $stmt->close();
        }

        // Ambil data dari tabel aktivitas
        $result = $koneksi->query("SELECT * FROM aktivitas");

        if ($result->num_rows > 0) {
            echo '<table border="1">
                <tr>
                    <th>ID Aktivitas</th>
                    <th>Ket Trigger</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>';
            // Tampilkan data dalam tabel
            while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_aktivitas']; ?></td>
                    <td><?php echo $row['ket_trigger']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['keterangan']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id_aktivitas']; ?>">
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php }
            echo '</table>';
        } else {
            echo "<p>Tidak ada data ditemukan</p>";
        }

        // Tutup koneksi database
        $koneksi->close();
        ?>
    </div>
</body>
</html>
