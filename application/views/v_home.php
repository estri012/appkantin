<div class="row ">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding" >
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">
								<?php 
                                $sql=$this->db->query("SELECT total_harga as pendapatan_kantin From penjualan_detail ");
                                 foreach ($sql->result() as $rw) {
                                     $pendapatan_kantin = $pendapatan_kantin+$rw->pendapatan_kantin;
                                 }
								 echo number_format($pendapatan_kantin);
								 ?> 
								
							</div>
							<div class="text-muted">Total Penjualan</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-money color-orange"></em>
							<div class="large">
								<?php 
								$sql=$this->db->query("SELECT (total_harga * 0.15) as saldo_kantin From penjualan_detail ");
								foreach ($sql->result() as $rw) {
									$saldo_kantin = $saldo_kantin+$rw->saldo_kantin;
								}
								echo number_format($saldo_kantin);
								?> 
							</div>
							<div class="text-muted">Pendapatan Kantin</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-google-wallet color-red"></em>
							<div class="large">
							<?php 
								$saldo = 0;
								$sql=$this->db->query("SELECT * From saldo");
								foreach ($sql->result() as $rw) {
									$saldo = $saldo+$rw->saldo;
								}
								echo number_format($saldo);

								 ?>	
							</div>
							<div class="text-muted">Saldo E-Money</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large">
								<?php 
								$sql=$this->db->query("SELECT * From pelanggan");
								echo $sql->num_rows();
								 ?>
							</div>
							<div class="text-muted">Jumlah Pelanggan</div>
						</div>
					</div>
				</div>
</div>


<div class="alert alert-success">
	<center>
		<img src="image/headerhijau.png">
	</center>
<marquee>
		<h2>AppKantin Fakultas Teknik UGM</h2>
</marquee>
</div>