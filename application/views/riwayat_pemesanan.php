<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Transaksi</th>
        <th>Tanggal</th>
        <th>No Pelanggan</th>
        <th>Total harga</th>
        
            </tr><?php
            $start=0;
            $menu_data = $this->db->get_where('penjualan_header', array('no_pelanggan'=>$this->session->userdata('no_pelanggan')));
            foreach ($menu_data->result() as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start; ?></td>
            <td><?php echo $menu->kode_penjualan ?></td>
            <td><?php echo $menu->tgl_penjualan ?></td>
            <td><?php echo $menu->no_pelanggan ?></td>
            <td><?php echo $menu->harga_total ?></td>
        </tr>
                <?php
            }
            ?>
        </table>

    


        

