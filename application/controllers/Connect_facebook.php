<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connect_facebook extends CI_Controller {
	/**
	 * Constructor
	 */
    function __construct() {
		parent::__construct();
		$this->load->model(array("user_model","common_model"));
		$this->load->library(array("session","facebook"));
		$this->load->helper('url');
	}

	function index()
	{
		$data = array();
        if($this->session->userdata('user_id')){
            redirect('');
        }
		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] =$user_profile = $this->facebook->api('/me?fields=id,name,email,birthday,first_name,last_name,languages,location,work,hometown,gender,about');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
        }

        if ($user) {
        	$profile['email'] = isset($user_profile['email'])?$user_profile['email']:NULL;
        	$profile['username'] = isset($user_profile['first_name'])?strtolower($user_profile['first_name']):NULL;
        	$profile['type'] = 2;
        	$profile['first_name'] = isset($user_profile['first_name'])?$user_profile['first_name']:NULL;
        	$profile['last_name'] = isset($user_profile['last_name'])?$user_profile['last_name']:NULL;
        	$profile['gender'] = isset($user_profile['gender'])?$user_profile['gender']:NULL;
        	if(!empty($profile['gender']) && $profile['gender'] == 'male'){
        		$profile['gender'] = 1;
        	}elseif(!empty($profile['gender']) && $profile['gender'] == 'femail'){
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

	public function facebook_logout()
	{
		$this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('login');
	}
}