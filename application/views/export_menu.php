<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=menu.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
            <tr>
            <td>kode_menu</td>
            <td>nama_menu</td>
            <td>stok</td>
            <td>harga</td>
            <td>harga_tenant</td>
            <td>laba</td>
            <td>nama_tenant</td>
            </tr><?php
            $menu_data = $this->db->get('menu');
            foreach ($menu_data->result() as $menu)
            {
                ?>
                <tr>
            <td><?php echo $menu->kode_menu ?></td>
            <td><?php echo $menu->nama_menu ?></td>
            <td><?php echo $menu->stok ?></td>
            <td><?php echo $menu->harga ?></td>
            <td><?php echo $menu->harga_tenant ?></td>
            
            <td><?php echo $menu->laba ?></td>
            <td><?php echo $menu->nama_tenant ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>