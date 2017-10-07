<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Connect_google extends CI_Controller {

	/**
	 * Constructor
	 */
    function __construct() {
		parent::__construct();
		$this->load->model(array("user_model","common_model"));
		$this->load->library(array("session","googleplus"));
		$this->load->helper('url');
	}

	public function index()
	{
		if($this->session->userdata('user_id')){
			redirect('');
		}
		
		if (($this->input->get("code"))) {
			
			$this->googleplus->getAuthenticate();
			$user_profile = $this->googleplus->getUserInfo();
			$profile['email'] = isset($user_profile['email'])?$user_profile['email']:NULL;
            $profile['first_name'] = isset($user_profile['given_name'])?($user_profile['given_name']):NULL;
            $profile['last_name'] = isset($user_profile['family_name'])?($user_profile['family_name']):NULL;
            $profile['username'] = isset($user_profile['given_name'])?strtolower($user_profile['given_name']):NULL;
            $profile['type'] = 2;
            if(!empty($userProfile['gender']) && $userProfile['gender'] == 'male'){
        		$profile['gender'] = 1;
        	}elseif(!empty($userProfile['gender']) && $userProfile['gender'] == 'femail'){
        		$profile['gender'] = 2;
        	}

			$account = $this->user_model->get_by_email($profile['email']);
        	$this->common_model->initialize('users','user_id');
        	if($account){
        		$result = $this->common_model->update($profile, array("user_id", $account->user_id));
        		$user_id = $account->user_id;
        	}else{
        		$profile['password'] = md5("123123");
        		$profile['creation_date'] = date("Y-m-d H:i:s");
        		$user_id = $this->common_model->insert($profile);
        	}

        	if($user_id){
        		$this->session->set_userdata('is_login',true);
				$this->session->set_userdata('user_id',$user_id);
				redirect('', 'refresh');
        	}else{
        		redirect('login');
        	}
			
		}else{
        	redirect('login');
        }
	}
	
	
	public function logout(){
		
		$this->session->sess_destroy();
		$this->googleplus->revokeToken();
		redirect('');
	}
	
}