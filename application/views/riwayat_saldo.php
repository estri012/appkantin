<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Tanggal / Waktu</th>
        <th>No Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>Jenis Transaksi</th>
        <th>Jumlah Saldo</th>
        
            </tr><?php
            $start=0;
            $menu_data = $this->db->query("SELECT * FROM detail_saldo,pelanggan where detail_saldo.no_pelanggan=pelanggan.no_pelanggan order by detail_saldo.waktu DESC");
            foreach ($menu_data->result() as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start; ?></td>
            <td><?php echo $menu->waktu ?></td>
            <td><?php echo $menu->no_pelanggan ?></td>
            <td><?php echo $menu->nama ?></td>
            <td><?php echo $menu->tipe ?></td>
            <td><?php echo $menu->perubahan_saldo ?></td>
        </tr>
                <?php
            }
            ?>
        </table>

    


        

