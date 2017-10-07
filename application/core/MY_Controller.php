<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array("trip_model","user_model","activity_model"));
        $data = array();
        $data['SETTINGS'] = array();
        $this->load->model('common_model');
        $this->common_model->initialize('settings');
		$settings = $this->common_model->getResult("*");
        foreach ($settings as $setting) {
            $data['SETTINGS'][$setting->key] = $setting->value;
        }
		if($this->session->userdata('user_id'))
		{
			$data["user_detail"] = $this->user_model->getUserDetail($this->session->userdata('user_id'));
			$data['wishlist_count'] = count($this->getUserWishlist());
            $data['message_count'] = $this->user_model->getMessageCount();
            $data['wishtip_count'] = $this->user_model->getUserWishtipCount();
            $this->common_model->initialize('notifications');
            $data['notifications_count'] = $this->common_model->getCount(array('notifications.notification_type_id !=' =>2,'read' =>0));
            $this->common_model->initialize('activity');
            $data['bookmark_count'] = count($this->user_model->getUserBookmarkTip('',0,11));
		}
        $this->load->vars($data);
    }
	
	public function getUserWishlist($trip_id = '')
	{
		$data = array();
		if($this->session->userdata('is_login')){
			return $this->activity_model->getUserWishlist($this->session->userdata('user_id'), $trip_id);
		}else{
			redirect("login");
		}
	}

    public function setActivity($obj_type_id, $objectId, $obj_parent_id="", $activity_type_id, $user_id, $data)
    {
        $activityData = array(
            "obj_type_id" =>$obj_type_id,
            "obj_id" =>$objectId,
            "obj_parent_id" =>$obj_parent_id,
            "act_type_id" =>$activity_type_id,
            "user_id" =>$user_id,
            "data" =>$data,
            "time" =>date("Y-m-d H:i:s"),
            "created_date" =>date("Y-m-d H:i:s"),
            "created_by" =>$data,
            "modified_by" =>$objectId,
        );
        $result = $this->activity_model->saveData("activity", $activityData);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notTypeId, $params, $imageIds=''){
		$this->load->helper('date');
		$attribute['subject_type_id'] = $subTypeId;
		$attribute['subject_id'] = $subId;
		$attribute['object_type'] = $objTypeId;
		$attribute['object_id'] = $objId;
		$attribute['image_ids'] = $imageIds;
		$attribute['notification_type_id'] = $notTypeId;
		$attribute['user_id'] = $userId;
		$attribute['params'] = $params;
		$attribute['created_date'] = mdate('%Y-%m-%d %H:%i:%s', now());
		$notification_id = $this->activity_model->saveData("notifications",$attribute);
		if($notification_id) return $notification_id;
        else return FALSE;
	}

    function sendEmail($to , $from, $fromName , $subject , $message){
        $this->load->library('email', array('mailtype'=>'html'));
        $this->email->from($from, $fromName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()){
            return TRUE;
        }else{
           return FALSE;
        }
    }
}
