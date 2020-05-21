<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('menu/create'),'Buat Baru', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('menu/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('menu'); ?>" class="btn btn-default">Reset</a>
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
        <th>Nama Tenant</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Action</th>
            </tr><?php
            foreach ($menu_data as $menu)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $menu->kode_menu ?></td>
            <td><?php echo $menu->nama_tenant ?></td>
            <td><?php echo $menu->nama_menu ?></td>
            <td><?php echo $menu->harga ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('menu/update/'.$menu->id_menu),'Update'); 
                echo ' | '; 
                echo anchor(site_url('menu/delete/'.$menu->id_menu),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Import</button>
                <a href="app/export_menu" target="_blank" class="btn btn-info">Export</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="menu/upload" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Upload</label>
            <input type="file" class="form-control" name="file" id="file"/>
        </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" type="submit">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>

  </div>
</div>