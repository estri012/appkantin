<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Pendapatan Kantin</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body style="padding: 20px" onload="print()">
	<center>
		<h3>Laporan Pendapatan kantin</h3>
	</center>
	<br><br>

	Dari tanggal <b><?php echo $tgl1 ?></b> sd <b><?php echo $tgl2 ?></b>
	<hr>
	<table class="table table-bordered" >
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode Transaksi</th>
				<th>Tgl Penjualan</th>
				<th>Pendapatan Kantin</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$total = 0;
			$no = 1;
			foreach ($cetak->result() as $row) {
			 ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $row->kode_penjualan ?></td>
				<td><?php echo $row->tgl_penjualan ?></td>
				<td><?php echo $row->untung?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>