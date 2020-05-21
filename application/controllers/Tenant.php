<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tenant extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tenant_model');
        $this->load->library('form_validation');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tenant/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tenant/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tenant/index.html';
            $config['first_url'] = base_url() . 'tenant/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tenant_model->total_rows($q);
        $tenant = $this->Tenant_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tenant_data' => $tenant,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'tenant/tenant_list',
            'jdl' => 'Data Tenant',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Tenant_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_tenant' => $row->id_tenant,
		'nama_tenant' => $row->nama_tenant,
		'no_telpon' => $row->no_telpon,
		'email' => $row->email,
	    );
            $this->load->view('tenant/tenant_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tenant'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tenant/create_action'),
	    'id_tenant' => set_value('id_tenant'),
	    'nama_tenant' => set_value('nama_tenant'),
	    'no_telpon' => set_value('no_telpon'),
	    'email' => set_value('email'),
        'konten' => 'tenant/tenant_form',
            'jdl' => 'Data Tenant',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $cek = $this->db->get_where('tenant',array('nama_tenant'=> $this->input->post('nama_tenant')));
            if ($cek->num_rows() == 0) {
                $data = array(
                    'nama_tenant' => $this->input->post('nama_tenant',TRUE),
                    'no_telpon' => $this->input->post('no_telpon',TRUE),
                    'email' => $this->input->post('email',TRUE),
                    );
            
                    $this->Tenant_model->insert($data);                      
                            $this->db->insert('user', array(
                                'username' => strtolower($this->input->post('nama_tenant')),
                                'password' => strtolower($this->input->post('nama_tenant')),
                                'nama_lengkap' => $this->input->post('nama_tenant'),
                                'foto' => 'user_1521020506.png',
                                'level'=> 'tenant',
                            ));
                        
                    $this->session->set_flashdata('message', 'Create Record Success');
                    redirect(site_url('tenant'));
                
            } else {

                ?>
			<script type="text/javascript">
				alert('Nama Tenant Sudah Ada!');
				window.location="<?php echo base_url('tenant/create'); ?>";
			</script>
			<?php

            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tenant_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tenant/update_action'),
		'id_tenant' => set_value('id_tenant', $row->id_tenant),
		'nama_tenant' => set_value('nama_tenant', $row->nama_tenant),
		'no_telpon' => set_value('no_telpon', $row->no_telpon),
		'email' => set_value('email', $row->email),
        'konten' => 'tenant/tenant_form',
            'jdl' => 'Data Tenant',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tenant'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tenant', TRUE));
        } else {
            $data = array(
		'nama_tenant' => $this->input->post('nama_tenant',TRUE),
		'no_telpon' => $this->input->post('no_telpon',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Tenant_model->update($this->input->post('id_tenant', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tenant'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tenant_model->get_by_id($id);

        if ($row) {
            $this->Tenant_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tenant'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tenant'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_tenant', 'nama tenant', 'trim|required');
	$this->form_validation->set_rules('no_telpon', 'no_telpon', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('id_tenant', 'id_tenant', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

