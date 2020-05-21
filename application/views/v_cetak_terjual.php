<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Menu Terjual</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h3>Menu Terjual</h3>
	</center>
	<div class="row">
		<div class="col-md-12">
            Dari tanggal <b><?php echo $tgl1 ?></b> sd <b><?php echo $tgl2 ?></b>
            <hr>
			<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Menu</th>
        <th>Nama Menu</th>
        <th>Tgl Penjualan</th>
        <th>Terjual</th>
            </tr><?php
            $start = 0;
            foreach ($cetak->result() as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $menu->kode_menu ?></td>
            <td><?php echo $menu->nama_menu ?></td>
            <td><?php echo $menu->tgl_penjualan ?></td>
            <td><?php echo $menu->qty ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>
		</div>
	</div>


</body>
</html>