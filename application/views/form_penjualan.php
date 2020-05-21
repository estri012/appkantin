<div class="row">
	<div class="col-md-12">
	<form method="POST">
		<div class="form-group">
            <label>Kode Transaksi </label>
            <input type="text" class="form-control" name="kode_penjualan" id="kode_penjualan" value="<?php echo $kodeurut; ?>" readonly/>
        </div>
        <table class="table table-bordered">
        	<tr>
        		<th>No.</th>
        		<th>Kode Menu</th>
        		<th>Nama Menu</th>
            <th>Nama Tenant</th>
        		<th>Jumlah</th>
        		<th>Harga</th>
        		<th>Subtotal</th>
        		<th>
        			<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Tambah Menu</button>
        		</th>
        	</tr>
        	<tr>
        	<?php $i=1; $no=1;?>
            <?php foreach($this->cart->contents() as $items): ?>
        		<td><?php echo $no; ?></td>
                <td><?php echo $items['id']; ?></td>
                <td><?php echo $items['name']; ?></td>
                <td><?php echo $items['nama_tenant']; ?></td>
                <td><?php echo $items['qty']; ?></td>
                <td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                <td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                <td>
                    <a href="app/hapus_cart/<?php echo $items['rowid'] ?>" class="btn btn-warning btn-sm">X</a>
                </td>
        	</tr>
        	<?php $i++; $no++;?>
            <?php endforeach; ?>
            <tr>
        		<th colspan="5">Total Harga</th>
        		<th colspan="2">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></th>
        	</tr>
        </table>
        <div class="form-group">
            <label>Metode Pembayaran </label>
            <select name="metode" class="form-control" id="metode">
              <option value="Non Tunai">Non Tunai</option>
              <option value="Tunai">Tunai</option>
            </select>
        </div>
        <div class="form-group" id="input_metode">
                <label>No Pelanggan</label><br>
                
                <select id="no_pelanggan" name="no_pelanggan" class="selectpicker" class="form-control" data-live-search="true" autofocus>
                <option disabled selected value>--Scan Kartu-- </option>
                    <?php 
                    $sql = $this->db->query("SELECT * FROM pelanggan, saldo where pelanggan.no_pelanggan=saldo.no_pelanggan order by pelanggan.id_pelanggan DESC");
                    foreach ($sql->result() as $row) {
                     ?>
                    
                    <option value="<?php echo $row->no_pelanggan ?>" style="display:none;" ><?php echo $row->no_pelanggan ?></option>
                    <?php } ?>
                  </select>
            </div>

            <div class="form-group" id="id_namapelanggan" >
        <label>Nama Pelanggan</label><br>
								<input class="form-control" name="namapelanggan" id="namapelanggan" readonly type="text" value="">
				</div>
        <div class="form-group" id="id_pin">
        <label>Masukan PIN</label><br>
								<input class="form-control" placeholder="PIN" name="pin" type="password" value="">
				</div>

        <div class="form-group" id="id_jumlahbayar" style="display:none;">
        <label>Jumlah Uang yang Dibayar</label><br>
								<input class="form-control" placeholder="Jumlah Bayar" id="num1" name="num1" type="text" value="">
				</div>


        <div class="form-group" id="id_kembalian" style="display:none;" >
        <label>Kembalian</label><br>
								<input class="form-control" placeholder="Kembalian" name="subt" id="subt" readonly type="text" value="">
				</div>



        <div class="form-group">
        	<input type="hidden" id="num2" name="total_harga" value="<?php echo $this->cart->total() ?>">
        	<input type="hidden" name="tgl_penjualan" value="<?php echo date('Y-m-d') ?>">
        	<input type="hidden" name="kasir" value="<?php echo $this->session->userdata('nama') ?>">
        </div>
        <button id="bayarnontunai" type="submit" formaction="app/simpan_penjualan" class="btn btn-primary">Bayar</button>
        <button id="bayartunai"  type="submit" formaction="app/bayar_tunai" style="display: none;" class="btn btn-success">Simpan</button>
       
        <a href="app/penjualan" class="btn btn-default">Close</a>
	</form>

	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="app/simpan_cart" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Menu</h4>
      </div>
      <div class="modal-body">
      	
        <div class="form-group">
        	<label>Nama Menu</label><br>
	      <select id="nama_menu" name="nama_menu" class="selectpicker" class="form-control" data-live-search="true" title="Pilih nama menu ...">
	        <?php 
	        $sql = $this->db->get('menu');
	        foreach ($sql->result() as $row) {
	         ?>
	        <option value="<?php echo $row->kode_menu ?>"><?php echo $row->nama_menu ?></option>
	        <?php } ?>
	      </select>
	    </div>
	    <div class="form-group">
            <label>Kode menu</label>
            <input type="text" class="form-control" name="kode_menu" id="kode_menu" readonly/>
        </div>
	    <div class="form-group">
            <label>Nama Tenant</label>
            <input type="text" class="form-control" name="nama_tenant" id="nama_tenant" readonly/>
        </div>
        <div class="form-group">
            <label>Harga </label>
            <input type="text" class="form-control" name="harga" id="harga" readonly/>
        </div>
        <div class="form-group">
            <label>Jumlah Beli </label>
            <input type="number" class="form-control" name="jumlah" id="jumlah"/>
            <input type="hidden" class="form-control" name="nabar" id="nabar"/>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#nama_menu').change(function() {
      var id = $(this).val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url('app/cek_menu') ?>',
        Cache : false,
        dataType: "json",
        data : 'kode_menu='+id,
        success : function(resp) {
            $('#kode_menu').val(resp.kode_menu); 
            $('#nama_tenant').val(resp.nama_tenant); 
            $('#harga').val(resp.harga); 
            $('#nabar').val(resp.nama_menu); 
        }
      });
    });

    $('#no_pelanggan').change(function() {
      var id = $(this).val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url('app/cek_saldo') ?>',
        Cache : false,
        dataType: "json",
        data : 'no_pelanggan='+id,
        success : function(resp) {
            $('#namapelanggan').val(resp.nama); 
        }
      });
    });

    $('#metode').on('change', function() {
      if ( this.value == 'Non Tunai')
      {
        $("#input_metode").show();
        $("#id_pin").show();
        $("#id_kembalian").hide();
        $("#id_jumlahbayar").hide();
        $("#bayartunai").hide();
        $("#bayarnontunai").show();
        $("#id_namapelanggan").show();
        
        
        
      }
      else
      {
        $("#input_metode").hide();
        $("#id_pin").hide();
        $("#id_kembalian").show();
        $("#id_jumlahbayar").show();
        $("#bayartunai").show();
        $("#bayarnontunai").hide();
        $("#id_namapelanggan").hide();
      }
    });
  });


  

  $(document).ready(function() {
    //this calculates values automatically 
    sum();
    $("#num1, #num2").on("keydown keyup", function() {
        sum();
    });
});

function sum() {
            var num1 = document.getElementById('num1').value;
            var num2 = document.getElementById('num2').value;
            var kurang = "*Uang yang dimasukan kurang"
			var result1 = parseInt(num1) - parseInt(num2);
            if (result1 >= 0) {
				document.getElementById('subt').value = "Rp. "+result1;
            } else {document.getElementById('subt').value = kurang; }
        }
</script>