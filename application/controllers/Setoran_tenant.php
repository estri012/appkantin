<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setoran_tenant extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setoran_tenant_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'setoran_tenant/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'setoran_tenant/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'setoran_tenant/index.html';
            $config['first_url'] = base_url() . 'setoran_tenant/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Setoran_tenant_model->total_rows($q);
        $setoran_tenant = $this->Setoran_tenant_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'setoran_tenant_data' => $setoran_tenant,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'setoran_tenant/setoran_tenant_list',
            'jdl' => 'Data Setoran Suplayer',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Setoran_tenant_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_setoran' => $row->id_setoran,
		'kode_menu' => $row->kode_menu,
		'tgl_setoran' => $row->tgl_setoran,
		'jumlah' => $row->jumlah,
		'petugas' => $row->petugas,
	    );
            $this->load->view('setoran_tenant/setoran_tenant_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setoran_tenant'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('setoran_tenant/create_action'),
	    'id_setoran' => set_value('id_setoran'),
	    'kode_menu' => set_value('kode_menu'),
	    'tgl_setoran' => set_value('tgl_setoran'),
	    'jumlah' => set_value('jumlah'),
	    'petugas' => set_value('petugas'),
        'konten' => 'setoran_tenant/setoran_tenant_form',
            'jdl' => 'Data Setoran Suplayer',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_menu' => $this->input->post('kode_menu',TRUE),
		'tgl_setoran' => $this->input->post('tgl_setoran',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'petugas' => $this->input->post('petugas',TRUE),
	    );

            $this->Setoran_tenant_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('setoran_tenant'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Setoran_tenant_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('setoran_tenant/update_action'),
		'id_setoran' => set_value('id_setoran', $row->id_setoran),
		'kode_menu' => set_value('kode_menu', $row->kode_menu),
		'tgl_setoran' => set_value('tgl_setoran', $row->tgl_setoran),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'petugas' => set_value('petugas', $row->petugas),
        'konten' => 'setoran_tenant/setoran_tenant_form',
            'jdl' => 'Data Setoran Suplayer',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setoran_tenant'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_setoran', TRUE));
        } else {
            $data = array(
		'kode_menu' => $this->input->post('kode_menu',TRUE),
		'tgl_setoran' => $this->input->post('tgl_setoran',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'petugas' => $this->input->post('petugas',TRUE),
	    );

            $this->Setoran_tenant_model->update($this->input->post('id_setoran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('setoran_tenant'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Setoran_tenant_model->get_by_id($id);

        if ($row) {
            $this->Setoran_tenant_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('setoran_tenant'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setoran_tenant'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_menu', 'kode menu', 'trim|required');
	$this->form_validation->set_rules('tgl_setoran', 'tgl setoran', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('petugas', 'petugas', 'trim|required');

	$this->form_validation->set_rules('id_setoran', 'id_setoran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "setoran_tenant.xls";
        $judul = "setoran_tenant";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Setoran");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	xlsWriteLabel($tablehead, $kolomhead++, "Petugas");

	foreach ($this->Setoran_tenant_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_menu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_setoran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->petugas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
