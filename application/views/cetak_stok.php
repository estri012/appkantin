<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Stok Menu</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body onload="print()">
	<center>
		<h3>Stok Menu</h3>
	</center>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Menu</th>
        <th>Nama Menu</th>
        <th>Stok</th>
            </tr><?php
            $start = 0;
            $menu_data = $this->db->get('menu');
            foreach ($menu_data->result() as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $menu->kode_menu ?></td>
            <td><?php echo $menu->nama_menu ?></td>
            <td><?php echo $menu->stok ?></td>
        </tr>
                <?php
            }
            ?>
        </table>
		</div>
	</div>


</body>
</html>