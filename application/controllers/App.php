<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {


	public function index()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} elseif ($this->session->userdata('level') == "admin") {

			$data = array(
				'konten' => 'v_home',
				'jdl' => 'Dashboard',
			);
			$this->load->view('v_index',$data);
			
		}

		elseif ($this->session->userdata('level') == "tenant") {

			$data = array(
				'konten' => 'v_saldo_tenant',
				'jdl' => 'Dashboard Tenant',
			);
			$this->load->view('v_index',$data);
			
		} elseif ($this->session->userdata('level') == "pelanggan") {

			$data = array(
				'konten' => 'v_saldo_pelanggan',
				'jdl' => 'Dashboard pelanggan',
			);
			$this->load->view('v_index',$data);
		
			
		} elseif ($this->session->userdata('level') == "kasir") {

			$data = array(
				'konten' => 'penjualan',
				'jdl' => 'Data Penjualan',
			);
			$this->load->view('v_index',$data);
		
			
		}

	
		
	}

	public function riwayat_saldo()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'riwayat_saldo',
			'jdl' => 'Riwayat Isi Ulang dan Penarikan',
		);
		$this->load->view('v_index',$data);
	}

	public function riwayat_saldo_pelanggan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'riwayat_saldo_pelanggan',
			'jdl' => 'Riwayat Isi Ulang dan Penarikan',
		);
		$this->load->view('v_index',$data);
	}
	
	public function riwayat_pemesanan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'riwayat_pemesanan',
			'jdl' => 'Riwayat Pemesanan',
		);
		$this->load->view('v_index',$data);
	}

	public function chart_tanggal()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		$data = array(
			'konten' => 'chart_tanggal',
			'jdl' => 'Grafik Penjualan',
			'graphtanggal' => $this->model_penjualan->graphtanggal(),
		);
		$this->load->view('v_index',$data);
	}

	public function chart_tenant()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		$data = array(
			'konten' => 'chart_tenant',
			'jdl' => 'Grafik Penjualan Tenant',
			'graphtenant' => $this->model_penjualan->graphtenant(),
		);
		$this->load->view('v_index',$data);
	}


	public function brg_tenant()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'v_tenant',
			'jdl' => 'menu tenant',
		);
		$this->load->view('v_index',$data);
	}

	public function saldo_tenant()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'v_saldo_tenant',
			'jdl' => 'saldo tenant',
		);
		$this->load->view('v_index',$data);
	}

	public function saldo_pelanggan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'v_saldo_pelanggan',
			'jdl' => 'saldo pelanggan',
		);
		$this->load->view('v_index',$data);
	}

	public function ubahpassword()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'ubahpassword',
			'jdl' => 'Akun Anda',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_ubahpassword()
	{
		$username = $this->input->post('username');
		$pswlama = $this->input->post('pswlama');
		$pswbaru = $this->input->post('pswbaru');
		$id_user = $this->input->post('id_user');

		$cekpsw = $this->db->query("SELECT * FROM user where password='$pswlama'");
		if ($cekpsw->num_rows() == 1) {
			$this->db->where('id_user', $id_user);
			$this->db->update('user', array('password'=>$pswbaru));
			$this->logout();
		} else {
			?>
			<script type="text/javascript">
				alert('password kamu salah');
				window.location="<?php echo base_url() ?>app/ubahpassword";
			</script>
			<?php
		}		
	}

	public function cek_menu()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $kode_menu = $this->input->post('kode_menu');
        $cek = $this->db->query("SELECT * FROM menu WHERE kode_menu='$kode_menu'")->row();
		$data = array(
			'harga' => $cek->harga,
			'kode_menu' => $cek->kode_menu,
			'nama_menu' => $cek->nama_menu,
			'nama_tenant' => $cek->nama_tenant,
		);
		echo json_encode($data);
	}

	public function cek_saldo()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $no_pelanggan = $this->input->post('no_pelanggan');
		$cek = $this->db->query("SELECT * FROM saldo WHERE no_pelanggan='$no_pelanggan'")->row();
		$cek2 = $this->db->query("SELECT * FROM pelanggan WHERE no_pelanggan='$no_pelanggan'")->row();
		$data = array(
			'saldo' => $cek->saldo,
			'nama' => $cek2->nama,
		);
		echo json_encode($data);
	}

	



	public function export_pelanggan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_pelanggan');
	}

	public function export_menu()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_menu');
	}

	public function hapus_semua_pelanggan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->db->delete('pelanggan');
        redirect('pelanggan','refresh');
	}

	public function export_saldo()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_saldo');
	}

	public function export_penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_penjualan');
	}

	public function export_tenant()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->view('export_tenant');
	}

	public function cek_metode()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $id = $this->input->post('id');
        if ($id =='CASH') {
        	# code...
        } else {
        	?>
        	
        	<?php
        }
	}

	public function simpan_cart()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
            'id'    => $this->input->post('kode_menu'),
            'qty'   => $this->input->post('jumlah'),
            'price' => $this->input->post('harga'),
			'name'  => $this->input->post('nabar'),
			'nama_tenant'  => $this->input->post('nama_tenant'),
        );
        $this->cart->insert($data);
        redirect('app/tambah_penjualan');
	}

	public function hapus_cart($id)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
            'rowid'    => $id,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect('app/tambah_penjualan');
	}
	

	public function penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'penjualan',
			'jdl' => 'Data Penjualan',
		);
		$this->load->view('v_index',$data);
	}

	public function cetak_stok()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$this->load->view('cetak_stok');
	}

	public function cetak_terjual()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'cetak_terjual',
			'jdl' => 'menu Terjual',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_cetakterjual()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * from penjualan_detail where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_terjual', $data);
	}

	public function cetak_laba()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'laba',
			'jdl' => 'Pendapatan Kantin',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_cetaklaba()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT *, (total_harga * 0.15) as untung FROM penjualan_detail where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_laba', $data);
	}

	public function cetak_transaksi()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'transaksi',
			'jdl' => 'Transaksi Penjualan',
		);
		$this->load->view('v_index',$data);
	}

	public function aksi_cetaktransaksi()
	{
		if ($this->session->userdata('level') == "") {
			redirect('app/login');
		 } 
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cetak = $this->db->query("SELECT * FROM penjualan_header where tgl_penjualan BETWEEN '$tgl1' and '$tgl2' ");
		$data = array(
			'tgl1' => $tgl1,
			'tgl2' => $tgl2,
			'cetak' => $cetak,
		);
		$this->load->view('v_cetak_transaksi', $data);
	}

	public function grafik_kantin_mingguan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_kantin_mingguan',
			'jdl' => 'Grafik Penjualan Per Minggu',
			'gkmingguan' => $this->model_penjualan->gkmingguan(),
		);
		$this->load->view('v_index',$data);
	}

	public function grafik_kantin_bulanan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_kantin_bulanan',
			'jdl' => 'Grafik Penjualan Per Bulan',
			'gkbulanan' => $this->model_penjualan->gkbulanan(),
		);
		$this->load->view('v_index',$data);
	}

	public function grafik_kantin_tahunan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_kantin_tahunan',
			'jdl' => 'Grafik Penjualan Per Tahun',
			'gktahunan' => $this->model_penjualan->gktahunan(),
		);
		$this->load->view('v_index',$data);
	}

	public function grafik_menu_tenant()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_menu_tenant',
			'jdl' => 'Grafik Penjualan',
			'grafikmenutenant' => $this->model_penjualan->grafikmenutenant(),
		);
		$this->load->view('v_index',$data);
	}
	
	public function grafik_harian()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_harian',
			'jdl' => 'Grafik Pendapatan Tenant Harian',
			'grafikharian' => $this->model_penjualan->grafikharian(),
		);
		$this->load->view('v_index',$data);
	}

	public function grafik_mingguan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_mingguan',
			'jdl' => 'Grafik Pendapatan Tenant Mingguan',
			'grafikmingguan' => $this->model_penjualan->grafikmingguan(),
		);
		$this->load->view('v_index',$data);
	}

	public function grafik_bulanan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_bulanan',
			'jdl' => 'Grafik Pendapatan Tenant Bulanan',
			'grafikbulanan' => $this->model_penjualan->grafikbulanan(),
		);
		$this->load->view('v_index',$data);
	}

	public function grafik_tahunan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$this->load->model('model_penjualan');
		
		$data = array(
			'konten' => 'grafik_tahunan',
			'jdl' => 'Grafik Pendapatan Tenant Tahunan',
			'grafiktahunan' => $this->model_penjualan->grafiktahunan(),
		);
		$this->load->view('v_index',$data);
	}

	public function laporan_harian()
	{
		
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$data = array(
			'konten' => 'laporan_harian',
			'jdl' => 'Laporan Harian',
		);
		$this->load->view('v_index',$data);
	}
	
	public function cetak_laporan_harian()
	{
		if ($this->session->userdata('level') == "") {
			redirect('app/login');
		 } 
		$tanggal = $this->input->post('tanggal');
		$username = $this->session->userdata('username');
		$cetak = $this->db->query("SELECT * From penjualan_detail, penjualan_header, pelanggan where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan = '$tanggal'    ");
		$data = array(
			'tanggal' => $tanggal,
			'username' => $username,
			'cetak' => $cetak,
		);
		$this->load->view('aksi_cetak_harian', $data);
	}

	public function laporan_mingguan()
	{
		
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$data = array(
			'konten' => 'laporan_mingguan',
			'jdl' => 'Laporan Mingguan',
		);
		$this->load->view('v_index',$data);
	}

	public function cetak_laporan_mingguan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$tanggal1 = $this->input->post('tanggal1');
		$tanggal2 = $this->input->post('tanggal2');
        $username = $this->session->userdata('username');
		$cetak = $this->db->query("SELECT * From penjualan_detail, penjualan_header, pelanggan where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan between '$tanggal1' and '$tanggal2'    ");
		$data = array(
			'tanggal1' => $tanggal1,
			'tanggal2' => $tanggal2,
			'username' => $username,
			'cetak' => $cetak,
		);
		$this->load->view('aksi_cetak_mingguan', $data);
	}

	public function laporan_bulanan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$data = array(
			'konten' => 'laporan_bulanan',
			'jdl' => 'Laporan Bulanan',
		);
		$this->load->view('v_index',$data);
	}

	public function cetak_laporan_bulanan()
	{
		if ($this->session->userdata('level') == "") {
			redirect('app/login');
		 } 
		 $bulan = $this->input->post('bulan');
		 $username = $this->session->userdata('username');
		 $cetak = $this->db->query("SELECT * From penjualan_detail, penjualan_header, pelanggan where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$bulan-%%'    ");
		 $data = array(
			'bulan' => $bulan,
			'username' => $username,
			'cetak' => $cetak,
		);
		$this->load->view('aksi_cetak_bulanan', $data);
	}

	public function laporan_tahunan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
		} 
		$data = array(
			'konten' => 'laporan_tahunan',
			'jdl' => 'Laporan Tahunan',
		);
		$this->load->view('v_index',$data);
	}

	public function cetak_laporan_tahunan()
	{
		if ($this->session->userdata('level') == "") {
			redirect('app/login');
		 } 
		$tahun = $this->input->post('tahun');
        $username = $this->session->userdata('username');
		$cetak = $this->db->query("SELECT * From penjualan_detail, penjualan_header, pelanggan where penjualan_header.no_pelanggan=pelanggan.no_pelanggan and penjualan_detail.kode_penjualan = penjualan_header.kode_penjualan and penjualan_detail.nama_tenant = '$username' and penjualan_header.tgl_penjualan like '$tahun-%%-%%'    ");
		$data = array(
			'tahun' => $tahun,
			'username' => $username,
			'cetak' => $cetak,
		);
		$this->load->view('aksi_cetak_tahunan', $data);
	}


	public function detail_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
		$data = array(
			'konten' => 'detail_penjualan',
			'jdl' => 'Detail Penjualan',
			'data' => $this->db->query("SELECT * FROM penjualan_header as a, pelanggan as b WHERE a.no_pelanggan=b.no_pelanggan and a.kode_penjualan='$kode_penjualan'"),
		);
		$this->load->view('v_index',$data);
	}

	public function hapus_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->delete('penjualan_header');
		$this->db->where('kode_penjualan', $kode_penjualan);
		$this->db->delete('penjualan_detail');
		?>
		<script type="text/javascript">
			alert('Berhapus Hapus Data');
			window.location='<?php echo base_url('app/penjualan') ?>';
		</script>
		<?php
	}

	public function cetak_penjualan($kode_penjualan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM penjualan_header as a, pelanggan as b WHERE a.no_pelanggan=b.no_pelanggan and a.kode_penjualan='$kode_penjualan'"),
		);
		$this->load->view('cetak_penjualan',$data);
	}

	public function cetak_saldo($no_pelanggan)
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $data = array(
			'data' => $this->db->query("SELECT * FROM saldo as a, pelanggan as b WHERE a.no_pelanggan=b.no_pelanggan and a.no_pelanggan='$no_pelanggan'"),
		);
		$this->load->view('cetak_saldo',$data);
	}

	public function tambah_penjualan()
	{
		if ($this->session->userdata('level') == "") {
           redirect('app/login');
        } 
        $this->load->model('No_urut');
		$data = array(
			'konten' => 'form_penjualan',
			'jdl' => 'Tambah Penjualan',
			'kodeurut' => $this->No_urut->buat_kode_penjualan(),
		);
		$this->load->view('v_index',$data);
	}

	
	public function simpan_penjualan()
	{
		$no_pelanggan = $this->input->post('no_pelanggan');
		$pin = $this->input->post('pin');

		$cek_pin = $this->db->query("SELECT * FROM pelanggan WHERE no_pelanggan='$no_pelanggan' and pin='$pin' "); 
		if ($cek_pin->num_rows() == 1) {
			foreach ($cek_pin->result() as $row) {
				$sess_data['no_pelanggan'] = $row->no_pelanggan;
				$sess_data['pin'] = $row->pin;
				$this->session->set_userdata($sess_data);
			}

			if ($this->session->userdata('level') == "") {
				redirect('app/login');
			 } 
			 $kode_penjualan = $this->input->post('kode_penjualan');
			 $no_pelanggan = $this->input->post('no_pelanggan');
			 $total_harga = $this->input->post('total_harga');
			 $tgl_penjualan = $this->input->post('tgl_penjualan');
			 $kasir = $this->input->post('kasir');
			 
			 
			 foreach ($this->cart->contents() as $items) {
				 $kode_menu = $items['id'];
				 $qty = $items['qty'];
				 $nama_tenant= $items['nama_tenant'];
				 $nama_menu= $items['name'];
				 $harga = $items['price'];
				 $total = $items['subtotal'];
				 $d = array(
					 'kode_penjualan' => $kode_penjualan,
					 'tgl_penjualan' => $tgl_penjualan,
					 'kode_menu' => $kode_menu,
					 'nama_menu' => $nama_menu,
					 'nama_tenant' => $nama_tenant,
					 'qty' => $qty,
					 'harga' => $harga,
					 'total_harga' => $total,
				 );
				 $this->db->insert('penjualan_detail', $d);
				//  $this->db->query("UPDATE menu SET stok=stok-'$qty' WHERE kode_menu='$kode_menu'");
			 }
	 
			 $data = array(
				 'kode_penjualan'=> $kode_penjualan,
				 'no_pelanggan'=> $no_pelanggan,
				 'harga_total'=> $total_harga,
				 'tgl_penjualan'=> $tgl_penjualan,
				 'kasir'=> $kasir,
			 );
			 $this->db->insert('penjualan_header', $data);
			 $this->db->query("UPDATE saldo SET saldo=saldo-'$total_harga', pengeluaran=pengeluaran+'$total_harga' WHERE no_pelanggan='$no_pelanggan'");
			 $this->cart->destroy();
			 redirect('app/penjualan');


			
			
		} else {
			?>
			<script type="text/javascript">
				alert('Pin anda salah !');
				window.location="<?php echo base_url('app/tambah_penjualan'); ?>";
			</script>
			<?php
			
		}

	}

	public function bayar_tunai()
	{

			if ($this->session->userdata('level') == "") {
				redirect('app/login');
			 } 
			 $kode_penjualan = $this->input->post('kode_penjualan');
			 $no_pelanggan = "*Bayar Tunai";
			 $total_harga = $this->input->post('total_harga');
			 $tgl_penjualan = $this->input->post('tgl_penjualan');
			 $kasir = $this->input->post('kasir');
			 
			 foreach ($this->cart->contents() as $items) {
				 $kode_menu = $items['id'];
				 $qty = $items['qty'];
				 $nama_tenant= $items['nama_tenant'];
				 $nama_menu= $items['name'];
				 $harga = $items['price'];
				 $total = $items['subtotal'];
				 $d = array(
					 'kode_penjualan' => $kode_penjualan,
					 'tgl_penjualan' => $tgl_penjualan,
					 'kode_menu' => $kode_menu,
					 'nama_menu' => $nama_menu,
					 'nama_tenant' => $nama_tenant,
					 'qty' => $qty,
					 'harga' => $harga,
					 'total_harga' => $total,
				 );
				 $this->db->insert('penjualan_detail', $d);
				//  $this->db->query("UPDATE menu SET stok=stok-'$qty' WHERE kode_menu='$kode_menu'");
			 }
	 
			 $data = array(
				 'kode_penjualan'=> $kode_penjualan,
				 'no_pelanggan'=> $no_pelanggan,
				 'harga_total'=> $total_harga,
				 'tgl_penjualan'=> $tgl_penjualan,
				 'kasir'=> $kasir,
			 );
			 $this->db->insert('penjualan_header', $data);
			 $this->cart->destroy();
			 redirect('app/penjualan');


			
			
		

	}

	


	public function login()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$unit = $this->input->post('unit');
			
			$cek_user = $this->db->query("SELECT * FROM user WHERE username='$username' and password='$password' ");
				if ($cek_user->num_rows() == 1) {
					foreach ($cek_user->result() as $row) {
						$sess_data['id_user'] = $row->id_user;
						$sess_data['foto'] = $row->foto;
						$sess_data['nama'] = $row->nama_lengkap;
						$sess_data['username'] = $row->username;
						$sess_data['level'] = $row->level;
						$sess_data['no_pelanggan'] = $row->no_pelanggan;
						$this->session->set_userdata($sess_data);
					}
					redirect('app');
					
				} else {
					?>
					<script type="text/javascript">
						alert('Username dan password kamu salah !');
						window.location="<?php echo base_url('app/login'); ?>";
					</script>
					<?php
				}

		}
	}

	
	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('unit');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('no_pelanggan');
		session_destroy();
		redirect('app');
	}

}