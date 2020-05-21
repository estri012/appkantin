<form method="post" >
	<label>Dari Tanggal </label>
    <div class="form-group">
    <input type="date" name="tanggal1" value="<?php echo isset($_POST['tanggal1']) ? $_POST['tanggal1'] : '' ?>" />
	</div>
	<label>Sampal Tanggal </label>
    <div class="form-group">
    <input type="date" name="tanggal2" value="<?php echo isset($_POST['tanggal2']) ? $_POST['tanggal2'] : '' ?>" />
	</div>
    <button type="submit" formaction="app/laporan_mingguan" class="btn btn-success" >Tampilkan</button>
    <button type="submit" formtarget="_blank" formaction="app/cetak_laporan_mingguan" class="btn btn-success ">Cetak</button>
    <form>
</div>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			
				<tr>
					<th>No.</th>                    
					<th>Kode Transaksi</th>
                    <th>Tanggal Penjualan</th>
                    <th>Nama Menu</th>
					<th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
					<th>Biaya Operasional</th>
					<th>Total Pendapatan</th>
				</tr>
			
			<tbody>
                <?php 
				$tanggal1 = $this->input->post('tanggal1');
				$tanggal2 = $this->input->post('tanggal2');
                $username = $this->session->userdata('username');
				$sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header  where penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan between '$tanggal1' and '$tanggal2'    ");
				$no = 1;
				foreach ($sql->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_penjualan; ?></td>
                    <td><?php echo $row->tgl_penjualan; ?></td>
                    <td><?php echo $row->nama_menu; ?></td>					
					<td><?php echo $row->qty ?></td>
                    <td><?php echo $row->harga ?></td>
                    <td><?php echo $row->total_harga ?></td>
					<td><?php echo $row->biaya_operasional ?></td>
					<td><?php echo $row->pendapatan_kantin ?></td>
				</tr>
				<?php } ?>
			</tbody>
			<tr>
				<th colspan="6">Total Penjualan</th>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan between '$tanggal1' and '$tanggal2'    ");
                foreach ($sql->result() as $rw) {
                    $total_harga = $total_harga+$rw->total_harga;
                    }
                echo number_format($total_harga);
                ?></td>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan between '$tanggal1' and '$tanggal2'    ");
                foreach ($sql->result() as $rw) {
                    $biaya_operasional  = $biaya_operasional + $rw->biaya_operasional;
                    }
                echo number_format($biaya_operasional);
                ?></td>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan between '$tanggal1' and '$tanggal2'    ");
                foreach ($sql->result() as $rw) {
                    $pendapatan_kantin = $pendapatan_kantin + $rw->pendapatan_kantin;
                    }
                echo number_format($pendapatan_kantin);
                ?></td>
				
			</tr>
		</table>