CREATE DATABASE restoran;

USE restoran;

CREATE TABLE menu (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    kode_menu VARCHAR(50) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255),
    kategori VARCHAR(50),
    STATUS ENUM('tersedia', 'tidak tersedia') NOT NULL
);


INSERT INTO menu (id_menu, kode_menu, nama, harga, gambar, kategori, STATUS) VALUES
(0, 'MN51', 'Nasi Putih Biasa', 4000, 'nasi-putih-biasa.png', 'Makanan', 'tersedia'),
(111, 'MN01', 'Bebek Cabe Ijo', 40000, 'bebek-goreng-ijo.png', 'Makanan', 'tersedia'),
(2, 'MN02', 'Kerang Asam manis', 50000, 'kerang-asam-manis.png', 'Makanan', 'tersedia'),
(3, 'MN03', 'Gurame Saus Tauco', 25000, 'gurame-saus-tauco.png', 'Makanan', 'tersedia'),
(4, 'MN04', 'Gurame Asam Manis', 30000, 'gurame-asam-manis.png', 'Makanan', 'tersedia'),
(5, 'MN05', 'Dendeng Balado', 35000, 'dendeng-balado.png', 'Makanan', 'tersedia'),
(6, 'MN06', 'Bebek Goreng Kelapa', 35000, 'bebek-goreng-kelapa.png', 'Makanan', 'tersedia'),
(7, 'MN07', 'Balado Kerang Pedas', 45000, 'balado-kerang-pedas.png', 'Makanan', 'tersedia'),
(8, 'MN08', 'Ayam Bakar Madu', 25000, 'ayam-bakar-madu.png', 'Makanan', 'tersedia'),
(9, 'MN09', 'Nasi Goreng Sosis', 15000, 'nasi-goreng-sosis.png', 'Makanan', 'tersedia'),
(10, 'MN10', 'Udang Tepung Gendut', 20000, 'udang-tepung.png', 'Fast Food', 'tersedia'),
(11, 'MN11', 'Macaroni Asam Pedas', 25000, 'macaroni-asam-pedas.png', 'Fast Food', 'tersedia'),
(12, 'MN12', 'Spaghetti Saus Ikan', 25000, 'spaghetti-saus-ikan.png', 'Fast Food', 'tersedia'),
(13, 'MN13', 'Ayam Goreng Tepung', 10000, 'ayam-goreng-tepung.png', 'Fast Food', 'tersedia'),
(14, 'MN14', 'Chicken Wings', 30000, 'chicken-wings.png', 'Fast Food', 'tersedia'),
(15, 'MN15', 'Roti Jalo Kuah Kari', 35000, 'roti-jalo.png', 'Fast Food', 'tersedia'),
(16, 'MN16', 'Burger Egg Cheese', 16000, 'egg-cheese-burger.png', 'Fast Food', 'tersedia'),
(17, 'MN17', 'Roll Sushi Tuna', 30000, 'roll-sushi-tuna.png', 'Fast Food', 'tersedia'),
(18, 'MN18', 'Mie Setan', 20000, 'mie-setan.png', 'Fast Food', 'tersedia'),
(19, 'MN19', 'Molen Kacang Hijau', 5000, 'molen-kacang-hijau.png', 'Snack', 'tersedia'),
(20, 'MN20', 'Kue Cubit', 10000, 'kue-cubit.png', 'Snack', 'tersedia'),
(21, 'MN21', 'Otak2 Udang Keju', 15000, 'otak-udang-keju.png', 'Snack', 'tersedia'),
(22, 'MN22', 'Donat Kentang', 15000, 'donat-kentang.png', 'Snack', 'tersedia'),
(23, 'MN23', 'Siomay Bandung', 30000, 'siomay-bandung.png', 'Snack', 'tersedia'),
(24, 'MN24', 'Rolade Tahu', 20000, 'rolade-tahu.png', 'Snack', 'tersedia'),
(25, 'MN25', 'Onion Ring', 10000, 'onion-ring.png', 'Snack', 'tersedia'),
(26, 'MN26', 'Puding Lumut', 10000, 'puding-lumut.png', 'Dessert', 'tersedia'),
(27, 'MN27', 'Oreo Cheese Cake', 25000, 'oreo-cheese-cake.png', 'Dessert', 'tersedia'),
(28, 'MN28', 'Strawberry Cheese Cake', 25000, 'strawberry-cheese-cake.png', 'Dessert', 'tersedia'),
(29, 'MN29', 'Cake Ubi Ungu', 20000, 'cake-ubi-ungu.png', 'Dessert', 'tersedia'),
(30, 'MN30', 'Black Forest', 25000, 'black-forest.png', 'Dessert', 'tersedia'),
(31, 'MN31', 'Wafer Coklat Puding', 20000, 'wafer-coklat-puding.png', 'Dessert', 'tersedia'),
(32, 'MN32', 'Es Krim Kacang Merah', 28000, 'es-krim-kacang-merah.png', 'Dessert', 'tersedia'),
(33, 'MN33', 'Ketan lapis Srikaya', 20000, 'ketan-lapis-srikaya.png', 'Dessert', 'tersedia'),
(34, 'MN34', 'Pandan Roll Kismis', 20000, 'pandan-roll-kismis.png', 'Dessert', 'tersedia'),
(35, 'MN35', 'Caramel Frappuccino', 8000, 'caramel-fc.png', 'Minuman', 'tersedia'),
(36, 'MN36', 'Susu Caramel Kopo', 8000, 'susu-karamel-kopo.png', 'Minuman', 'tersedia'),
(37, 'MN37', 'Ice Caramel Macchiato', 8000, 'caramel-mc.png', 'Minuman', 'tersedia'),
(38, 'MN38', 'Capuccino Float', 8000, 'capuccino-float.png', 'Minuman', 'tersedia'),
(39, 'MN39', 'Jus Pisang', 5000, 'jus-pisang.png', 'Minuman', 'tersedia'),
(40, 'MN40', 'Jus Nangka', 5000, 'jus-nangka.png', 'Minuman', 'tersedia'),
(41, 'MN41', 'Jus Mangga', 5000, 'jus-mangga.png', 'Minuman', 'tersedia'),
(42, 'MN42', 'Jus Alpukat', 5000, 'jus-alpukat.png', 'Minuman', 'tersedia'),
(43, 'MN43', 'Jus Melon', 5000, 'jus-melon.png', 'Minuman', 'tersedia'),
(44, 'MN44', 'Jus Sirsak', 5000, 'jus-sirsak.png', 'Minuman', 'tersedia'),
(45, 'MN45', 'Jus Wortel', 5000, 'jus-wortel.png', 'Minuman', 'tersedia'),
(46, 'MN46', 'Es Kacang Ijo', 12000, 'es-kacang-ijo.png', 'Minuman', 'tersedia'),
(47, 'MN47', 'Rainbow Juice', 12000, 'rainbow-juice.png', 'Minuman', 'tersedia'),
(48, 'MN48', 'Strawberry Ice Tea', 12000, 'strawberry-iced.png', 'Minuman', 'tersedia'),
(49, 'MN49', 'Smoothie Mangga', 12000, 'smoothie-mangga.png', 'Minuman', 'tersedia'),
(50, 'MN50', 'Es Kopyor', 8000, 'es-kopyor.png', 'Minuman', 'tersedia'),
(52, 'MN52', 'Es Teh Manis', 3000, 'es-teh-manis.png', 'Minuman', 'tersedia');

CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_telp VARCHAR(15)
);

ALTER TABLE pelanggan CHANGE no_telp no_meja INT(15);


CREATE TABLE pesanan (
    id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT,
    kode_pesanan VARCHAR(50) NOT NULL,
    id_menu INT,
    kode_menu VARCHAR(50),
    jumlah INT(20),
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY (id_menu) REFERENCES menu(id_menu)
);

CREATE TABLE ADMIN (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL
);

INSERT INTO ADMIN (id_admin, username, PASSWORD) VALUES
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3');


CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT,
    id_admin INT,
    waktu DATETIME NOT NULL,
    total INT(20),
    bayar INT(20),
    FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan),
    FOREIGN KEY (id_admin) REFERENCES ADMIN(id_admin)
);

ALTER TABLE transaksi
ADD COLUMN kembali INT(50);

CREATE TABLE USER (
  id_user INT(11) NOT NULL,
  username VARCHAR(255) NOT NULL,
  PASSWORD VARCHAR(255) NOT NULL
);

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'rendi12', '69c796f5bbd1339f3ba3e18ce54fcc63');


CREATE TABLE aktivitas (
    id_aktivitas INT AUTO_INCREMENT PRIMARY KEY,
    ket_trigger VARCHAR(10),
    waktu DATETIME,
    keterangan TEXT
);




///////////////////////VIEW////////////////////


/////VIEW 1/////
CREATE VIEW view_harga_diatas20000 AS
SELECT nama, gambar, harga, kategori, STATUS, id_menu
FROM menu
WHERE harga > 20000;

SELECT * FROM view_harga_diatas20000;


/////VIEW 2/////

CREATE VIEW jumlah_pelanggan_harian AS
SELECT 
    DATE(t.waktu) AS tanggal,
    COUNT(DISTINCT p.id_pelanggan) AS jumlah_pelanggan
FROM 
    pelanggan p
LEFT JOIN 
    pesanan ps ON p.id_pelanggan = ps.id_pelanggan
LEFT JOIN 
    transaksi t ON ps.id_pesanan = t.id_pesanan
WHERE 
    DATE(t.waktu) = CURDATE()
GROUP BY 
    DATE(t.waktu);

    
SELECT * FROM jumlah_pelanggan_harian;


/////VIEW 3/////

CREATE VIEW jumlah_makanan_terjual_harian AS
SELECT 
    DATE(t.waktu) AS tanggal,
    SUM(p.jumlah) AS jumlah_makanan_terjual
FROM 
    pesanan p
INNER JOIN 
    transaksi t ON p.id_pesanan = t.id_pesanan
WHERE 
    DATE(t.waktu) = CURDATE()
GROUP BY 
    DATE(t.waktu);

    
SELECT * FROM jumlah_makanan_terjual_harian;


/////VIEW 4/////

CREATE VIEW pendapatan_harian AS
SELECT 
    DATE(waktu) AS tanggal,
    SUM(total) AS total_pendapatan
FROM 
    transaksi
WHERE 
    DATE(waktu) = CURDATE()
GROUP BY 
    DATE(waktu);

SELECT * FROM pendapatan_harian;


/////VIEW 5/////

CREATE VIEW menu_terlaris_harian AS
SELECT 
    m.nama AS menu,
    SUM(p.jumlah) AS jumlah_terjual
FROM 
    pesanan p
RIGHT JOIN 
    menu m ON p.id_menu = m.id_menu
RIGHT JOIN 
    transaksi t ON p.id_pesanan = t.id_pesanan
WHERE 
    DATE(t.waktu) = CURDATE()
GROUP BY 
    m.nama
ORDER BY 
    jumlah_terjual DESC
LIMIT 3;


SELECT * FROM menu_terlaris_harian;
DROP VIEW menu_terlaris_harian;




/////////////////////////////////TRIGGER//////////////////////////////////////

DELIMITER //

CREATE TRIGGER after_menu_delete
AFTER DELETE ON menu
FOR EACH ROW
BEGIN
    IF OLD.status = 'tidak tersedia' THEN
        INSERT INTO aktivitas (ket_trigger, waktu, keterangan)
        VALUES ('DELETE', NOW(), CONCAT('Menu dengan id ', OLD.id_menu, ' berhasil dihapus.'));
    END IF;
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER after_menu_insert
AFTER INSERT ON menu
FOR EACH ROW
BEGIN
    INSERT INTO aktivitas (ket_trigger, waktu, keterangan)
    VALUES ('INSERT', NOW(), CONCAT('Menu dengan id ', NEW.id_menu, ' berhasil ditambahkan.'));
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER after_menu_update
AFTER UPDATE ON menu
FOR EACH ROW
BEGIN
    INSERT INTO aktivitas (ket_trigger, waktu, keterangan)
    VALUES ('UPDATE', NOW(), CONCAT('Menu dengan id ', NEW.id_menu, ' berhasil diupdate.'));
END //

DELIMITER ;





///////////////////////STORED PROCEDURE//////////////////////////////////

DELIMITER //

CREATE PROCEDURE tampilkan_pesanan_dengan_id (IN Id_pesanan VARCHAR(50))
BEGIN
    SELECT p.id_pesanan, m.nama AS menu, m.harga, p.jumlah, (m.harga * p.jumlah) AS subtotal
    FROM pesanan p
    INNER JOIN menu m ON p.id_menu = m.id_menu
    WHERE p.id_pesanan = Id_pesanan;
END //

DELIMITER ;

CALL tampilkan_pesanan_dengan_id('');



DELIMITER //

CREATE PROCEDURE GetPesananDetails(
    IN in_id_pesanan INT,
    OUT out_nama_pelanggan VARCHAR(100),
    OUT out_nama_menu VARCHAR(100),
    OUT out_jumlah INT,
    OUT out_total DECIMAL(10, 2),
    OUT out_bonus VARCHAR(50)
)
BEGIN
    DECLARE total_pembelian DECIMAL(10, 2);
    DECLARE jumlah_menu INT;

    SELECT pel.nama, m.nama, p.jumlah, (m.harga * p.jumlah) AS total, SUM(m.harga * p.jumlah) AS total_pembelian, COUNT(DISTINCT p.id_menu) AS jumlah_menu
    INTO out_nama_pelanggan, out_nama_menu, out_jumlah, out_total, total_pembelian, jumlah_menu
    FROM pesanan p
    JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
    JOIN menu m ON p.id_menu = m.id_menu
    WHERE p.id_pesanan = in_id_pesanan
    GROUP BY p.id_pelanggan, p.id_menu;

    IF jumlah_menu >= 2 THEN
        SET out_bonus = 'Es Teh';
    ELSEIF total_pembelian >= 50000 THEN
        SET out_bonus = 'Voucher Potongan 10000';
    ELSE
        SET out_bonus = 'Tidak ada bonus';
    END IF;
END //

DELIMITER ;

CALL GetPesananDetails(3, @out_nama_pelanggan, @out_nama_menu, @out_jumlah, @out_total, @out_bonus);
SELECT @out_nama_pelanggan, @out_nama_menu, @out_jumlah, @out_total, @out_bonus;




DELIMITER //

CREATE PROCEDURE hitung_menu_tersedia(
    OUT jumlahMenuTersedia INT,
    OUT jumlahMenuTidakTersedia INT
)
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE statusMenu ENUM('tersedia', 'tidak tersedia');
    DECLARE cur CURSOR FOR 
        SELECT STATUS FROM menu;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    SET jumlahMenuTersedia = 0;
    SET jumlahMenuTidakTersedia = 0;

    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO statusMenu;
        IF done THEN
            LEAVE read_loop;	
        END IF;
        IF statusMenu = 'tersedia' THEN
            SET jumlahMenuTersedia = jumlahMenuTersedia + 1;
        ELSE
            SET jumlahMenuTidakTersedia = jumlahMenuTidakTersedia + 1;
        END IF;
    END LOOP;

    CLOSE cur;
END //

DELIMITER ;

CALL hitung_menu_tersedia(@jumlahMenuTersedia, @jumlahMenuTidakTersedia);
SELECT @jumlahMenuTersedia AS Jumlah_Menu_Tersedia, @jumlahMenuTidakTersedia AS Jumlah_Menu_Tidak_Tersedia;


DELIMITER //

CREATE PROCEDURE tampilkan_makanan()
BEGIN
    SELECT * FROM menu WHERE kategori = 'makanan';
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE tampilkan_minuman()
BEGIN
    SELECT * FROM menu WHERE kategori = 'minuman';
END //

DELIMITER ;


CALL tampilkan_makanan();
CALL tampilkan_minuman();
