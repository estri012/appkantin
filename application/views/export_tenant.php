<?php
 
 // header("Content-type: application/vnd-ms-excel");
 
 // header("Content-Disposition: attachment; filename=tenant.xls");
 
 // header("Pragma: no-cache");
 
 // header("Expires: 0");
 
 ?>

<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
        <th>Kode Menu</th>
        <th>Nama Tenant</th>
        <th>Jumlah Storan</th>
        <th>Tgl Penyetoran</th>
        <th>Jumlah Terjual</th>
        <th>Sisa Menu</th>
        <th>Nominal Uang</th>
        <th>Tgl Pengambilan</th>
        <th>Petugas</th>
            </tr><?php
            $tenant_data = $this->db->get('tenant');
            foreach ($tenant_data->result() as $tenant)
            {
                ?>
                <tr>
            <td><?php echo $tenant->kode_menu ?></td>
            <td><?php echo $tenant->nama_tenant ?></td>
            <td><?php echo $tenant->jumlah_storan ?></td>
            <td><?php echo $tenant->tgl_penyetoran ?></td>
            <td><?php echo $tenant->jumlah_terjual ?></td>
            <td><?php echo $tenant->sisa_menu ?></td>
            <td><?php echo $tenant->nominal_uang ?></td>
            <td><?php echo $tenant->tgl_pengambilan ?></td>
            <td><?php echo $tenant->petugas ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>