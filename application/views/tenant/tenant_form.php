<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama_tenant" id="nama_tenant" placeholder="Nama Tenant" value="<?php echo $nama_tenant; ?>" />
        </div>
        <div class="form-group">
            <label for="alamat">Nomor Telpon <?php echo form_error('no_telpon') ?></label>
            <input class="form-control" type="text" name="no_telpon" id="no_telpon" placeholder="Nomor Telpon" value="<?php echo $no_telpon; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
        </div>
        <input type="hidden" name="id_tenant" value="<?php echo $id_tenant; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('tenant') ?>" class="btn btn-default">Cancel</a>
    </form>