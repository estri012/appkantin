<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saldo extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Saldo_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'saldo/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'saldo/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'saldo/index.html';
            $config['first_url'] = base_url() . 'saldo/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Saldo_model->total_rows($q);
        $saldo = $this->Saldo_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'saldo_data' => $saldo,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'saldo/saldo_list',
            'jdl' => 'Saldo Pelanggan',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Saldo_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_saldo' => $row->id_saldo,
        'saldo' => $row->saldo,
        'saldo_tambahan' => $row->saldo_tambahan,
		'tarik_tunai' => $row->tarik_tunai,
		'no_pelanggan' => $row->no_pelanggan,
	    );
            $this->load->view('saldo/saldo_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('saldo/create_action'),
	    'id_saldo' => set_value('id_saldo'),
        'saldo' => set_value('saldo'),
        'saldo_tambahan' => set_value('saldo_tambahan'),
	    'tarik_tunai' => set_value('tarik_tunai'),
	    'no_pelanggan' => set_value('no_pelanggan'),
        'konten' => 'saldo/saldo_form',
            'jdl' => 'Menu Saldo',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $jam = date('H:i:s');
            $no_pelanggan = $this->input->post('no_pelanggan');
            $saldo_tambahan = $this->input->post('saldo_tambahan',TRUE);
            //$tarik_tunai = $this->input->post('tarik_tunai',TRUE);
            $waktu = date('d-m-Y').' '.$jam;
            $pin = $this->input->post('pin');
            $tipe = "Isi Ulang";
            $cek_pin = $this->db->query("SELECT * FROM pelanggan WHERE no_pelanggan='$no_pelanggan' and pin='$pin' "); 
		if ($cek_pin->num_rows() == 1) {
			foreach ($cek_pin->result() as $row) {
				$sess_data['no_pelanggan'] = $row->no_pelanggan;
				$sess_data['pin'] = $row->pin;
				$this->session->set_userdata($sess_data);
            }
            
            $cek = $this->db->query("SELECT * FROM saldo where no_pelanggan='$no_pelanggan'");
            if ($cek->num_rows() != 0) {
                    
                $this->db->query("UPDATE saldo SET saldo=saldo+'$saldo_tambahan',waktu='$waktu' WHERE no_pelanggan='$no_pelanggan'");
                $data2 = array(
                    'perubahan_saldo' => $this->input->post('saldo_tambahan',TRUE),
                    'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
                    'waktu' => date('d-m-Y').' '.$jam,
                    'tipe' => $tipe,
                    );
                $this->Saldo_model->insert2($data2);
               
                $this->session->set_flashdata('message', 'Berhasil Menambahkan Saldo');
                redirect(site_url('saldo'));
            } else {
                $data = array(
                    'saldo' => $this->input->post('saldo_tambahan',TRUE),
                    'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
                    'waktu' => date('d-m-Y').' '.$jam,
                    );
                $this->Saldo_model->insert($data);

                $data2 = array(
                    'perubahan_saldo' => $this->input->post('saldo_tambahan',TRUE),
                    'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
                    'waktu' => date('d-m-Y').' '.$jam,
                    'tipe' => $tipe,
                    );
                $this->Saldo_model->insert2($data2);
                
                $this->session->set_flashdata('message', 'Berhasil Menambahkan Saldo');
                redirect(site_url('saldo'));
            }
			
			
		} else {
			?>
			<script type="text/javascript">
				alert('Pin anda salah !');
				window.location="<?php echo base_url('saldo/create'); ?>";
			</script>
			<?php
			
		}
        }
    }

    public function tarik_tunai() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $jam = date('H:i:s');
            $no_pelanggan = $this->input->post('no_pelanggan');
            $tarik_tunai = $this->input->post('tarik_tunai',TRUE);
            $waktu = date('d-m-Y').' '.$jam;
            $pin = $this->input->post('pin');
            $tipe = "Tarik Tunai";
            $cek_pin = $this->db->query("SELECT * FROM pelanggan WHERE no_pelanggan='$no_pelanggan' and pin='$pin' "); 
		if ($cek_pin->num_rows() == 1) {
			foreach ($cek_pin->result() as $row) {
				$sess_data['no_pelanggan'] = $row->no_pelanggan;
				$sess_data['pin'] = $row->pin;
				$this->session->set_userdata($sess_data);
            }
            
            $this->db->query("UPDATE saldo SET saldo=saldo-'$tarik_tunai',waktu='$waktu' WHERE no_pelanggan='$no_pelanggan'");
                $data2 = array(
                    'perubahan_saldo' => -$tarik_tunai,
                    'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
                    'waktu' => date('d-m-Y').' '.$jam,
                    'tipe' => $tipe,
                    );
                $this->Saldo_model->insert2($data2);
               
                $this->session->set_flashdata('message', 'Berhasil Menarik Saldo');
                redirect(site_url('saldo'));
			
			
		} else {
			?>
			<script type="text/javascript">
				alert('Pin anda salah !');
				window.location="<?php echo base_url('saldo/create'); ?>";
			</script>
			<?php
			
		}
            
            
            
        }
    }
    
    public function update($id) 
    {
        $row = $this->Saldo_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('saldo/update_action'),
		'id_saldo' => set_value('id_saldo', $row->id_saldo),
        'saldo' => set_value('saldo', $row->saldo),
        'saldo_tambahan' => set_value('saldo_tambahan', $row->saldo_tambahan),
		'tarik_tunai' => set_value('tarik_tunai', $row->tarik_tunai),
		'no_pelanggan' => set_value('no_pelanggan', $row->no_pelanggan),
        'konten' => 'saldo/saldo_form',
            'jdl' => 'Saldo Pelanggan',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_saldo', TRUE));
        } else {
            $data = array(
        'saldo' => $this->input->post('saldo',TRUE),
        'saldo_tambahan' => $this->input->post('saldo_tambahan',TRUE),
		'tarik_tunai' => $this->input->post('tarik_tunai',TRUE),
		'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
	    );

            $this->Saldo_model->update($this->input->post('id_saldo', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('saldo'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Saldo_model->get_by_id($id);

        if ($row) {
            $this->Saldo_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('saldo'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo'));
        }
    }

    public function _rules() 
    {
	
	//$this->form_validation->set_rules('tarik_tunai', 'tarik_tunai', 'trim|required');
	$this->form_validation->set_rules('no_pelanggan', 'no pelanggan', 'trim|required');

	$this->form_validation->set_rules('id_saldo', 'id_saldo', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

