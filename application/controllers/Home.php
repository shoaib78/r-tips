<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {
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
        $this->load->model(array("user_model","trip_model","activity_model","common_model"));
        $this->load->helper('url');
        $this->load->library(array('session','paypal_lib'));
    }
    public function index()
    {
        $data = array();
        $count = 100;
        $offset = 0;
        $data["trip_category"] = $this->trip_model->getTripCategories();
        if($this->session->userdata('user_id'))
        {
            $data['trips'] = $this->trip_model->get_all_trip_data($count, $offset);
            if(!empty($data['trips'])){
                $i=0;
                foreach($data['trips'] as $val):
                $data["trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
                if(!empty($data["trips"][$i]['photos'])){
                    $data["trips"][$i]['photos'] = $data["trips"][$i]['photos'][0]['file_name'];
                }else{
                    $data["trips"][$i]['photos'] = '';
                }
                $i++;
                endforeach;
            }
            $data['recent_trips'] = $this->trip_model->get_all_trip_data(12, $offset);
            if(!empty($data['recent_trips'])){
                $i=0;
                foreach($data['recent_trips'] as $val):
                $data["recent_trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
                if(!empty($data["recent_trips"][$i]['photos'])){
                    $data["recent_trips"][$i]['photos'] = $data["recent_trips"][$i]['photos'][0]['file_name'];
                }else{
                    $data["recent_trips"][$i]['photos'] = '';
                }
                $i++;
                endforeach;
            }
            $this->common_model->initialize('wishtips_category');
            $data["wishtips_category"] = $this->common_model->getResult("*");
            $this->common_model->initialize('banners');
            $data["advertisments"] = $this->common_model->getResult("*",array("payment_status"=>1));
            $data["wishtips"] = $this->user_model->get_all_wishtips();
            $data["total_count"] = $this->user_model->get_all_wishtips_count();
            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");
            if(!empty($data["wishtips"])){
                foreach($data["wishtips"] as $k=>$wishtip){
                    $data["wishtips"][$k]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                    $data["wishtips"][$k]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                }
            }
            $this->load->view('header', $data);
            $this->load->view('wall', $data);
            $this->load->view('footer');
        }else{
            $data["favorite_trips"] = $this->trip_model->get_discover_favorite_detail("favorite_trips");
            $data["discover_trip"] = $this->trip_model->get_discover_favorite_detail("discover_trips");
            $data["visited_countries"] = $this->trip_model->getUserVisitedCountry();
            if(!empty($data["discover_trip"])){
                $i=0;
                foreach($data["discover_trip"] as $val):
                $data["discover_trip"][$i]['similer_count'] = $this->trip_model->getSimilerTripCount($val['location']);
                $i++;
                endforeach;
            }
            $this->load->view('header', $data);
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
    }
    public function edit_profile()
    {
        $data = array();
        $data['reset'] = TRUE;
        if($this->session->userdata('is_login'))
        {
            if($this->input->post(NULL, TRUE))
            {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                $email_unique = "";
                $username_unique = "";
                if($this->input->post("email") != $this->session->userdata("user_email")){
                    $email_unique = "|is_unique[users.email]";
                }
                if($this->input->post("username") != $this->session->userdata("username")){
                    $username_unique = "|is_unique[users.username]";
                }
                $this->form_validation->set_rules(array(
                    array('field'=>'first_name', 'label'=>'First name', 'rules'=>'trim|required'),
                    array('field'=>'last_name', 'label'=>'Last name', 'rules'=>'trim|required'),
                    array('field'=>'email', 'label'=>'Email', 'rules'=>'trim|required'.$email_unique),
                    array('field'=>'username', 'label'=>'Username', 'rules'=>'trim|required'.$username_unique),
                    array('field'=>'gender', 'label'=>'Gender', 'rules'=>'trim|required'),
                    array('field'=>'dob', 'label'=>'Date of birth', 'rules'=>'trim|required'),
                    array('field'=>'profession', 'label'=>'Profession', 'rules'=>'trim|required'),
                    array('field'=>'language', 'label'=>'Language', 'rules'=>'trim|required'),
                    array('field'=>'location', 'label'=>'Location', 'rules'=>'trim|required'),
                    array('field'=>'travel_with', 'label'=>'Travel With', 'rules'=>'trim|required'),
                    array('field'=>'travelling', 'label'=>'Travelling', 'rules'=>'trim|required'),
                ));
                if (empty($_FILES['userfile']['name']) && !($this->input->post("profile_pic")))
                {
                    $this->form_validation->set_rules('userfile', 'User Profile Pic', 'required');
                }
                if ($this->form_validation->run() == TRUE)
                {
                    $post_data = $this->input->post(NULL, TRUE);
                    $config['upload_path'] = FCPATH.'uploads/user-pic';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['userfile']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload() && !empty($_FILES['userfile']['name']))
                    {
                        $this->session->set_flashdata('file_error', $this->upload->display_errors()); 
                    }else{
                        if (!empty($_FILES['userfile']['name']))
                        {
                            $upload = array('upload_data' => $this->upload->data());
                            $uploaded_file = $upload['upload_data']['file_name'];
                        }else{
                            $uploaded_file = $post_data["profile_pic"];
                        }
                        $data_arr = array(
                            "first_name"=>$post_data['first_name'],
                            "last_name"=>$post_data['last_name'],
                            "email"=>$post_data['email'],
                            "username"=>$post_data['username'],
                            "location"=>$post_data['location'],
                            "lat"=>$post_data['lat'],
                            "long"=>$post_data['long'],
                            "gender"=>$post_data['gender'],
                            "dob"=>$post_data['dob'],
                            "profession"=>$post_data['profession'],
                            "language"=>$post_data['language'],
                            "about_me"=>(isset($post_data['about_me'])?$post_data['about_me']:''),
                            "profile_pic"=>$uploaded_file,
                            "travel_with"=>$post_data['travel_with'],
                            "travelling"=>$post_data['travelling'],
                        );
                        $update = $this->user_model->update('users',$this->session->userdata('user_id'),$data_arr);
                        $this->session->unset_userdata("user_email");
                        $this->session->unset_userdata("username");
                        $success = "Successfully updated  user data";
                        $this->session->set_flashdata('success', $success);
                    }
                }
            }else{
                $this->session->set_flashdata('success', "");
                $this->session->set_flashdata('file_error', ""); 
            }
            $data["trip_count"] = $this->user_model->get_count("trip","user_id",$this->session->userdata('user_id'));
            $data["visited_country"] = count($this->trip_model->getUserVisitedCountry($this->session->userdata('user_id')));
            $data["user_detail"] = $this->user_model->getUserDetail($this->session->userdata('user_id'));
            $data["followers"] = $this->activity_model->get_followers($this->session->userdata('user_id'));
            $this->common_model->initialize('manage_credit_points');
            $data["credit_points"] = $this->common_model->getResult("*");
            $this->common_model->initialize('photos');
            $data["total_pic_count"] = $this->common_model->getCount(array("user_id" => $data["user_detail"]->user_id, "trip_id != "=>0));
            $this->session->set_userdata("user_email", $data["user_detail"]->email);
            $this->session->set_userdata("username", $data["user_detail"]->username);
            $this->load->view('header', $data);
            $this->load->view('edit_profile', $data);
            $this->load->view('footer');
        }else{
            redirect('login');
        }
    }
    public function profile($id="")
    {
        $data = array();
        if($this->session->userdata('is_login'))
        {
            $data["is_following"] = $this->activity_model->is_following($this->session->userdata('user_id'),$id);
        }
        if($id !="")
        {
            $data["profile_detail"] = $this->user_model->getUserDetail($id);
            $data["trip_count"] = $this->user_model->get_count("trip","user_id",$id);
            $data["visited_country"] = count($this->trip_model->getUserVisitedCountry($id));
            $data["user_trips"] = $this->trip_model->getUserTripById($id);
            if(!empty($data["user_trips"]))
            {
                $i=0;
                foreach($data["user_trips"] as $val):
                $data["user_trips"][$i]['picture'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
                $data["user_trips"][$i]['faverites'] = $this->activity_model->is_faverite($val['trip_id'],$val['user_id']);
                if(!empty($data["user_trips"][$i]['faverites'])){
                    $data["user_trips"][$i]['faverites'] = array_column($data["user_trips"][$i]['faverites'], 'user_id');
                }
                $i++;
                endforeach;
            }
            $data["followers"] = $this->activity_model->get_followers($id);
            $data["followings"] = $this->activity_model->get_followings($id);
            $data["trip_reviews"] = $this->trip_model->getTripReviewByUserId($id);
            $this->common_model->initialize('manage_credit_points');
            $data["credit_points"] = $this->common_model->getResult("*");
            $this->common_model->initialize('photos');
            $data["total_pic_count"] = $this->common_model->getCount(array("user_id" => $data["profile_detail"]->user_id, "trip_id != "=>0));
            $this->load->view('header', $data);
            $this->load->view('profile', $data);
            $this->load->view('footer');
        }else{
            redirect("home/no_found");
        }
    }
    public function reset_password()
    {
        $data = array();
        if ($this->session->userdata('is_login'))
        {
            if ($this->input->post(NULL, TRUE))
            {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                $this->form_validation->set_rules(array(
                    array('field' => 'old_password', 'label' => 'Old Password', 'rules' => 'trim|required'),
                    array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|matches[cpassword]'),
                    array('field' => 'cpassword', 'label' => 'Password Confirmation', 'rules' => 'required')
                ));
                if ($this->form_validation->run() === TRUE)
                {
                    $userId = $this->session->userdata('user_id');
                    $OldPassword = $this->input->post('old_password');
                    $NewPassword = $this->input->post('new_password');
                    $cpassword = $this->input->post('cpassword');
                    $checkPass = $this->user_model->checkpassword($OldPassword);
                    if (!$checkPass) {
                        $this->session->set_flashdata('error', 'Sorry, your Old Password is not incorrect!!');
                    } else {
                        $data = array("password" => md5($NewPassword));
                        $updatePass = $this->user_model->update('users', $userId, $data);
                        $this->session->set_flashdata('error', "");
                        $this->session->set_flashdata('success', 'Reset Password Successfully!!');
                    }
                }
            } else {
                $this->session->set_flashdata('success', "");
                $this->session->set_flashdata('error', "");
            }
            $this->load->view('header', $data);
            $this->load->view('reset_password', $data);
            $this->load->view('footer');
        } else {
            redirect('login');
        }
    }
    public function change_cover_image()
    {
        $data = array();
        if($this->session->userdata('is_login'))
        {
            $user_detail = $this->user_model->getUserDetail($this->session->userdata('user_id'));
            if(!empty($user_detail->cover_image)){
                unlink(FCPATH.'uploads/user-pic/'.$user_detail->cover_image);
            }
            if (!empty($_FILES['cover_image']['name']))
            {
                $redirect = $this->input->post("redirect");
                $config['upload_path'] = FCPATH.'uploads/user-pic';
                $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                $fileName = $_FILES['cover_image']['name'];
                $str = $this->randomString(4);
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $new_name = $fileName = time() . $str . "." . $ext;
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if($_FILES['cover_image']['name']!=''){
                    if($this->upload->do_upload('cover_image')){
                        $result = $this->upload->data();
                        $data['cover_image'] = $result['file_name'];
                        $this->user_model->update("users",$this->session->userdata('user_id'),array("cover_image"=>$data['cover_image']));
                    }
                    redirect($redirect,"refresh");
                }
            }
        }else
        {
            redirect('login');
        }
    }
    public function change_profile_pic()
    {
        $data = array();
        if($this->session->userdata('is_login'))
        {
            $user_detail = $this->user_model->getUserDetail($this->session->userdata('user_id'));
            if(!empty($user_detail->profile_pic)){
                unlink(FCPATH.'uploads/user-pic/'.$user_detail->profile_pic);
            }
            if (!empty($_FILES['profile_pic']['name']))
            {
                $redirect = $this->input->post("redirect");
                $config['upload_path'] = FCPATH.'uploads/user-pic';
                $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                $fileName = $_FILES['profile_pic']['name'];
                $str = $this->randomString(4);
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $new_name = $fileName = time() . $str . "." . $ext;
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if($_FILES['profile_pic']['name']!=''){
                    if($this->upload->do_upload('profile_pic')){
                        $result = $this->upload->data();
                        $data['profile_pic'] = $result['file_name'];
                        $this->user_model->update("users",$this->session->userdata('user_id'),$data);
                    }
                    redirect($redirect,"refresh");
                }
            }
        }else
        {
            redirect('login');
        }
    }
    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function send_message()
    {
        $data = array();
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $isConversion = FALSE;
            if($this->input->post("isConversion")){
                $isConversion = TRUE;
            }
            if (!empty($_FILES['msg_photos']['name']))
            {
                $config['upload_path'] = FCPATH.'uploads/message/img';
                $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                $fileName = $_FILES['msg_photos']['name'];
                $str = $this->randomString(4);
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $new_name = $fileName = time() . $str . "." . $ext;
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if($_FILES['msg_photos']['name']!=''){
                    if($this->upload->do_upload('msg_photos')){
                        $result = $this->upload->data();
                        $attributes['image'] = $result['file_name'];
                    }else{
                        echo json_encode(array('error'=>TRUE , 'message'=>$this->upload->display_errors()));
                        exit;	
                    }
                }
            }
            if (!empty($_FILES['msg_files']['name']))
            {
                $config['upload_path'] = FCPATH.'uploads/message/doc';
                $config['allowed_types'] = '*';//'pdf|ppt|doc|ext|docx|xml|zip|php|txt';
                $fileName = $_FILES['msg_files']['name'];
                $str = $this->randomString(4);
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $new_name = $fileName = time() . $str . "." . $ext;
                $config['file_name'] = $new_name;
                //$this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($_FILES['msg_files']['name']!=''){
                    if($this->upload->do_upload('msg_files')){
                        $result = $this->upload->data();
                        $attributes['doc'] = $result['file_name'];
                    }else{
                        echo json_encode(array('error'=>TRUE , 'message'=>$this->upload->display_errors()));
                        exit;
                    }
                }
            }
            $attributes['message']	= $this->input->post("message");
            $attributes['to']	= $this->input->post("to");
            $attributes['from']	= $this->session->userdata('user_id');
            $attributes['created_date']	= date("Y-m-d H:i:s");
            $msg_id = $this->activity_model->saveData("message", $attributes);
            $data['msgContent'] = '';
            if(isset($isConversion)){
                $data['messages'] = $this->user_model->getMessageUserList($attributes['to'] ,$attributes['from']);
                $data['msgContent'] = $this->load->view("conversion", $data, TRUE);	
            }
            if($msg_id){
                echo json_encode(array('error'=> FALSE , 'message'=>'Message has been successfully send.',  "msgContent" => $data['msgContent']));
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'Sorry, some error are exist.so please try again!'));
            }
        }
        exit;
    }
    public function message()
    {
        $data = array();
        if (!$this->session->userdata('is_login')) 
        {
            redirect('login');
        }else{
            $data['messageUsers'] = $this->user_model->getUserMessage($this->session->userdata("user_id"));
            if(!empty($data['messageUsers'])){
                $data['messages'] = $this->user_model->getMessageUserList($data['messageUsers'][0]->to,$data['messageUsers'][0]->from);		
            }else{
                $data['messages'] = array();
            }
            //prx($data['messages']);
            $this->load->view('header',$data);        
            $this->load->view('message',$data);		
            $this->load->view('footer');
        }
    }
    public function message_conversion()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $from = $this->input->post("from");
            $data["profile"] = $this->user_model->getUserDetail($from);
            $data['messages'] = $this->user_model->getMessageUserList($from, $this->session->userdata("user_id"));
            $data['profileContent'] = $this->load->view("profile_content", $data, TRUE);
            $data['msgContent'] = $this->load->view("conversion", $data, TRUE);
            echo json_encode(array('error'=> FALSE , 'msgContent'=>$data['msgContent'], 'profileContent' =>$data['profileContent'],"profile_id" => $data["profile"]->user_id));
        }
        exit;
    }
    public function get_contect_list()
    {
        $keyword = $this->input->get("q");
        //$search=$this->input->get_post(NULL,true);
        if($keyword != ''){
            $userData = $this->user_model->get_contect_list($keyword,$this->session->userdata("user_id"));
            $data = array();
            if($userData){
                foreach($userData as $user)
                {
                    $array=array();
                    $array['user_id'] = $user->user_id;
                    $array['name'] = (!empty($user->first_name) && !empty($user->last_name))?ucwords($user->first_name." ".$user->last_name):ucwords($user->username);
                    $data[]=$array;
                }
            }
        }
        echo json_encode($data);
        exit;
    }
    public function reset_notifications()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $data['wishlist_count'] = count($this->getUserWishlist());
            $data['message_count'] = $this->user_model->getMessageCount();
            //$data['notificationContent'] = $this->load->view("reset_notification", $data, TRUE);
            echo json_encode(array('error'=> FALSE , $data));
        }
        exit;
    }
    public function save_wishtips()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $error_html = "";
            $postData = $this->input->post(NULL, TRUE);
            $attributes['owner_id'] = $this->session->userdata("user_id");
            $attributes['images'] = isset($postData['storage_files']) ?implode(",",$postData['storage_files']):'';
            if($postData['tips_title']){
                $attributes['title'] = $postData['tips_title'];
            }else{
                $error_html .= "<p>Tips title is required!</p>";
            }
            if(isset($postData['tips_description']) && !empty($postData['tips_description'])){
                $attributes['description'] = $postData['tips_description'];
            }else{
                $error_html .= "<p> Tips description is required!</p>";
            }
            if(isset($postData['wishtips_location']) && !empty($postData['wishtips_location'])){
                $attributes['location'] = $postData['wishtips_location'];
                $attributes['lat'] = $postData['lat'];
                $attributes['long'] = $postData['long'];
            }else{
                $error_html .= "<p> Tips location is required!</p>";
            }
            if(isset($postData['wishtips_cat']) && !empty($postData['wishtips_cat'])){
                if($postData['wishtips_cat'] != "Others"){
                    $attributes['category'] = $postData['wishtips_cat'];
                }else{
                    if(isset($postData['wishtips_other_category']) && !empty($postData['wishtips_other_category'])){
                        $attributes['category'] = $postData['wishtips_other_category'];
                    }else{
                        $error_html .= "<p> Tips others category fields is required!</p>";
                    }
                }
            }else{
                $error_html .= "<p> Tips category is required!</p>";
            }
            if(!$error_html){
                $attributes['created_date'] = date("Y-m-d H:i:s");
                $this->common_model->initialize('wishtips');
                $wishtip_id = $this->common_model->insert($attributes);
                if($wishtip_id){
                    $activity['obj_type_id'] = $this->activity_model->get_object_type_id("tip");
                    $activity['obj_id'] = $wishtip_id;
                    $activity['act_type_id'] = $this->activity_model->get_activity_type_id('post_tip');
                    $activity['obj_parent_id'] = $this->session->userdata('user_id');
                    $activity['user_id'] = $this->session->userdata('user_id');
                    $activity['created_date'] = date("Y-m-d H:i:s");
                    $created_by = $activity['created_by'] = $this->session->userdata('user_id');
                    $modified_by = $activity['modified_by'] = $this->session->userdata('user_id');
                    $activity_id=$this->activity_model->is_available_activity($activity['obj_type_id'],$activity['obj_id'],'',$activity['act_type_id'],$activity['user_id']);
                    if(!$activity_id){
                        $act_id = $this->activity_model->saveData("activity",$activity);
                        //Set notification.
                        $userId = $activity['obj_id'];
                        $subTypeId = $this->activity_model->get_object_type_id('tip'); 
                        $subId = $this->session->userdata('user_id'); 
                        $objTypeId = $activity['obj_type_id'];
                        $objId = $activity['obj_id'];
                        $params='';
                        $imageIds=$attributes['images'];
                        $notificationTypeId = $this->activity_model->get_notification_type_id('following_you');
                        $not_id = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                        if($act_id  && $not_id ){
                            $data["wishtips"] = $wishtip = $this->user_model->get_all_wishtips();
                            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
                            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");
                            if(!empty($data["wishtips"])){
                                foreach($data["wishtips"] as $k=>$wishtip){
                                    $data["wishtips"][$k]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                                    $data["wishtips"][$k]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                                    $data["wishtips"][$k]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                                    $data["wishtips"][$k]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                                    $data["wishtips"][$k]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                                    $data["wishtips"][$k]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                                    $data["wishtips"][$k]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                                    $data["wishtips"][$k]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                                    $data["wishtips"][$k]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                                }
                            }
                            
                             $this->common_model->initialize('wishtips');
                            $data["total_count"] = $total_count = $this->common_model->getCount();
                            $data['htmlContent'] = $this->load->view('wishtip_data', $data, TRUE);
                            echo json_encode(array('error'=> FALSE , "message"=>"Great! your live tips has been successfully saved.", 'htmlContent'=>$data['htmlContent']));
                        }else{
                            echo json_encode(array('error'=> TRUE , 'message'=>'some error are exist.so please try again!'));
                        }
                    }
                }else{
                    echo json_encode(array('error'=> TRUE, 'message'=>'some error are exist.so please try again!'));
                }
            }else{
                echo json_encode(array('error'=>TRUE , 'message'=>$error_html));
            }
        }
        exit;
    }
    public function getWishtipFilterData()
    {
        $data = array();
        $count = 5;
        $offset = 0;
        $postData = $this->input->post(NULL, TRUE);
        $wishtips_category = $postData['wishtips_category'];
        $filter_location = $postData['filter_location'];
        if(!empty($wishtips_category) || !empty($filter_location)){
            $data["wishtips"] = $trips = $this->user_model->getFilterData($count, $offset,$filter_location, $wishtips_category);
            $data["total_count"] = count($trips = $this->user_model->getFilterData('', '',$filter_location, $wishtips_category));
            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");
            if(!empty($data["wishtips"])){
                foreach($data["wishtips"] as $k=>$wishtip){
                    $data["wishtips"][$k]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                    $data["wishtips"][$k]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                }
            }
            $data["cat"] = $wishtips_category;
            $data["location"] = $filter_location;
            $data['htmlContent'] = $this->load->view('wishtip_data', $data, TRUE);
            echo json_encode(array('error'=> FALSE , 'htmlContent'=>$data['htmlContent']));
        }else{
            echo json_encode(array('error'=> TRUE, 'message'=>'some error are exist.so please try again!'));
        }
        exit;
    }
    public function more_wishtips($page = "")
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $count = 5;
            $offset = $count*$page;
            $new_offset = $offset+$count;
            $postData = $this->input->post(NULL, TRUE);
            $params['user_id'] = $user_id = $postData['user_id'];
            $params['location'] = $location = $postData['location'];
            $params['category'] = $category = $postData['category'];
            $params['bookmark'] = $bookmark = $postData['bookmark'];
            $this->common_model->initialize('wishtips');
            $total_count = $this->common_model->getCount();
            if($bookmark){
                $act_type_id_bookmark = $this->activity_model->get_activity_type_id("bookmark_tip");
                $data["wishtips"] = $this->user_model->getUserBookmarkTip($count, $offset,$act_type_id_bookmark);
                $total_count = $this->user_model->getUserBookmarkTipCount($count, $offset,$act_type_id_bookmark);
            }elseif(!empty($params['user_id'])){
                $total_count = $this->user_model->getUserWishtipCount();
                $data["wishtips"] = $this->user_model->getUserWishtip($count, $offset);
            }else{
                $data["wishtips"] = $this->user_model->get_all_wishtips("",$count, $offset,$params);
                $total_count = $this->user_model->get_all_wishtips_count("",$count, $offset,$params);
            }
            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");

            if(!empty($data["wishtips"])){
                foreach($data["wishtips"] as $k=>$wishtip){
                    $data["wishtips"][$k]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                    $data["wishtips"][$k]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                }
            }

            $htmlContent = $this->load->view('loadmoreWishtips',$data, TRUE);
            if($total_count>$new_offset){
                $htmlContent .= '<div class="show-more">
<a data-id="'.$params['user_id'].'" data-location = "'.$params['location'].'" data-cat="'.$params['category'].'" data-set="'.FALSE.'" data-bookmark="'.$params['bookmark'].'" data-loading-text="Loading..." class="more btn btn-link btn-block" data-offset="'.$new_offset.'" id="loadmoreTip">Show More...</a>
</div> ';
            }
            echo json_encode(array('title'=> '','count'=>count($data['wishtips']), 'content'=>$htmlContent));
        }
    }
    public function tips_detail($id="")
    {
        $data = array();
        if($id !=""){
            $count = 5;
            $offset = 0;
            $data['recent_trips'] = $this->trip_model->get_all_trip_data(12, $offset);
            if(!empty($data['recent_trips'])){
                $i=0;
                foreach($data['recent_trips'] as $val):
                $data["recent_trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
                if(!empty($data["recent_trips"][$i]['photos'])){
                    $data["recent_trips"][$i]['photos'] = $data["recent_trips"][$i]['photos'][0]['file_name'];
                }else{
                    $data["recent_trips"][$i]['photos'] = '';
                }
                $i++;
                endforeach;
            }
            $this->common_model->initialize('banners');
            $data["advertisments"] = $this->common_model->getResult("*", array("payment_status"=>1));
            $data["wishtips"] = $this->user_model->get_all_wishtips($id);
            $data["wishtip"] = $wishtip =!empty($data["wishtips"])?$data["wishtips"][0]:array();
            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");
            if(!empty($data["wishtip"])){
                $data["wishtip"]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                $data["wishtip"]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                $data["wishtip"]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                $data["wishtip"]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                $data["wishtip"]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                $data["wishtip"]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                $data["wishtip"]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                $data["wishtip"]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                $data["wishtip"]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                $data["comments"] = $this->activity_model->getCommentById($wishtip->wishtips_id, $wishtip->owner_id,$act_type_id_coment);
            }
            $this->load->view('header',$data);        
            $this->load->view('tips_detail',$data);		
            $this->load->view('footer');	
        }else{
            redirect("");
        }
    }
    public function user_wishtips()
    {
        $data = array();
        if($this->session->userdata('user_id'))
        {
            $count = 5;
            $offset = 0;
            $data['recent_trips'] = $this->trip_model->get_all_trip_data(12, $offset);
            if(!empty($data['recent_trips'])){
                $i=0;
                foreach($data['recent_trips'] as $val):
                $data["recent_trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
                if(!empty($data["recent_trips"][$i]['photos'])){
                    $data["recent_trips"][$i]['photos'] = $data["recent_trips"][$i]['photos'][0]['file_name'];
                }else{
                    $data["recent_trips"][$i]['photos'] = '';
                }
                $i++;
                endforeach;
            }
            //prx($data['recent_trips']);
            $this->common_model->initialize('banners');
            $data["advertisments"] = $this->common_model->getResult("*", array("payment_status"=>1));
            $data["wishtips"] = $this->user_model->getUserWishtip($count, $offset);
            $data["total_count"] = $this->user_model->getUserWishtipCount();
            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");
            if(!empty($data["wishtips"])){
                foreach($data["wishtips"] as $k=>$wishtip){
                    $data["wishtips"][$k]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                    $data["wishtips"][$k]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                }
            }
            $data['tip_count'] = count($this->user_model->getUserWishtip($count, $offset));
            
            $this->load->view('header',$data);        
            $this->load->view('user_wishtips',$data);		
            $this->load->view('footer');		
        }else
        {
            redirect('login');
        }
    }
    public function bookmark_wishtips()
    {
        $data = array();
        if($this->session->userdata('user_id'))
        {
            $count = 5;
            $offset = 0;
            $data['recent_trips'] = $this->trip_model->get_all_trip_data(12, $offset);
            if(!empty($data['recent_trips'])){
                $i=0;
                foreach($data['recent_trips'] as $val):
                $data["recent_trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
                if(!empty($data["recent_trips"][$i]['photos'])){
                    $data["recent_trips"][$i]['photos'] = $data["recent_trips"][$i]['photos'][0]['file_name'];
                }else{
                    $data["recent_trips"][$i]['photos'] = '';
                }
                $i++;
                endforeach;
            }
            $act_type_id_bookmark = $this->activity_model->get_activity_type_id("bookmark_tip");
            $this->common_model->initialize('banners');
            $data["advertisments"] = $this->common_model->getResult("*", array("payment_status"=>1));
            $data["wishtips"] = $this->user_model->getUserBookmarkTip($count, $offset,$act_type_id_bookmark);
            $data["bookmark_count"] = $this->user_model->getUserBookmarkTipCount($count, $offset,$act_type_id_bookmark);
            $data["total_count"] = $this->user_model->getUserBookmarkTipCount('', $offset,$act_type_id_bookmark);
            $act_type_id_coment = $this->activity_model->get_activity_type_id("comment_tip");
            $act_type_id_share = $this->activity_model->get_activity_type_id("share_tip");
            if(!empty($data["wishtips"])){
                foreach($data["wishtips"] as $k=>$wishtip){
                    $data["wishtips"][$k]->like_count = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like = $this->activity_model->getTipLikeCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->is_bookmark = $this->activity_model->checkBookmarkExist($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_count = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane = $this->activity_model->getTipLikePlaneCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->like_plane_in_count = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id);
                    $data["wishtips"][$k]->is_like_plane_in = $this->activity_model->getTipLikePlaneInCount($wishtip->wishtips_id, $wishtip->owner_id,$this->session->userdata('user_id'));
                    $data["wishtips"][$k]->comment_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_coment);
                    $data["wishtips"][$k]->share_count = $this->activity_model->getLikeCount($wishtip->wishtips_id, $wishtip->owner_id, $act_type_id_share);
                }
            }
            $this->common_model->initialize('activity');
            
            $this->load->view('header',$data);        
            $this->load->view('bookmark_wishtips',$data);		
            $this->load->view('footer');		
        }else
        {
            redirect('login');
        }
    }
    public function remove_wishtips()
    {
        if (!$this->session->userdata('user_id')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $tip_id = $this->input->post("tip_id");
            $this->common_model->initialize('wishtips','wishtips_id');
            $tip_detail = $this->common_model->getById($tip_id);
            if(!empty($tip_detail->images)){
                $results = explode(",", $tip_detail->images);
                $targetDir = FCPATH.'uploads/tips-images/';
                if(is_array($results)){
                    foreach ($results as $key => $value) {
                        $targetFile = $targetDir . $value;
                        unlink($targetFile);
                    }
                }else{
                    $targetFile = $targetDir . $results;
                    unlink($targetFile);
                }
            }
            $delete = $this->user_model->remove_wishtips($tip_id);
            if($delete){
                echo json_encode(array('error'=>FALSE , 'message'=>'Tip has been successfully deleted.'));
            }else{
                echo json_encode(array('error'=>TRUE , 'message'=>'Sorry, some error are exist. please try again.'));
            }
        }
        exit;
    }
    public function user_subscribed()
    {
        $this->form_validation->set_rules(array(
            array('field'=>'subscriber', 'label'=>'Subscriber Email', 'rules'=>'trim|required|valid_email'),
        ));
        if ($this->form_validation->run() === TRUE) {
            $subscriber = $this->input->post("subscriber");
            $checkSubscriber = $this->user_model->checksubscriber($subscriber);
            if ($checkSubscriber) {
                echo json_encode(array('error'=> TRUE, 'message'=>'Sorry, subscriber email allready exist!!'));
            } else {
                $data["email"] = $subscriber;
                $this->common_model->initialize('subscriber','subscriber_id');
                $last_id = $this->common_model->insert($data);
                if($last_id){
                    echo json_encode(array('error'=> False, 'message'=>'Subscriber has been successfully saved.'));
                }
            }
        }else{
            echo json_encode(array('error'=> TRUE, 'message'=> validation_errors()));	
        }
        exit;
    }
    public function change_password ()
    {	
        $data = array();
        $id = ($this->input->get("id"))?$this->input->get("id"):"";
        if($id != "" || $this->session->userdata("temp_user_id")){
            $id = ($id)?$id:$this->session->userdata("temp_user_id");
            $account = $this->user_model->get_by_id($id);
            if(!empty($account)){
                if (($this->input->get('token') == sha1($account->user_id.strtotime($account->resetsenton).$account->code)) || $this->session->userdata("temp_user_id"))
                {
                    $this->session->set_userdata("temp_user_id", $account->user_id);
                    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                    $this->form_validation->set_rules(array(
                        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|matches[cpassword]'),
                        array('field' => 'cpassword', 'label' => 'Password Confirmation', 'rules' => 'required')
                    ));
                    if ($this->form_validation->run() === TRUE)
                    {
                        $userId =  $account->user_id;
                        $NewPassword = $this->input->post('password');
                        $cpassword = $this->input->post('cpassword');
                        $data = array("password" => md5($NewPassword));
                        $updatePass = $this->user_model->update('users', $this->session->userdata("temp_user_id"), $data);
                        $code = $this->user_model->update_code($this->session->userdata("temp_user_id"), NULL);
                        $this->session->unset_userdata("temp_user_id");
                        $data["success"] = "Reset Password Successfully. please login your new login password!!";
                    }
                    $this->load->view('header');        
                    $this->load->view('change_password',$data);		
                    $this->load->view('footer');
                }else{
                    $this->load->view('header');        
                    $this->load->view('change_password_error');		
                    $this->load->view('footer');
                }
            }else{
                redirect("");
            }
        }else{
            redirect("");
        }
    }
    public function get_all_notification($page=0)
    {
        if (!$this->session->userdata('user_id')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            if(IS_AJAX){
                $count = ($page>1)?10:5;
                $offset = $count*$page;
                $new_offset = $offset+$count; 
                $returnHtml = '';
                $this->common_model->initialize('notifications');
                $total_count = $this->common_model->getCount(array('notifications.notification_type_id !=' =>2));
                $notifications = $this->user_model->getAllNotifications($count,$offset);
                $i=0;
                $data = array();
                foreach($notifications as $notification){
                    $data['notification'] = $notification;
                    $data['notification']->subjectType = $subjectType = $this->activity_model->get_object_type($notification->subject_type_id);
                    if($subjectType =='user'){
                        $data['notification']->subjectDetail = $this->user_model->get_by_id($notification->subject_id);
                    }elseif($subjectType =='trip'){
                        $data['notification']->subjectDetail = $this->user_model->get_by_id($notification->subject_id);
                    }elseif($subjectType =='tip'){
                        $data['notification']->subjectDetail = $this->user_model->get_by_id($notification->subject_id);
                    }
                    $data['notification']->objectType = $objectType = $this->activity_model->get_object_type($notification->object_type);
                    if($objectType =='user'){
                        $data['notification']->objectDetail = $this->user_model->get_by_id($notification->object_id);
                    }elseif($objectType =='trip'){
                        $data['notification']->objectDetail = $this->trip_model->getTripById('trips',array("trip_id"=>$notification->object_id, "publish" => 1));
                    }elseif($objectType =='tip'){
                        $data['notification']->objectDetail = $this->user_model->get_wishtips_by_id($notification->object_id);
                    }
                    $returnHtml .= $this->load->view('notification' , $data , true);
                    $i++;
                }
                if($total_count>$new_offset){
                    $returnHtml .= '<div class="row-fluid" id="more_user_notifications">';
                    $returnHtml .= '<button data-loading-text="Loading..." class="more btn btn-link btn-block" offset="'.$new_offset.'" id="moreNotification">Show More Notifications...</button>';
                    $returnHtml .='</div>';
                }
                echo json_encode(array('error'=> FALSE, 'count'=>$new_offset,'content'=>$returnHtml));
            }
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('is_login');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('type');
        $this->session->all_userdata();
        redirect('login');
    }
    /** Function by rahul 22.11.16 **/
    public function how_it_work()
    {
        $data = array();		
        $this->load->view('header');        
        $this->load->view('how_it_work');		
        $this->load->view('footer');		
    }
    public function about_us()
    {
        $data = array();
        $this->load->view('header'); 
        $this->load->view('about_us');
        $this->load->view('footer');
    }	
    public function no_found()
    {
        $this->load->view('no_found');		
    }
    public function privacy()
    {
        $this->load->view('header');
        $this->load->view('privacy');
        $this->load->view('footer');
    }
    public function support()
    {	
        $this->load->view('header');        
        $this->load->view('support');		
        $this->load->view('footer');		
    }
    public function contact_us()
    {	
        $this->load->view('header');        
        $this->load->view('contact_us');		
        $this->load->view('footer');		
    }
    public function advertisement()
    {	
        $data = array();
        if($this->session->userdata('user_id'))
        {
            $this->common_model->initialize('plans');
            $data['plans'] = $this->common_model->getResult("*");
            if($this->input->post(NULL, TRUE))
            {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                $this->form_validation->set_rules(array(
                    array('field'=>'banner_image', 'label'=>'Banner Image ', 'rules'=>'trim|required'),
                    array('field'=>'banner_link', 'label'=>'Banner Link ', 'rules'=>'trim|required'),
                    array('field'=>'banner_size', 'label'=>'Banner Size', 'rules'=>'trim|required'),
                    array('field'=>'plans_duration_type', 'label'=>'Banner Period Type', 'rules'=>'trim|required'),
                    array('field'=>'plans_duration', 'label'=>'Banner Period', 'rules'=>'trim|required'),
                    array('field'=>'start_date', 'label'=>'Start On', 'rules'=>'trim|required'),
                    array('field'=>'views', 'label'=>'Views Count', 'rules'=>'trim|required'),
                ));
                if ($this->form_validation->run() == TRUE)
                {
                    $custom_params = array(
                        "banner_image" => $this->input->post('banner_image')?$this->input->post('banner_image'):NULL,
                        "banner_link" => $this->input->post('banner_link')?$this->input->post('banner_link'):NULL,
                        "banner_size" => $this->input->post('banner_size')?$this->input->post('banner_size'):NULL,
                        "plans_duration_type" => $this->input->post('plans_duration_type')?$this->input->post('plans_duration_type'):NULL,
                        "plans_duration" => $this->input->post('plans_duration')?$this->input->post('plans_duration'):NULL,
                        "start_date" => $this->input->post('start_date')?date("Y-m-d H:i:s", strtotime($this->input->post('start_date'))):NULL,
                        "views" => $this->input->post('views')?$this->input->post('views'):NULL,
                        "user_id" => $this->session->userdata('user_id'),
                        "created_date" =>date("Y-m-d H:i:s")
                    );
                    $date = $custom_params['start_date'];
                    $start_date = strtotime($date);
                    if($custom_params['plans_duration_type'] == "day"){
                        $custom_params['expiry_date'] = date('Y-m-d H:i:s',strtotime($custom_params['plans_duration']." day", $start_date));
                    }elseif($custom_params['plans_duration_type'] == "month"){
                        $custom_params['expiry_date'] =  date('Y-m-d H:i:s',strtotime($custom_params['plans_duration']." month", $start_date));
                    }else{
                        $custom_params['expiry_date'] = NULL;
                    }
                    $amount = '';
                    if (!empty($data['plans'])){
                        foreach ($data['plans'] as $plan){
                            if($custom_params['plans_duration_type'] == $plan->type && $custom_params['plans_duration'] == $plan->plans_day){
                                $amount=$plan->plans_rate;
                            }elseif ($custom_params['plans_duration_type'] == $plan->type && $custom_params['plans_duration'] == $plan->plans_month){
                                $amount=$plan->plans_rate;
                            }
                        }
                    }
                    $str = $this->randomString(5);
                    $custom_params['item_number'] = $item_number = time().'_'.$str;
                    $custom_params['amount'] = $amount;
                    $this->common_model->initialize('banners');
                    $custom_params['insert_id'] = $insert_id = $this->common_model->insert($custom_params);
                    $this->session->set_userdata('cart', $custom_params);
                    redirect('payment/process', 'Location');
                    //Set variables for paypal form
                    /*$paypalURL = PAYPAL_SANDBOX_URL; //test PayPal api url
$paypalID = PAYPAL_ID; //business email
$returnURL = base_url().'home/paymentSuccess'; //payment success url
$cancelURL = base_url().'home/advertisement'; //payment cancel url
$notifyURL = base_url().'home/ipn'; //ipn url
//get particular product data
$userID = $this->session->userdata('user_id'); //current user id
$logo = base_url().'assets/images/logo.png';
$this->paypal_lib->add_field('business', $paypalID);
$this->paypal_lib->add_field('return', $returnURL);
$this->paypal_lib->add_field('cancel_return', $cancelURL);
$this->paypal_lib->add_field('notify_url', $notifyURL);
$this->paypal_lib->add_field('item_name','');
$this->paypal_lib->add_field('item_number',  $item_number);
$this->paypal_lib->add_field('amount',$amount);
$this->paypal_lib->add_field('custom',json_encode($custom_params));
$this->paypal_lib->image($logo);
$this->paypal_lib->paypal_auto_form();*/
                }
            }
            $this->load->view('header',$data);        
            $this->load->view('advertisment',$data);		
            $this->load->view('footer');
        }else{
            redirect("");
        }	
    }
    public function paymentSuccess()
    {
        if($this->session->userdata('user_id'))
        {
            $this->load->view('header');
            $this->load->view('payment/payment_complete');
            $this->load->view('footer');
        }else{
            redirect("");
        }
    }
    public function report()
    {
        if(IS_AJAX && $this->session->userdata('user_id')){
            if ($this->input->post(NULL, TRUE))
            {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                $this->form_validation->set_rules(array(
                    array('field' => 'reason', 'label' => 'Reason', 'rules' => 'trim|required'),
                    array('field' => 'tip_feedback', 'label' => 'Please give reason about this', 'rules' => 'trim|required'),
                ));
                if ($this->form_validation->run() === TRUE)
                {
                    $post['user_id'] = $this->session->userdata('user_id');
                    $post['reason'] = $this->input->post('reason') ? $this->input->post('reason'):'';
                    $post['feedback'] = $this->input->post('tip_feedback') ? $this->input->post('tip_feedback') :'';
                    $post['wishtip_id'] = $this->input->post('wishtip_id') ? $this->input->post('wishtip_id') :'';
                    $post['creation_date'] = date("Y-m-d H:i:s");
                    $post_id = $this->activity_model->saveData('wishtip_report',  $post);
                    if($post_id){
                        echo json_encode(array('error'=> FALSE, 'message'=>'Your report has been successfully forwarded to site admin.'));
                    }else{
                        echo json_encode(array('error'=> TRUE, 'message'=>'some error are exist.so please try again!'));
                    }
                }
            } else {
                echo json_encode(array('error'=> TRUE, 'message'=>'some error are exist.so please try again!'));
            }
        }else{
            echo json_encode(array('error'=> TRUE, 'message'=>'Sorry, Please login first.'));
        }
        exit;
    }
}