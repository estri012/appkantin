
<form action="<?php echo $action; ?>" method="post">
<div class="form-group">
            <label>Tahun </label>
            <select name="tahun" class="form-control" >
			<?php
			$mulai= date('Y') - 50;
			for($i = $mulai;$i<$mulai + 100;$i++){
    		$sel = $i == date('Y') ? ' selected="selected"' : '';
   			 echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';}?>
            </select>
        </div>
	<div class="form-group">
	<button type="submit" formaction="app/laporan_tahunan" class="btn btn-success">Tampilkan</button>
    <button type="submit" formaction="app/cetak_laporan_tahunan" formtarget="_blank" class="btn btn-success">Cetak</button>
	</div>
</form>

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
                $tahun = $this->input->post('tahun');
                $username = $this->session->userdata('username');
				$sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header  where penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$tahun-%%-%%'    ");
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
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$tahun-%%-%%'    ");
                foreach ($sql->result() as $rw) {
                    $total_harga = $total_harga+$rw->total_harga;
                    }
                echo number_format($total_harga);
                ?></td>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$tahun-%%-%%'    ");
                foreach ($sql->result() as $rw) {
                    $biaya_operasional  = $biaya_operasional + $rw->biaya_operasional;
                    }
                echo number_format($biaya_operasional);
                ?></td>
				<td>Rp. 
				<?php 
				$total_harga= 0;
                $username = $this->session->userdata('username');                                
                $sql = $this->db->query("SELECT *, (total_harga * 0.85)  as pendapatan_kantin, (total_harga * 0.15) as biaya_operasional From penjualan_detail, penjualan_header, pelanggan  where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$tahun-%%-%%'    ");
                foreach ($sql->result() as $rw) {
                    $pendapatan_kantin = $pendapatan_kantin + $rw->pendapatan_kantin;
                    }
                echo number_format($pendapatan_kantin);
                ?></td>
				
			</tr>
		</table>