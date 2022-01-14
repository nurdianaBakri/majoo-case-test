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
	);
        $this->load->view('sb-admin', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'kd_kategori' => $this->input->post('kd_kategori',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Product_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
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
		'date' => set_value('date', $row->date),
	    );
            $this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'kd_kategori' => $this->input->post('kd_kategori',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Product_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('kd_kategori', 'kd kategori', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

	public function test()
	{
		$this->datatables->select('id_produk,nama,deskripsi,nm_kategori');
        $this->datatables->from('product');
        //add this line for join
        $this->datatables->join('kategori_produk', 'product.kd_kategori = kategori_produk.kd_kategori');
        $this->datatables->add_column('action', anchor(site_url('product/read/$1'),'Read')." | ".anchor(site_url('product/update/$1'),'Update')." | ".anchor(site_url('product/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_produk');
        $k= $this->datatables->generate();
		var_dump($k);
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-14 05:25:23 */
/* http://harviacode.com */
