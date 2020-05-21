<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
        <div class="form-group">
            <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
        </div>
        <div class="form-group">
            <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">PIN </label>
            <input type="text" class="form-control" name="pin" id="pin" placeholder="PIN" value="<?php echo $pin; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Kartu <?php echo form_error('no_pelanggan') ?></label>
            <input type="text" class="form-control" name="no_pelanggan" id="no_pelanggan" placeholder="Scan Kartu Anda!" value="<?php echo $no_pelanggan; ?>" />
        </div>
        <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pelanggan') ?>" class="btn btn-default">Cancel</a>
    </form>