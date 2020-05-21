<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=penjualan.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Bayar</th>
                    <th>Nama Kasir</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = $this->db->query("SELECT * FROM penjualan_header,pelanggan where penjualan_header.no_pelanggan=pelanggan.no_pelanggan order by penjualan_header.id_penjualan DESC");
                $no = 1;
                foreach ($sql->result() as $row) {
                 ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->kode_penjualan; ?></td>
                    <td><?php echo $row->nama; ?></td>
                    
                    <td><?php echo $row->tgl_penjualan; ?></td>
                    <td><?php echo $row->harga_total; ?></td>
                    <td><?php echo $row->kasir; ?></td>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>