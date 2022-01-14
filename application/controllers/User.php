<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/';
            $config['first_url'] = base_url() . 'user/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'content' => 'user/user_list',
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('sb-admin', $data);
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'username' => $row->username,
		'pass' => $row->pass,
		'level' => $row->level,
	    );
            $data['content'] = 'user/user_read';

            $this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'content' => 'user/user_form', 
            'action' => site_url('user/create_action'),
	    'id' => set_value('id'),
	    'username' => set_value('username'),
	    'pass' => set_value('pass'),
	    'level' => set_value('level'),
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
		'username' => $this->input->post('username',TRUE),
		'pass' => $this->input->post('pass',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'content' => 'user/user_form',  
                'action' => site_url('user/update_action'),
		'id' => set_value('id', $row->id),
		'username' => set_value('username', $row->username),
		'pass' => set_value('pass', $row->pass),
		'level' => set_value('level', $row->level),
	    );
            $this->load->view('sb-admin', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'pass' => $this->input->post('pass',TRUE),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->User_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('pass', 'pass', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-24 09:55:19 */
/* http://harviacode.com */