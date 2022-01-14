<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
    }

    public function index()
    { 
		$data = array(
            'content' => 'product/product_list',
        );
        $this->load->view('sb-admin', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Product_model->json();
    }

    public function read($id) 
    {
        $row = $this->Product_model->get_by_id($id);
        if ($row) {
            $data = array(
			'id_produk' => $row->id_produk,
			'nama' => $row->nama,
			'deskripsi' => $row->deskripsi,
			'kd_kategori' => $row->kd_kategori,
			'id_user' => $row->id_user,
			'harga' => $row->harga,
			'gambar' => $row->gambar,
			'date' => $row->date,
	    );
            $data['content'] = 'product/product_read';

            $this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'content' => 'product/product_form', 
            'action' => site_url('product/create_action'),
			'id_produk' => set_value('id_produk'),
			'nama' => set_value('nama'),
			'deskripsi' => set_value('deskripsi'),
			'kd_kategori' => set_value('kd_kategori'),
			'id_user' => set_value('id_user'),
			'date' => set_value('date'),
			'harga' => set_value('harga'),
			'gambar' => set_value('gambar'),
			'kat' => $this->db->get('kategori_produk')->result(), 
		);
        $this->load->view('sb-admin', $data);
    }

	function rolekey_exists($key)
	{
		$this->Product_model->role_exists($key);
	}
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', 'Proses tambah produk gagal');
            $this->session->set_flashdata('status', '0');
 
            $this->create();
        } else {

			$nama = $this->input->post('nama',TRUE);
			$cek = $this->db->query("SELECT * FROM  product where nama='$nama'")->num_rows();
			if ($cek>0) 
			{
				$this->session->set_flashdata('message', 'Proses tambah produk gagal, karena nama produk sudah ada');
				$this->session->set_flashdata('status', '2');  
			}
			else
			{
				//cek apakah 
				$data = array(
					'nama' => $this->input->post('nama',TRUE),
					'deskripsi' => $this->input->post('deskripsi',TRUE),
					'kd_kategori' => $this->input->post('kd_kategori',TRUE),
					'id_user' => $this->input->post('id_user',TRUE),
					'harga' => $this->input->post('harga',TRUE),
					'gambar' => $this->input->post('gambar',TRUE),
					'date' => date('Y-m-d H:i:s'),
				);

				$this->Product_model->insert($data);
				$this->session->set_flashdata('message', 'Berhasil menambah produk');
				$this->session->set_flashdata('status', '1');
            } 

            redirect(site_url('product'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'content' => 'product/product_form',  
                'action' => site_url('product/update_action'),
				'id_produk' => set_value('id_produk', $row->id_produk),
				'nama' => set_value('nama', $row->nama),
				'deskripsi' => set_value('deskripsi', $row->deskripsi),
				'kd_kategori' => set_value('kd_kategori', $row->kd_kategori),
				'id_user' => set_value('id_user', $row->id_user),
				'harga' => set_value('harga', $row->harga),
				'gambar' => set_value('gambar', $row->gambar),
				'date' => set_value('date', $row->date),
				'kat' => $this->db->get('kategori_produk')->result(),
			);
 
            $this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak di temukan');
            $this->session->set_flashdata('status', '0');
            redirect(site_url('product'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', 'Proses update produk gagal');
            $this->session->set_flashdata('status', '0'); 

            $this->update($this->input->post('id_produk', TRUE));
        } else {

			//cek nama yang duplikat
			$nama = $this->input->post('nama',TRUE);
			$cek = $this->db->query("SELECT * FROM  product where nama='$nama'")->num_rows();
			if ($cek>0) 
			{
				$this->session->set_flashdata('message', 'Proses update produk gagal, karena nama produk sudah ada');
				$this->session->set_flashdata('status', '2'); 

				$this->update($this->input->post('id_produk', TRUE));
			}
			else
			{
				$data = array(
					'nama' => $this->input->post('nama',TRUE),
					'deskripsi' => $this->input->post('deskripsi',TRUE),
					'kd_kategori' => $this->input->post('kd_kategori',TRUE),
					'id_user' => $this->input->post('id_user',TRUE),
					'harga' => $this->input->post('harga',TRUE),
					'gambar' => $this->input->post('gambar',TRUE),
					'date' => $this->input->post('date',TRUE),
				);

				$this->Product_model->update($this->input->post('id_produk', TRUE), $data); 
				$this->session->set_flashdata('message', 'Proses update produk berhasil');
				$this->session->set_flashdata('status', '1'); 

				redirect(site_url('product'));
			} 
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus produk berhasil');
            $this->session->set_flashdata('status', '1'); 

            redirect(site_url('product'));
        } else {
            $this->session->set_flashdata('message', 'Hapus produk gagal');
            $this->session->set_flashdata('status', '0'); 

            redirect(site_url('product'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	// $this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
	$this->form_validation->set_rules('kd_kategori', 'kd kategori', 'trim|required');
 
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    } 
} 
