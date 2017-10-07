<?php
/*
 * Forgot_password Controller
 */
class Forget_password extends MY_Controller {
	
	/**
	 * Constructor
	 */
    function __construct() {
		parent::__construct();
		$this->load->model(array("user_model","common_model"));
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	/**
	 * Forgot password
	 */
	function index()
	{
		$data = array();
		// Redirect signed in users to homepage

		if(IS_AJAX && !$this->session->userdata('user_id'))
		{
            // Setup form validation
            $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
            $this->form_validation->set_rules(array(
                array('field'=>'forgot_password_email', 'label'=>'Forget Email', 'rules'=>'trim|required')
            ));

            // Run form validation
            if ($this->form_validation->run())
            {
                // Username does not exist
                if ( ! $account = $this->user_model->get_by_email($this->input->post('forgot_password_email')))
                {
                    echo json_encode(array('error'=>TRUE , 'message'=>'This Email you enter does not exist.'));
                }else
                {
                    // Set reset datetime
                    $time = $this->user_model->update_reset_sent_datetime($account->user_id);

                    // Load email library
                    $this->load->library('email');
                    $string = randomString(6);
                    $code = $this->user_model->update_code($account->user_id, $string);
                    // Generate reset password url
                    $password_reset_url = site_url('home/change_password?id='.$account->user_id.'&token='.sha1($account->user_id.$time.$code));

                    // Send reset password email


                    $emailData['username']=ucfirst($account->username);


                    $emailData['reset_link']='<a style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;text-align:center;text-decoration:none;background-color:#38b8e9;display:block;border-radius:2px;color:#ffffff;padding:12px 25px;font-weight:bold;font-size:14px;white-space:nowrap;" href="'.$password_reset_url.'" target="_blank">Please Click on This Link</a>';

                    $subject= "Tips an Go Password Reset";
                    $from= "no-reply@tipsandgo.com";
                    $from1= "Tips an Go";

                    $emailContent = $this->load->view('email/email_template' , $emailData , true);

                    $this->load->helper('email');

                    $send = $this->sendEmail($account->email,$from,$from1,$subject,$emailContent);
                    if($send){
                        echo json_encode(array('error'=> FALSE, 'message'=> 'Password Reset Email has been sent to your Registered Email.'));
                    }else{
                        echo json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));
                    }
                }
            }else{
                echo json_encode(array('error'=> TRUE, 'message'=> validation_errors()));
            }
        }else{
            echo json_encode(array('error'=>TRUE , 'reload'=>TRUE));
        }
        exit;
	}
	
}

/* End of file forgot_password.php */
/* Location: ./application/modules/account/controllers/forgot_password.php */
