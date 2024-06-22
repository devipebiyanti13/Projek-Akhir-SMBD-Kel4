<table class="table table-bordered table-hover" style="margin-top: 100px;">

    <tr class="text-bg-success">

        <th>No</th>

        <th>Kode Pesanan</th>

        <th>Jumlah</th>

        <th>Id_Menu</th>

        <th>Kode Menu</th>

    </tr>

    <?php $i = 1; foreach ($menu as $m) { ?>

    <tr style="background-color: white;">
    <td><?= $i; ?></td>
    <td><?= $m["kode_pesanan"]; ?></td>
    <td><?= $m["jumlah"]; ?></td>
    <td><?= isset($m["id_menu"]) ? $m["id_menu"] : ""; ?></td> 
    <td><?= $m["kode_menu"]; ?></td>
    </tr>

    <?php $i++; } ?>


</table>