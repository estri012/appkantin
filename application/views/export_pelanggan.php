<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=pelanggan.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table >
            <tr>
        <td>no_induk</td>
        <td>nama</td>
        <td>alamat</td>
        <td>tempat_lahir</td>
        <td>tanggal_lahir</td>
        <td>no_telp</td>
            </tr><?php
            $pelanggan_data = $this->db->get('pelanggan');
            foreach ($pelanggan_data->result() as $pelanggan)
            {
                ?>
                <tr>
            <td><?php echo $pelanggan->no_pelanggan ?></td>
            <td><?php echo $pelanggan->nama ?></td>
            <td><?php echo $pelanggan->alamat ?></td>
            <td><?php echo $pelanggan->tempat_lahir ?></td>
            <td><?php echo $pelanggan->tanggal_lahir ?></td>
            <td><?php echo $pelanggan->no_telp ?></td>
        </tr>
                <?php
            }
            ?>
        </table>