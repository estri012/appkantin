<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengambilan_tenant_model extends CI_Model
{

    public $table = 'pengambilan_tenant';
    public $id = 'id_pengambilan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_pengambilan', $q);
	$this->db->or_like('kode_menu', $q);
	$this->db->or_like('tgl_pengambilan', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('sisa_menu', $q);
	$this->db->or_like('nominal_uang', $q);
	$this->db->or_like('petugas', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pengambilan', $q);
	$this->db->or_like('kode_menu', $q);
	$this->db->or_like('tgl_pengambilan', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('sisa_menu', $q);
	$this->db->or_like('nominal_uang', $q);
	$this->db->or_like('petugas', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pengambilan_tenant_model.php */
/* Location: ./application/models/Pengambilan_tenant_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-06 11:37:57 */
/* http://harviacode.com */