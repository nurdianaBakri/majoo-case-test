<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_produk_model');
        $this->load->library('form_validation');        
		$this->load->library('datatables');
        $this->logged_in();  
        
    }



    public function index()
    {

		$data = array(
            'content' => 'kategori_produk/kategori_produk_list',
        );
        $this->load->view('sb-admin', $data);
    } 

     private function logged_in() { 
        if($this->session->userdata('authenticated')!=true) {
            redirect('Welcome');
        }
    }  
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kategori_produk_model->json();
    }

    public function read($id) 
    {
        $row = $this->Kategori_produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kd_kategori' => $row->kd_kategori,
		'nm_kategori' => $row->nm_kategori,
	    );
            $data['content'] = 'kategori_produk/kategori_produk_read';

            $this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_produk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'content' => 'kategori_produk/kategori_produk_form', 
            'action' => site_url('kategori_produk/create_action'),
	    'kd_kategori' => set_value('kd_kategori'),
	    'nm_kategori' => set_value('nm_kategori'),
	);
        $this->load->view('sb-admin', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', 'Proses menambah kategori produk gagal');
			$this->session->set_flashdata('status', '0');  

            $this->create();
        } else {

			$nm_kategori = $this->input->post('nm_kategori',TRUE); 
			$cek = $this->db->query("SELECT * FROM  kategori_produk where nm_kategori='$nm_kategori'")->num_rows();
			if ($cek>0) 
			{
				$this->session->set_flashdata('message', 'Proses tambah produk gagal, karena nama kategori sudah ada');
				$this->session->set_flashdata('status', '2');  
			} 
			else{
				$data = array(
					'nm_kategori' => $this->input->post('nm_kategori',TRUE),
				);

				$this->Kategori_produk_model->insert($data);
				$this->session->set_flashdata('message', 'Berhasil menambah kategori produk');
				$this->session->set_flashdata('status', '1');
			}
				
            redirect(site_url('kategori_produk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kategori_produk_model->get_by_id($id);

        if ($row) { 
			$data = array(
				'button' => 'Update',
				'content' => 'kategori_produk/kategori_produk_form',  
				'action' => site_url('kategori_produk/update_action'),
				'kd_kategori' => set_value('kd_kategori', $row->kd_kategori),
				'nm_kategori' => set_value('nm_kategori', $row->nm_kategori),
			); 

			$this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Kategori produk tidak ditemukan');
			$this->session->set_flashdata('status', '0');  
            redirect(site_url('kategori_produk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', 'Update Record gagal.');
			$this->session->set_flashdata('status', '0');  

            $this->update($this->input->post('kd_kategori', TRUE));
        } else {

			$nm_kategori = $this->input->post('nm_kategori',TRUE); 
			$cek = $this->db->query("SELECT * FROM  kategori_produk where nm_kategori='$nm_kategori'")->num_rows();
			if ($cek>0) 
			{
				$this->session->set_flashdata('message', 'Proses update produk gagal, karena nama kategori sudah ada');
				$this->session->set_flashdata('status', '2');  
			}
			else{

				$data = array(
					'nm_kategori' => $this->input->post('nm_kategori',TRUE),
				);

				$this->Kategori_produk_model->update($this->input->post('kd_kategori', TRUE), $data);
				$this->session->set_flashdata('message', 'Update Record Success');
				$this->session->set_flashdata('status', '1');  
            }
            redirect(site_url('kategori_produk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kategori_produk_model->get_by_id($id);

        if ($row) {
            $this->Kategori_produk_model->delete($id);

			$this->session->set_flashdata('message', 'Hapus kategori produk berhasil'); 
            $this->session->set_flashdata('status', '1'); 

            redirect(site_url('kategori_produk'));
        } else {

			$this->session->set_flashdata('message', 'Hapus kategori produk gagal'); 
            $this->session->set_flashdata('status', '0'); 

            redirect(site_url('kategori_produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nm_kategori', 'nm kategori', 'trim|required');

	$this->form_validation->set_rules('kd_kategori', 'kd_kategori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
 