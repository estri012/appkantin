<?php 
$rs = $data->row();
 ?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Kode Transaksi</th>
				<th>:</th>
				<td><?php echo $rs->kode_penjualan; ?></td>
				<th>No Pelanggan</th>
				<th>:</th>
				<td><?php echo $rs->no_pelanggan; ?></td>
			</tr>
			<tr>
				<th>Tgl Penjualan</th>
				<th>:</th>
				<td><?php echo $rs->tgl_penjualan; ?></td>
				<th>Nama Pelanggan</th>
				<th>:</th>
				<td><?php echo $rs->nama; ?></td>
			</tr>
			<tr>
				<th>Total Harga</th>
				<th>:</th>
				<td>Rp. <?php echo number_format($rs->harga_total); ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" >
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Nama Tenant</th>
					<th>Harga</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql = $this->db->query("SELECT * FROM penjualan_detail as a,menu as b where a.kode_menu=b.kode_menu and a.kode_penjualan='$rs->kode_penjualan' ");
				$no = 1;
				foreach ($sql->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_menu; ?></td>
					<td><?php echo $row->nama_menu; ?></td>
					<td><?php echo $row->nama_tenant; ?></td>
					<td><?php echo $row->harga; ?></td>
					<td><?php echo $row->qty; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>