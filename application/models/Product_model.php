<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public $table = 'product';
    public $id = 'id_produk';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

	function role_exists($key)
		{
			$this->db->where('nama',$key);
			$query = $this->db->get('product');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

    // datatables
    function json() {
        $this->datatables->select('id_produk,nama,LEFT(deskripsi , 100) as deskripsi ,nm_kategori');
        $this->datatables->from('product');
        //add this line for join
        $this->datatables->join('kategori_produk', 'product.kd_kategori = kategori_produk.kd_kategori');
		
		$this->datatables->add_column('action', anchor(site_url('product/read/$1'),'Read')." | ".anchor(site_url('product/update/$1'),'Update')." | ".anchor(site_url('product/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_produk');
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

	function get_detail_gambar($id_product)
    {
        $this->db->where('id_product', $id_product);
        return $this->db->get('product_detail')->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_produk', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('deskripsi', $q);
		$this->db->or_like('kd_kategori', $q);
		$this->db->or_like('id_user', $q);
		$this->db->or_like('date', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_produk', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('deskripsi', $q);
	$this->db->or_like('kd_kategori', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('date', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

	 // insert data
	 function insert_detail($data)
	 {
		 $this->db->insert('product_detail', $data);
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

	 // delete data
	 function delete_detail($id)
	 {
		 $this->db->where($this->id, $id);
		 $this->db->delete($this->table);
	 }

}
