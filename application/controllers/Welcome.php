<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {
        parent::__construct();        
        $this->logged_in();  

    }
 
    private function logged_in() { 
        if($this->session->userdata('authenticated')==true) {
            // redirect('Product');
        }
    }   


	 
	public function index()
	{ 
		$this->load->view('login/login');
	} 

	public function login()
    { 
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == false){
           $this->load->view('Welcome');
        } 
        else {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
    		$where = array(
				'username' => $username,
				'password' => md5($password)
			);

            $cek = $this->Login_model->cek_login("user_login",$where);  
			if($cek->num_rows()  > 0){   
				  $cek = $cek->row_array(); 
				  $userdata = array(
                    'username' => $cek['username'],  
					'id' => $cek['id'], 
                    'authenticated' => TRUE
                ); 
                $this->session->set_userdata($userdata);   
                redirect('Product');
			}
			else
			{ 
				$this->session->set_flashdata('pesan', "username dan password salah !");  
                redirect('Login');
			}  
        }
    } 


	public function logout()
    {
        $hdah = $this->session->sess_destroy(); 
        $this->clear_cache();
        redirect('Welcome');
    }

	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}
