<?php 

class Login_model extends CI_Model{	

	
	function __construct() {
		parent::__construct();
	}

	 public function cek_userIsLogedIn()
	{
    	$this->secure_header();
		if($this->session->userdata('status')=="login")
	    {
	      return true;
	    }  
	    else
	    {
	      return false;
	    }
	}	

	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	 

	function get() { 
		if (isset($_SESSION['id']))
		{
			$data = array(
				'id' => $_SESSION['id'], 
				'username' => $_SESSION['username'], 
				'nama' => $_SESSION['nama'], 
			);
		}
		else
		{
			$data = array( 
				'role' => null,  
			);
		}
		return $data;  
	}
  
	function clear() {
		session_destroy ();
	}

	 public function secure_header()
    {
     	// Prevent some security threats, per Kevin
		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: DENY');
		// prevent mime based attacks
    	$this->output->set_header('X-Content-Type-Options: nosniff');
    }
}