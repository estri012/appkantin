<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>" target="blank">
	<title>Cetak Laporan Mingguan</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body style="padding: 20px" onload="print()">
	<center>
		<h3>Laporan Penjualan</h3>
	</center>

    <br>
    <table>
			<tr>
				<th>Nama</th>
				<td> : <?php echo $username ?></td>
			</tr>
			<tr>
				<th>Dari Tanggal</th>
				<td> : <?php echo $tanggal1 ?> s/d <?php echo $tanggal1 ?> </td>
			</tr>
		</table>
	<hr>
	<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Transaksi</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Menu</th>
					<th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach ($cetak->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_penjualan; ?></td>
                    <td><?php echo $row->tgl_penjualan; ?></td>
					<td><?php echo $row->nama; ?></td>
                    <td><?php echo $row->nama_menu; ?></td>					
					<td><?php echo $row->qty ?></td>
                    <td><?php echo $row->harga ?></td>
                    <td><?php echo $row->total_harga ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

</body>
</html>