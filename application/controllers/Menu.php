<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('No_urut');
        $this->load->library('form_validation');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    public function upload(){
  $fileName = $this->input->post('file', TRUE);

  $config['upload_path'] = './upload/'; 
  $config['file_name'] = $fileName;
  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
  $config['max_size'] = 10000;

  $this->load->library('upload', $config);
  $this->upload->initialize($config); 
  
  if (!$this->upload->do_upload('file')) {
   $error = array('error' => $this->upload->display_errors());
   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
   redirect('import'); 
  } else {
   $media = $this->upload->data();
   $inputFileName = 'upload/'.$media['file_name'];
   
   try {
    $inputFileType = IOFactory::identify($inputFileName);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   }

   $sheet = $objPHPExcel->getSheet(0);
   $highestRow = $sheet->getHighestRow();
   $highestColumn = $sheet->getHighestColumn();

   for ($row = 2; $row <= $highestRow; $row++){  
     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
       NULL,
       TRUE,
       FALSE);
     $data = array(
                    'id_menu' => '',
                    'kode_menu' => $rowData[0][0],
                    'nama_menu' => $rowData[0][1],
                    'harga' => $rowData[0][3],
                    'nama_tenant' => $rowData[0][6],
                );
    $this->db->insert("menu",$data);
   } 
   ?>
   <script type="text/javascript">
     alert('berhasil upload data !');
     window.location='<?php echo base_url() ?>menu/';
   </script>
   <?php
  }  
 }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'menu/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'menu/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'menu/index.html';
            $config['first_url'] = base_url() . 'menu/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Menu_model->total_rows($q);


        if ($this->session->userdata('level') == "tenant") {
            $menu = $this->Menu_model->tenant();
        
        }else{
            $menu = $this->Menu_model->get_limit_data($config['per_page'], $start, $q);

        }
            
        
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu_data' => $menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'menu/menu_list',
            'jdl' => 'Data menu',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Menu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_menu' => $row->id_menu,
		'kode_menu' => $row->kode_menu,
		'nama_menu' => $row->nama_menu,
		'harga' => $row->harga,
	    );
            $this->load->view('menu/menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu/create_action'),
	    'id_menu' => set_value('id_menu'),
	    'kode_menu' => $this->No_urut->buat_kode_menu(),
	    'nama_menu' => set_value('nama_menu'),
        'harga' => set_value('harga'),
	    'nama_tenant' => set_value('nama_tenant'),
        'konten' => 'menu/menu_form',
            'jdl' => 'Data menu',
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
		'nama_menu' => $this->input->post('nama_menu',TRUE),
        'harga' => $this->input->post('harga',TRUE),
        'nama_tenant' => $this->input->post('nama_tenant',TRUE),
	    );

            $this->Menu_model->insert($data);
            $cek = $this->db->get_where('user',array('username'=> $this->input->post('nama_tenant')));
            if ($cek->num_rows() == 0) {
                $this->db->insert('user', array(
                    'username' => strtolower($this->input->post('nama_tenant')),
                    'password' => strtolower($this->input->post('nama_tenant')),
                    'nama_lengkap' => $this->input->post('nama_tenant'),
                    'foto' => 'user_1521020506.png',
                    'level'=> 'tenant',
                ));
            } else {

            }
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu/update_action'),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'kode_menu' => set_value('kode_menu', $row->kode_menu),
		'nama_menu' => set_value('nama_menu', $row->nama_menu),
        'harga' => set_value('harga', $row->harga),
		'nama_tenant' => set_value('nama_tenant', $row->nama_tenant),
        'konten' => 'menu/menu_form',
            'jdl' => 'Data menu',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
            $data = array(
		'kode_menu' => $this->input->post('kode_menu',TRUE),
		'nama_menu' => $this->input->post('nama_menu',TRUE),
        'harga' => $this->input->post('harga',TRUE),
        'nama_tenant' => $this->input->post('nama_tenant',TRUE),
	    );

            $this->Menu_model->update($this->input->post('id_menu', TRUE), $data);
            $cek = $this->db->get_where('user',array('username'=> $this->input->post('nama_tenant')));
            if ($cek->num_rows() == 0) {
                $this->db->insert('user', array(
                    'username' => strtolower($this->input->post('nama_tenant')),
                    'password' => strtolower($this->input->post('nama_tenant')),
                    'nama_lengkap' => $this->input->post('nama_tenant'),
                    'foto' => 'user_1521020506.png',
                    'level'=> 'tenant',
                ));
            } else {

            }
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $this->Menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_menu', 'kode menu', 'trim|required');
	$this->form_validation->set_rules('nama_menu', 'nama menu', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');

	$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

