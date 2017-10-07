<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	function __construct() {
		parent::__construct();
        $this->load->model('signup_model');
	$this->load->library('session');
	if ($this->session->userdata('user_id')) {
	       redirect('home', 'refresh');
	}
    }
	
	public function index()
	{
		$data = array();
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
                $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password ', 'required|matches[cpassword]');
		
		if ($this->form_validation->run() == TRUE)
		{
			$data['insert_data'] = array(
				'email' => $this->input->post('email'),
                                'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'type'=> 2,
				'creation_date'=> date('Y-m-d H:i:s'),
			);
			$last_id = $this->signup_model->create($data['insert_data']);
			if($last_id){
				$this->session->set_userdata('is_login',true);
				$this->session->set_userdata('user_id',$last_id);
				redirect('home', 'location');
			}else{
				$data['form_errors'] = "Some errors are exist. please try again!!";
			}
		}
		
		$this->load->view('header');
		$this->load->view('signup', $data);
		$this->load->view('footer');
	}
	
}
