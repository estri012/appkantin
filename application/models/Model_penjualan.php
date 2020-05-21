<?php
// Penduduk.php
class model_penjualan extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
 
	public function graphtanggal()
	{
		
		$data = $this->db->query("	");
		return $data->result();
  }
  
  public function graphtenant()
	{
		$data = $this->db->query("SELECT nama_tenant,SUM(total_harga) as 'total' FROM `penjualan_detail` GROUP BY nama_tenant");
		return $data->result();
	}

	public function gkmingguan()
	{
		$tahun = $this->input->post('tahun');
		$data = $this->db->query("SELECT WEEK(tgl_penjualan) AS minggu, SUM(harga_total) as jumlah FROM penjualan_header where tgl_penjualan like '$tahun-%%-%%' GROUP BY WEEK(tgl_penjualan)");
		return $data->result();
	}

	public function gkbulanan()
	{
		$tahun = $this->input->post('tahun');
		$data = $this->db->query("SELECT MONTHNAME(tgl_penjualan) AS bulan, SUM(harga_total) as jumlah FROM penjualan_header where tgl_penjualan like '$tahun-%%-%%' GROUP BY MONTH(tgl_penjualan)");
		return $data->result();
	}

	public function gktahunan()
	{
		$data = $this->db->query("SELECT YEAR(tgl_penjualan) AS tahun, SUM(harga_total) as jumlah FROM penjualan_header GROUP BY YEAR(tgl_penjualan)");
		return $data->result();
	}

	public function grafikmenutenant()
	{

		$username = $this->session->userdata('username');
		$data = $this->db->query("SELECT nama_menu, SUM(total_harga) as jumlah FROM `penjualan_detail` where nama_tenant = '$username' GROUP BY nama_menu");
		return $data->result();
	}

	public function grafikharian()
	{
		$tanggal = $this->input->post('tanggal');
		$data = $this->db->query("SELECT nama_tenant,SUM(total_harga) as 'total' FROM `penjualan_detail` where tgl_penjualan = '$tanggal' GROUP BY nama_tenant");
		return $data->result();
	}

	public function grafikmingguan()
	{
		$tanggal1 = $this->input->post('tanggal1');
		$tanggal2 = $this->input->post('tanggal2');
		$data = $this->db->query("SELECT nama_tenant,SUM(total_harga) as 'total' FROM `penjualan_detail` where tgl_penjualan between '$tanggal1' and '$tanggal2' GROUP BY nama_tenant");
		return $data->result();
	}

	public function grafikbulanan()
	{
		$bulan = $this->input->post('bulan');
		$data = $this->db->query("SELECT nama_tenant,SUM(total_harga) as 'total' FROM `penjualan_detail` where tgl_penjualan like '$bulan-%%' GROUP BY nama_tenant");
		return $data->result();
	}

	public function grafiktahunan()
	{
		$tahun = $this->input->post('tahun');
		$data = $this->db->query("SELECT nama_tenant,SUM(total_harga) as 'total' FROM `penjualan_detail` where tgl_penjualan like '$tahun-%%-%%' GROUP BY nama_tenant");
		return $data->result();
	}


 
}