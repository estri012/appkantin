 <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Menu <?php echo form_error('kode_menu') ?></label>
            <input type="text" class="form-control" name="kode_menu" id="kode_menu" placeholder="Kode Menu" value="<?php echo $kode_menu; ?>" readonly/>
        </div>
        
        <div class="form-group">
            <label> Nama Tenant</label>
            <br>
          <select id="nama_tenant" name="nama_tenant" class="selectpicker" class="form-control" data-live-search="true" autofocus>
          <option disabled selected value>--Pilih Tenant-- </option>
            <?php 
            $this->db->order_by('nama_tenant','desc');
            $sql = $this->db->get('tenant');
            foreach ($sql->result() as $row) {
             ?>
           
            <option value="<?php echo $row->nama_tenant ?>"><?php echo $row->nama_tenant ?></option>
            <?php } ?>
          </select>
        </div>
        
        <div class="form-group">
            <label for="varchar">Nama Menu <?php echo form_error('nama_menu') ?></label>
            <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu" value="<?php echo $nama_menu; ?>" />
        </div>

        <div class="form-group">
            <label for="int">Harga<?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
        <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a>
    </form>