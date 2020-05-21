

    <div class="row">
	<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">
								<?php 
                                $username = $this->session->userdata('username');                                
                                $sql=$this->db->query("SELECT * From penjualan_detail where nama_tenant = '$username' ");
                                 foreach ($sql->result() as $rw) {
                                     $total_harga = $total_harga+$rw->total_harga;
                                 }
                                 echo number_format($total_harga);
								 ?>				
							</div>
							<div class="text-muted">Total Penjualan</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-blue panel-widget border-right"><em class="fa fa-xl fa-money color-orange"></em>
						<div class="row no-padding">
							<div class="large">
								<?php 
								 $total_harga= 0;
                                 $username = $this->session->userdata('username');                                
                                 $sql=$this->db->query("SELECT (total_harga * 0.85) as pendapatan_tenant From penjualan_detail where nama_tenant = '$username' ");
                                 foreach ($sql->result() as $rw) {
                                     $pendapatan_tenant = $pendapatan_tenant+$rw->pendapatan_tenant;
                                 }
                                 echo number_format($pendapatan_tenant);
                                  ?>
							</div>
							<div class="text-muted">Saldo Tenant</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-money color-red"></em>
							<div class="large">
								<?php 
                                $username = $this->session->userdata('username');
                                $sql=$this->db->query("SELECT (total_harga * 0.15) as pendapatan_kantin From penjualan_detail where nama_tenant = '$username' ");
                                 foreach ($sql->result() as $rw) {
                                     $pendapatan_kantin = $pendapatan_kantin+$rw->pendapatan_kantin;
                                 }
                                 echo number_format($pendapatan_kantin);                               
                                
								 ?>
							</div>
							<div class="text-muted">Biaya Operasional Kantin</div>
						</div>
					</div>
				</div>
</div>


        

