<form method="post">
		<label>Bulan </label>
    <div class="form-group">
    <input type="month" name="bulan" value="<?php echo isset($_POST['bulan']) ? $_POST['bulan'] : '' ?>" />
		</div>
    <button type="submit" formaction="app/laporan_bulanan" class="btn btn-success" >Tampilkan</button>
    <button type="submit" formaction="app/cetak_laporan_bulanan" formtarget="_blank" class="btn btn-success">Cetak</button>
    <form>
	
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
                $bulan = $this->input->post('bulan');
                $username = $this->session->userdata('username');
				$sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header  where penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$bulan-%%'    ");
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
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$bulan-%%'    ");
                foreach ($sql->result() as $rw) {
                    $total_harga = $total_harga+$rw->total_harga;
                    }
                echo number_format($total_harga);
                ?></td>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$bulan-%%'    ");
                foreach ($sql->result() as $rw) {
                    $biaya_operasional  = $biaya_operasional + $rw->biaya_operasional;
                    }
                echo number_format($biaya_operasional);
                ?></td>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$bulan-%%'    ");
                foreach ($sql->result() as $rw) {
                    $pendapatan_kantin = $pendapatan_kantin + $rw->pendapatan_kantin;
                    }
                echo number_format($pendapatan_kantin);
                ?></td>
				
			</tr>
		</table>