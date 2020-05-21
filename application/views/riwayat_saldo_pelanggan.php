<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Tanggal / Waktu</th>
        <th>No Pelanggan</th>
        <th>Jenis Transaksi</th>
        <th>Jumlah Saldo</th>
        
            </tr><?php
            $start=0;
            $no_pelanggan = $this->session->userdata('no_pelanggan');
            $menu_data = $this->db->query("SELECT * FROM detail_saldo where no_pelanggan = '$no_pelanggan' order by waktu DESC");
            foreach ($menu_data->result() as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start; ?></td>
            <td><?php echo $menu->waktu ?></td>
            <td><?php echo $menu->no_pelanggan ?></td>
            <td><?php echo $menu->tipe ?></td>
            <td><?php echo $menu->perubahan_saldo ?></td>
        </tr>
                <?php
            }
            ?>
        </table>

    


        

