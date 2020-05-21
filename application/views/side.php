<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="image/user/<?php echo $this->session->userdata('foto') ?>" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $this->session->userdata('nama') ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">

		<?php 
		if ($this->session->userdata('level') == 'admin') {

		 ?>
		 	 
			<li><a href=""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="pelanggan"><em class="fa fa-user">&nbsp;</em> Data Pelanggan</a></li>
			<li><a href="tenant"><em class="fa fa-user-md">&nbsp;</em> Data Tenant</a></li>
			<li><a href="menu"><em class="fa fa-th-list">&nbsp;</em> Data Menu</a></li>
			
			
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-exchange">&nbsp;</em> Data Tenant <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="tenant">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Tenant
					</a></li>
					<li><a class="" href="setoran_tenant">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Setoran
					</a></li>
					<li><a class="" href="pengambilan_tenant">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Pengambilan
					</a></li>
				</ul>
			</li> -->
			<li><a href="saldo"><em class="fa fa-money">&nbsp;</em> Saldo</a></li>
			<li><a href="app/penjualan"><em class="fa fa-cart-plus">&nbsp;</em> Transaksi</a></li>
			<li><a href="user"><em class="fa fa-users">&nbsp;</em> Manajemen User</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-bar-chart">&nbsp;</em> Grafik Penjualan<span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="app/grafik_kantin_mingguan">
						<span class="fa fa-arrow-right">&nbsp;</span> Mingguan
					</a></li>
					<li><a class="" href="app/grafik_kantin_bulanan">
						<span class="fa fa-arrow-right">&nbsp;</span> Bulanan
					</a></li>
					<li><a class="" href="app/grafik_kantin_tahunan">
						<span class="fa fa-arrow-right">&nbsp;</span> Tahunan
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-bar-chart">&nbsp;</em> Grafik Tenant<span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					
					<li><a class="" href="app/grafik_harian">
						<span class="fa fa-arrow-right">&nbsp;</span> Harian
					</a></li>
					<li><a class="" href="app/grafik_mingguan">
						<span class="fa fa-arrow-right">&nbsp;</span> Mingguan
					</a></li>
					<li><a class="" href="app/grafik_bulanan">
						<span class="fa fa-arrow-right">&nbsp;</span> Bulanan
					</a></li>
					<li><a class="" href="app/grafik_tahunan">
						<span class="fa fa-arrow-right">&nbsp;</span> Tahunan
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-files-o">&nbsp;</em> Lap Penjualan <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					
					<!-- <li><a class="" href="app/cetak_stok" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Stok Menu
					</a></li> -->
					<li><a class="" href="app/cetak_terjual" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Menu Terjual
					</a></li>
					<li><a class="" href="app/cetak_laba" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Pendapatan Kantin
					</a></li>
					<li><a class="" href="app/cetak_transaksi" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Transaksi
					</a></li>
				</ul>
			</li>

			
			
		<?php } elseif ($this->session->userdata('level') == 'kasir') { ?>
			<li><a href="app/penjualan"><em class="fa fa-cart-plus">&nbsp;</em> Penjualan</a></li>
			
			

		<?php } elseif ($this->session->userdata('level') == 'tenant') { ?>
			<li><a href="app/saldo_tenant"><em class="fa fa-suitcase">&nbsp;</em> Dashboard Tenant</a></li>
			<li><a href="menu"><em class="fa fa-cube">&nbsp;</em> Daftar Menu</a></li>
			<li><a href="app/grafik_menu_tenant"><em class="fa fa-bar-chart">&nbsp;</em> Grafik tenant</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-files-o">&nbsp;</em> Laporan Penjualan <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					
					<li><a class="" href="app/laporan_harian">
						<span class="fa fa-arrow-right">&nbsp;</span> Laporan Harian
					</a></li>
					<li><a class="" href="app/laporan_mingguan">
						<span class="fa fa-arrow-right">&nbsp;</span> Laporan Mingguan
					</a></li>
					<li><a class="" href="app/laporan_bulanan">
						<span class="fa fa-arrow-right">&nbsp;</span> Laporan Bulanan
					</a></li>
					<li><a class="" href="app/laporan_tahunan">
						<span class="fa fa-arrow-right">&nbsp;</span> Laporan Tahunan
					</a></li>
				</ul>
			</li>

		<?php } elseif ($this->session->userdata('level') == 'pelanggan') { ?>
			<li><a href="app/saldo_pelanggan"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="app/riwayat_pemesanan"><em class="fa fa-history">&nbsp;</em> Riwayat Pemesanan</a></li>
			<li><a href="app/riwayat_saldo_pelanggan"><em class="fa fa-history">&nbsp;</em> Riwayat Isi Ulang</a></li>
			

		<?php }?> 

			<li><a href="app/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div>