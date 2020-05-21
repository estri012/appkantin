<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Menu</th>
        <th>Nama Tenant</th>
        <th>Nama Menu</th>
        <th>Stok</th>
        <th>Harga Tenant</th>
        <th>Harga Jual</th>
        <th>Laba</th>
        
            </tr><?php
            $start=0;
            $menu_data = $this->db->get_where('menu', array('nama_tenant'=>$this->session->userdata('username')));
            foreach ($menu_data->result() as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start; ?></td>
            <td><?php echo $menu->kode_menu ?></td>
            <td><?php echo $menu->nama_tenant ?></td>
            <td><?php echo $menu->nama_menu ?></td>
            <td><?php echo $menu->stok ?></td>
            <td><?php echo $menu->harga_tenant ?></td>
            <td><?php echo $menu->harga ?></td>
            <td><?php echo $menu->laba ?></td>

        </tr>
                <?php
            }
            ?>
        </table>