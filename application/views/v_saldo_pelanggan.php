

    <div class="row">
	<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-money color-orange"></em>
							<div class="large">
								<?php 
                                $no_pelanggan = $this->session->userdata('no_pelanggan');                                
                                $sql=$this->db->query("SELECT saldo From saldo where no_pelanggan = '$no_pelanggan' ");
                                
                                $saldo =  $rw->saldo;
                                foreach ($sql->result() as $rw) {
                                     $saldo = $rw->saldo;
                                 }
                                 echo number_format($saldo);
								 ?>				
							</div>
							<div class="text-muted">Saldo</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-blue panel-widget border-right"><em class="fa fa-xl fa-money color-red"></em>
						<div class="row no-padding">
							<div class="large">
								<?php 
								 $no_pelanggan = $this->session->userdata('no_pelanggan');                                
                                 $sql=$this->db->query("SELECT pengeluaran From saldo where no_pelanggan = '$no_pelanggan' ");
                                 
                                 $pengeluaran =  $rw->pengeluaran;
                                 foreach ($sql->result() as $rw) {
                                      $pengeluaran = $rw->pengeluaran;
                                  }
                                  echo number_format($pengeluaran);
                                  ?>
							</div>
							<div class="text-muted">Pengeluaran</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">
                            <?php 
                             $no_pelanggan = $this->session->userdata('no_pelanggan');
								$sql=$this->db->query("SELECT * From penjualan_header where no_pelanggan = '$no_pelanggan'");
								echo $sql->num_rows();
								 ?>
							</div>
							<div class="text-muted">Jumlah Pesanan</div>
						</div>
					</div>
				</div>
</div>


        

