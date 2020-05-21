<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saldo_model extends CI_Model
{

    public $table = 'saldo';
    public $table2 = 'detail_saldo';
    public $id = 'id_saldo';
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
        $this->db->like('id_saldo', $q);
	$this->db->or_like('saldo', $q);
	$this->db->or_like('pengeluaran', $q);
	$this->db->or_like('no_pelanggan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_saldo', $q);
	$this->db->or_like('saldo', $q);
	$this->db->or_like('pengeluaran', $q);
	$this->db->or_like('no_pelanggan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    function insert2($data2)
    {   
        $this->db->insert($this->table2, $data2);
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

/* End of file Saldo_model.php */
/* Location: ./application/models/Saldo_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-15 09:55:26 */
/* http://harviacode.com */