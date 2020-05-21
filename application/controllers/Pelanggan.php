<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
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
                    'id_pelanggan' => '',
                    'no_pelanggan' => $rowData[0][0],
                    'nama' => $rowData[0][1],
                    'alamat' => $rowData[0][2],
                    'tempat_lahir' => $rowData[0][3],
                    'tanggal_lahir' => $rowData[0][4],
                    'no_telp' => $rowData[0][5],
                    'pin' => $rowData[0][6],
                );
    $this->db->insert("pelanggan",$data);
   } 
   ?>
   <script type="text/javascript">
     alert('berhasil upload data !');
     window.location='<?php echo base_url() ?>pelanggan/';
   </script>
   <?php
  }  
 }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pelanggan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pelanggan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pelanggan/index.html';
            $config['first_url'] = base_url() . 'pelanggan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelanggan_model->total_rows($q);
        $pelanggan = $this->Pelanggan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pelanggan_data' => $pelanggan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'pelanggan/pelanggan_list',
            'jdl' => 'Data Pelanggan',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pelanggan' => $row->id_pelanggan,
		'no_pelanggan' => $row->no_pelanggan,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
        'pin' => $row->pin,
        'no_telp' => $row->no_telp,
        'konten' => 'pelanggan/pelanggan_read',
            'jdl' => 'Data Pelanggan',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pelanggan/create_action'),
	    'id_pelanggan' => set_value('id_pelanggan'),
        // 'no_pelanggan' => $this->No_urut->buat_kode_pelanggan(),
        'no_pelanggan' => set_value('no_pelanggan'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
        'no_telp' => set_value('no_telp'),
        'pin' => set_value('pin'),
        'konten' => 'pelanggan/pelanggan_form',
            'jdl' => 'Data Pelanggan',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $cek = $this->db->get_where('pelanggan',array('no_pelanggan'=> $this->input->post('no_pelanggan')));
            if ($cek->num_rows() == 0) {
                $data = array(
                    'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'alamat' => $this->input->post('alamat',TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                    'no_telp' => $this->input->post('no_telp',TRUE),
                    'pin' => $this->input->post('pin',TRUE),
                    );
            
                        $this->Pelanggan_model->insert($data);
                        $cek = $this->db->get_where('user',array('no_pelanggan'=> $this->input->post('no_pelanggan')));
                        if ($cek->num_rows() == 0) {
                            $this->db->insert('user', array(
                                'username' => strtolower($this->input->post('nama')),
                                'password' => strtolower($this->input->post('nama')),
                                'nama_lengkap' => $this->input->post('nama'),
                                'foto' => 'user_1521020506.png',
                                'level'=> 'pelanggan',
                                'no_pelanggan'=> $this->input->post('no_pelanggan'),
                            ));
                        } else {
            
                        }
                        $this->session->set_flashdata('message', 'Create Record Success');
            
                        redirect(site_url('pelanggan'));
                
            } else {

                ?>
			<script type="text/javascript">
				alert('No Kartu Sudah Terdaftar!');
				window.location="<?php echo base_url('pelanggan/create'); ?>";
			</script>
			<?php

            }
        
        }


    }
    
    public function update($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pelanggan/update_action'),
		'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
		'no_pelanggan' => set_value('no_pelanggan', $row->no_pelanggan),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
        'no_telp' => set_value('no_telp', $row->no_telp),
        'pin' => set_value('pin', $row->pin),
        'konten' => 'pelanggan/pelanggan_form',
            'jdl' => 'Data Pelanggan',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelanggan', TRUE));
        } else {
            $data = array(
		'no_pelanggan' => $this->input->post('no_pelanggan',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
        'no_telp' => $this->input->post('no_telp',TRUE),
        'pin' => $this->input->post('pin',TRUE),
	    );

            $this->Pelanggan_model->update($this->input->post('id_pelanggan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelanggan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $this->Pelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pelanggan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_pelanggan', 'no pelanggan', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
    $this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
    $this->form_validation->set_rules('pin', 'pin', 'trim|required');
	$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

