<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_produk_model extends CI_Model
{

    public $table = 'kategori_produk';
    public $id = 'kd_kategori';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kd_kategori,nm_kategori');
        $this->datatables->from('kategori_produk');
        //add this line for join
        //$this->datatables->join('table2', 'kategori_produk.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('kategori_produk/read/$1'),'Read')." | ".anchor(site_url('kategori_produk/update/$1'),'Update')." | ".anchor(site_url('kategori_produk/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kd_kategori');
        return $this->datatables->generate();
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
        $this->db->like('kd_kategori', $q);
	$this->db->or_like('nm_kategori', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kd_kategori', $q);
	$this->db->or_like('nm_kategori', $q);
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

/* End of file Kategori_produk_model.php */
/* Location: ./application/models/Kategori_produk_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-14 05:30:21 */
/* http://harviacode.com */