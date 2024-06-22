<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Availability</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('src/img/background2.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ffffcc;
        }
        .btn-center {
            text-align: center;
        }
        .btn {
            background-color: #4CAF50; 
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Menu Yang Tersedia</h2>
        <div class="btn-center">
            <form action="" method="post">
                <input type="submit" name="show_menu" value="Tampilkan" class="btn">
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["show_menu"])) {
            // Establish MySQLi connection
            $koneksi = new mysqli("localhost", "root", "", "restoran");

            // Check connection
            if ($koneksi->connect_error) {
                die("Koneksi gagal: " . $koneksi->connect_error);
            }

            // Panggil stored procedure
            $koneksi->query("CALL hitung_menu_tersedia(@jumlahMenuTersedia, @jumlahMenuTidakTersedia)");

            // Ambil hasil dari variabel session
            $result = $koneksi->query("SELECT @jumlahMenuTersedia AS Jumlah_Menu_Tersedia, @jumlahMenuTidakTersedia AS Jumlah_Menu_Tidak_Tersedia");

            if ($result) {
                $row = $result->fetch_assoc();
                echo "<h3>Data Menu yang Tersedia</h3>";
                echo "<table>";
                echo "<tr><th>Keterangan</th><th>Jumlah</th></tr>";
                echo "<tr><td>Tersedia</td><td>{$row['Jumlah_Menu_Tersedia']}</td></tr>";
                echo "<tr><td>Tidak Tersedia</td><td>{$row['Jumlah_Menu_Tidak_Tersedia']}</td></tr>";
                echo "</table>";
            } else {
                echo "No data available.";
            }

            $koneksi->close(); // Tutup koneksi setelah selesai
        }
        ?>

    </div>
</body>
</html>
