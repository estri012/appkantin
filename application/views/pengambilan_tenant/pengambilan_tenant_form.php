<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Menu <?php echo form_error('kode_menu') ?></label>
            <!-- <input type="text" class="form-control" name="kode_menu" id="kode_menu" placeholder="Kode Menu" value="<?php echo $kode_menu; ?>" /> -->
            <br>
            <select id="nama_menu" name="kode_menu" class="selectpicker" class="form-control" data-live-search="true" >
            <option value="<?php echo $kode_menu; ?>"><?php echo $kode_menu; ?></option>
            <?php
            $sql = $this->db->get('menu');
            foreach ($sql->result() as $row) {
             ?>
            <option value="<?php echo $row->kode_menu ?>"><?php echo $row->kode_menu ?>-<?php echo $row->nama_menu ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label for="date">Tgl Pengambilan <?php echo form_error('tgl_pengambilan') ?></label>
            <input type="date" class="form-control" name="tgl_pengambilan" id="tgl_pengambilan" placeholder="Tgl Pengambilan" value="<?php echo $tgl_pengambilan; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jumlah Terjual<?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Sisa Menu <?php echo form_error('sisa_menu') ?></label>
            <input type="text" class="form-control" name="sisa_menu" id="sisa_menu" placeholder="Sisa Menu" value="<?php echo $sisa_menu; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Nominal Uang <?php echo form_error('nominal_uang') ?></label>
            <input type="text" class="form-control" name="nominal_uang" id="nominal_uang" placeholder="Nominal Uang" value="<?php echo $nominal_uang; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Petugas <?php echo form_error('petugas') ?></label>
            <input type="text" class="form-control" name="petugas" id="petugas" placeholder="Petugas" value="<?php echo $this->session->userdata('nama'); ?>" />
        </div>
        <input type="hidden" name="id_pengambilan" value="<?php echo $id_pengambilan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pengambilan_tenant') ?>" class="btn btn-default">Cancel</a>
    </form>

    <script type="text/javascript">
  $(document).ready(function(){
    $('#nama_menu').change(function() {
      var id = $(this).val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url('app/cek_menu_tenant') ?>',
        Cache : false,
        dataType: "json",
        data : 'kode_menu='+id,
        success : function(resp) {
            $('#jumlah').val(resp.terjual); 
            $('#sisa_menu').val(resp.stok); 
            $('#nominal_uang').val(resp.nominal); 
        }
      });
    });
    
  });
</script>