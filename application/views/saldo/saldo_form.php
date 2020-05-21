<form method="post">
        <div class="form-group">
            <label for="varchar">No Kartu <?php echo form_error('no_pelanggan') ?></label>
            <!-- <input type="text" class="form-control" name="no_pelanggan" id="no_pelanggan" placeholder="No Pelanggan" value="<?php echo $no_pelanggan; ?>" /> -->
            <br>
          <select id="no_pelanggan" name="no_pelanggan" class="selectpicker" class="form-control" data-live-search="true" autofocus>
          <option disabled selected value>--Scan Kartu-- </option>
            <?php 
            $this->db->order_by('id_pelanggan','desc');
            $sql = $this->db->get('pelanggan');
            foreach ($sql->result() as $row) {
             ?>
           
            <option value="<?php echo $row->no_pelanggan ?>"><?php echo $row->no_pelanggan.' - '.$row->nama ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label>Jenis Transaksi </label>
            <select name="metode" class="form-control" id="metode">
              <option value="topup">Isi Ulang Saldo</option>
              <option value="tarik">Tarik Tunai</option>
            </select>
        </div>
        <div class="form-group" id="id_sisasaldo" style="display:none;">
        <label>Sisa Saldo</label><br>
								<input class="form-control" name="sisasaldo" id="sisasaldo" readonly type="text" value="">
				</div>
        <div class="form-group" id="id_topup">
            <label for="int">Isi Ulang <?php echo form_error('saldo_tambahan') ?></label>
            <input type="number" class="form-control" name="saldo_tambahan" id="saldo_tambahan" placeholder="Jumlah Saldo Top-Up" value="<?php echo $saldo_tambahan; ?>" />
        </div>
        <div class="form-group" id="id_tarik" style="display:none;">
            <label for="int">Tarik Tunai <?php echo form_error('tarik_tunai') ?></label>
            <input type="number" class="form-control" name="tarik_tunai" id="tarik_tunai" placeholder="Jumlah Saldo Tarik Tunai" value="<?php echo $tarik_tunai; ?>"/>
        </div>

        <div>

    
        
        <div class="form-group" id="id_pin">
        <label>Masukan PIN</label><br>
								<input class="form-control" placeholder="PIN" name="pin" type="password" value="">
				</div>
        
        <input type="hidden" name="id_saldo" value="<?php echo $id_saldo; ?>" /> 
        <button id="tombol_topup" type="submit" formaction="saldo/create_action" class="btn btn-primary">Top Up</button>
        <button id="tombol_tarik"  type="submit" formaction="saldo/tarik_tunai" style="display: none;" class="btn btn-success">Ambil Uang</button>
        <a href="<?php echo site_url('saldo') ?>" class="btn btn-default">Cancel</a>
    </form>


    <script type="text/javascript">
  $(document).ready(function(){


    $('#no_pelanggan').change(function() {
      var id = $(this).val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url('app/cek_saldo') ?>',
        Cache : false,
        dataType: "json",
        data : 'no_pelanggan='+id,
        success : function(resp) {
            $('#sisasaldo').val("Rp. "+resp.saldo); 
        }
      });
    });
    $('#metode').on('change', function() {
      if ( this.value == 'topup')
      {
        $("#id_topup").show();
        $("#id_tarik").hide();
        $("#tombol_topup").show();
        $("#tombol_tarik").hide();
        $("#id_sisasaldo").hide();
        
        
      }
      else
      {
        $("#id_topup").hide();
        $("#id_tarik").show();
        $("#tombol_topup").hide();
        $("#tombol_tarik").show();
        $("#id_sisasaldo").show();

      }
    });
    
  });
</script>