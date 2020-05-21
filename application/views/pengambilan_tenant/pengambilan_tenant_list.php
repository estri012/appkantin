<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pengambilan_tenant/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pengambilan_tenant/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengambilan_tenant'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Menu</th>
        <th>Tgl Pengambilan</th>
        <th>Jumlah</th>
        <th>Sisa Menu</th>
        <th>Nominal Uang</th>
        <th>Petugas</th>
        <th>Action</th>
            </tr><?php
            foreach ($pengambilan_tenant_data as $pengambilan_tenant)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $pengambilan_tenant->kode_menu ?></td>
            <td><?php echo $pengambilan_tenant->tgl_pengambilan ?></td>
            <td><?php echo $pengambilan_tenant->jumlah ?></td>
            <td><?php echo $pengambilan_tenant->sisa_menu ?></td>
            <td><?php echo $pengambilan_tenant->nominal_uang ?></td>
            <td><?php echo $pengambilan_tenant->petugas ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('pengambilan_tenant/read/'.$pengambilan_tenant->id_pengambilan),'Cetak'); 
                echo ' | '; 
                echo anchor(site_url('pengambilan_tenant/update/'.$pengambilan_tenant->id_pengambilan),'Update'); 
                echo ' | '; 
                echo anchor(site_url('pengambilan_tenant/delete/'.$pengambilan_tenant->id_pengambilan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        <?php echo anchor(site_url('pengambilan_tenant/excel'), 'Export', 'class="btn btn-primary"'); ?>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>