<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

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
            $this->load->model('user_model');
            $this->load->library(array("session","googleplus"));
            if ($this->session->userdata('user_id')) {
                redirect('home', 'refresh');
            }
        }

    public function index()
	{
		$data = array();
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->form_validation->set_rules('signin_email', 'Email', 'required');
		$this->form_validation->set_rules('signin_password', 'Password', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post('signin_email');
			$password = md5($this->input->post('signin_password'));
		
			$userdata = $this->user_model->login($email, $password);
			if(!empty($userdata)){
				$this->session->set_userdata('is_login',true);
				$this->session->set_userdata('user_id',$userdata->user_id);
				$this->session->set_userdata('email',$userdata->email);
				redirect('home', 'refresh');
			}else{
				$data['form_errors'] = "Some errors are exist. please try again!!";
			}
		}

		$data['login_url'] = $this->googleplus->loginURL();
		$this->load->view('header');
		$this->load->view('login',$data);
		$this->load->view('footer');
	}
}
