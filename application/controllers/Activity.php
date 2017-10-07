<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity extends MY_Controller {
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
        $this->load->model(array("activity_model","user_model","common_model"));
    }

    public function follow()
    {
        $data = array();
        if($this->session->userdata('is_login')){
            if($this->input->post(NULL,TRUE)){
                $postData = $this->input->post(NULL,TRUE);
                //For user following
                $attribute['obj_type_id'] = $this->activity_model->get_object_type_id($postData['objType']);
                $following ["following_id"] = $attribute['obj_id'] = $postData['objectId'];
                if($postData['objType']=='user'){
                    $attribute['act_type_id'] = $this->activity_model->get_activity_type_id('user_following');
                }
                $following ["follower_id"] = $attribute['user_id'] = $this->session->userdata('user_id');
                $following ["created_date"] = $attribute['created_date'] = date('Y-m-d H:i:s');
                $attributes['time'] = date('Y-m-d H:i:s');
                $activity_id=$this->activity_model->is_available_activity($attribute['obj_type_id'],$attribute['obj_id'],'',$attribute['act_type_id'],$attribute['user_id']);
                if(!$activity_id){
                    $created_by = $attribute['created_by'] = $attribute['obj_id'];
                    $modified_by = $attribute['modified_by'] = $this->session->userdata('user_id');
                    $act_id1 = $this->activity_model->saveData("activity",$attribute);
                    $attribute['act_type_id'] = $this->activity_model->get_activity_type_id('following_you');
                    $act_id2 = $this->activity_model->saveData("activity",$attribute);
                    if($postData['objType']=='user'){
                        $userId = $attribute['obj_id'];
                        $subTypeId = $this->activity_model->get_object_type_id('user'); 
                        $subId = $this->session->userdata('user_id'); 
                        $objTypeId = $attribute['obj_type_id'];
                        $objId = $attribute['obj_id'];
                        $params='';
                        $imageIds='';
                        $notificationTypeId = $this->activity_model->get_notification_type_id('following_you');
                        $not_id1 = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                        $notificationTypeId = $this->activity_model->get_notification_type_id('user_following'); 
                        $not_id2 = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                    }
                    $following ["activity_id"] = $act_id1.",".$act_id2;
                    $following ["notification_id"] = $not_id1.",".$not_id2;
                    $follow_id = $this->activity_model->saveData("user_followers",$following);
                    if($act_id1 && $act_id2 && $not_id1 && $not_id2 && $follow_id){
                        echo json_encode(array('error'=> FALSE , 'message'=>'followed'));
                    }else{
                        echo json_encode(array('error'=> TRUE , 'message'=>'some error are exist.so please try again!'));
                    }
                }else{
                    echo json_encode(array('error'=> TRUE , 'message'=>'You are allready follow this user.'));
                }
            }else{
                echo json_encode(array('error'=> TRUE, 'message'=>'some error are exist.so please try again!'));
            }
        }else{
            echo json_encode(array('error'=> TRUE , 'message'=>'you have not login.'));
        }
    }

    public function unfollow()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $follower_id = $this->session->userdata('user_id');
            $following_id = $this->input->post('objectId');
            $follower = $this->activity_model->getFollowingById($follower_id,$following_id);
            if(!empty($follower->activity_id)){
                $results = explode(",", $follower->activity_id);
                if(is_array($results)){
                    foreach ($results as $key => $value) {
                        $deleted = $this->activity_model->delete("activity", array("act_id"=>$value));
                    }
                }else{
                    $deleted = $this->activity_model->delete("activity", array("act_id"=>$follower->activity_id));
                }
            }
            if(!empty($follower->notification_id)){
                $results = explode(",", $follower->notification_id);
                if(is_array($results)){
                    foreach ($results as $key => $value) {
                        $deleted = $this->activity_model->delete("notifications", array("notification_id"=>$value));
                    }
                }else{
                    $deleted = $this->activity_model->delete("notifications", array("notification_id"=>$follower->notification_id));
                }
            }
            $deleted = $this->activity_model->delete("user_followers", array("follower_id"=>$follower_id, "following_id"=>$following_id));
            if($deleted){
                echo json_encode(array('error'=> FALSE , 'message'=>'unfollowed'));
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'some error are exist.so please try again!'));
            }
        }
    }

    public function favorite()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $postData = $this->input->post(NULL,TRUE);
            //For user faverite trip.
            $attributes['trip_id'] = $trip_id =  $postData['objectId'];
            $attributes['owner_id'] = $postData['ownerId'];
            $attributes['user_id'] = $this->session->userdata('user_id');
            $wishlist_id=$this->activity_model->is_available_wishlist($attributes['trip_id'],$attributes['owner_id'],$attributes['user_id']);
            if(!$wishlist_id){	
                $attributes['created_date'] = date('Y-m-d H:i:s');
                $wish_id = $this->activity_model->saveData("trip_wishlists",$attributes);
                if($wish_id){
                    echo json_encode(array('error'=> FALSE , 'message'=>'favorited', 'href' =>base_url('activity/unfavorite'),'id'=>'ubwish-'.$trip_id));
                }else{
                    echo json_encode(array('error'=> TRUE , 'message'=>'some error are exist.so please try again!'));
                }
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'This trip already exist in your wishlist.'));
            }
        }
        exit;
    }

    public function unfavorite()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $postData = $this->input->post(NULL,TRUE);
            //For user faverite trip.
            $attributes['trip_id'] = $trip_id = $postData['objectId'];
            $attributes['owner_id'] = $postData['ownerId'];
            $attributes['user_id'] = $this->session->userdata('user_id');
            $is_delete = $this->activity_model->delete("trip_wishlists", array("trip_id"=>$attributes['trip_id'], "owner_id"=>$attributes['owner_id'], "user_id"=>$attributes['user_id']));
            if($is_delete){	
                echo json_encode(array('error'=> FALSE , 'message'=>'favorited', 'href' =>base_url('activity/favorite'),'id'=>'wish-'.$trip_id));
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'This trip not exist in your wishlist.'));
            }
        }
        exit;
    }

    public function create_review()
    {
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $postData = $this->input->post(NULL,TRUE);
            $attributes['description'] = $postData['review'];
            $attributes['rating'] = $postData['rating'];
            $attributes['review_for'] = $postData['object_id'];
            $attributes['review_by'] = $this->session->userdata('user_id');
            $attributes['owner'] = $postData['owner'];
            $attributes['created_date'] = date('Y-m-d H:i:s');
            $review = $this->activity_model->saveData("trip_reviews",$attributes);
            if($review){
                echo json_encode(array('error'=> FALSE , 'message'=>'This review has been successfully saved'));
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'some error are exist.so please try again!'));
            }
        }
        exit;
    }

    public function likeTip(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $attribute['obj_type_id'] = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $attribute['obj_id'] = $this->input->post('objectId');
            $attribute['obj_parent_id'] = $this->input->post('obj_parent_id');
            $attribute['act_type_id'] = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['user_id'] = $this->session->userdata('user_id');
            $activity_id=$this->activity_model->is_available_activity($attribute['obj_type_id'],$attribute['obj_id'],$attribute['obj_parent_id'],$attribute['act_type_id'],$attribute['user_id']);
            if(!$activity_id){
                $created_by = $attribute['created_by'] = $attribute['obj_id'];
                $modified_by = $attribute['modified_by'] = $this->session->userdata('user_id');
                $attribute['created_date'] = date('Y-m-d H:i:s');
                $act_id = $this->activity_model->saveData("activity",$attribute);
                if($act_id > 0){
                    $userId = $this->input->post('obj_parent_id');
                    $subTypeId = $this->activity_model->get_object_type_id($this->input->post('objType')); 
                    $subId = $this->session->userdata('user_id'); 
                    $objTypeId = $attribute['obj_type_id'];
                    $objId = $attribute['obj_id'];
                    $params='';
                    $imageIds='';
                    $notificationTypeId = $this->activity_model->get_notification_type_id($this->input->post('acttype'));
                    $not_id = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                    $likeCount = $this->activity_model->getLikeCount($objId, $attribute['obj_parent_id'], $attribute['act_type_id']);
                    echo json_encode(array('error'=> FALSE , 'message'=>'Liked', "likeCount" => $likeCount));
                }		
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'AllreadyLiked'));
            }
        }
    }

    public function unlikeTip(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $obj_type_id = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $obj_id = $this->input->post('objectId');
            $obj_parent_id = $this->input->post('obj_parent_id');
            $act_type_id = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $notificationTypeId = $this->activity_model->get_notification_type_id($this->input->post('acttype'));
            $deleted = $this->activity_model->delete_activity($obj_type_id , $obj_id ,$obj_parent_id, $act_type_id , $this->session->userdata('user_id'));
            $deleted = $this->activity_model->delete("notifications", array("subject_id"=>$this->session->userdata('user_id'),"object_id" => $obj_id, "user_id" => $obj_parent_id, "notification_type_id" => $notificationTypeId));
            if($deleted == 1){
                $likeCount = $this->activity_model->getLikeCount($obj_id, $obj_parent_id, $act_type_id);
                echo json_encode(array('error'=> FALSE , 'message'=>'Unliked', "likeCount" => $likeCount));
            }		 
        }	
    }

    public function shareTip(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $attribute['obj_type_id'] = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $attribute['obj_id'] = $this->input->post('objectId');
            $attribute['obj_parent_id'] = $this->input->post('obj_parent_id');
            $attribute['act_type_id'] = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['user_id'] = $this->session->userdata('user_id');
            $activity_id=$this->activity_model->is_available_activity($attribute['obj_type_id'],$attribute['obj_id'],$attribute['obj_parent_id'],$attribute['act_type_id'],$attribute['user_id']);
            $created_by = $attribute['created_by'] = $attribute['obj_id'];
            $modified_by = $attribute['modified_by'] = $this->session->userdata('user_id');
            $attribute['created_date'] = date('Y-m-d H:i:s');
            $act_id = $this->activity_model->saveData("activity",$attribute);
            if($act_id > 0){
                $userId = $this->input->post('obj_parent_id');
                $subTypeId = $this->activity_model->get_object_type_id($this->input->post('objType')); 
                $subId = $this->session->userdata('user_id'); 
                $objTypeId = $attribute['obj_type_id'];
                $objId = $attribute['obj_id'];
                $params='';
                $imageIds='';
                $notificationTypeId = $this->activity_model->get_notification_type_id($this->input->post('acttype'));
                $not_id = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                $likeCount = $this->activity_model->getLikeCount($objId, $attribute['obj_parent_id'], $attribute['act_type_id']);
                echo json_encode(array('error'=> FALSE , 'message'=>'Liked', "likeCount" => $likeCount));
            }		
        }
    }

    public function post_comment(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $attribute['obj_type_id'] = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $attribute['obj_id'] = $this->input->post('objectId');
            $attribute['obj_parent_id'] = $this->input->post('obj_parent_id');
            $attribute['act_type_id'] = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['user_id'] = $this->session->userdata('user_id');
            $attribute['data'] = $this->input->post('comment');
            $created_by = $attribute['created_by'] = $attribute['obj_id'];
            $modified_by = $attribute['modified_by'] = $this->session->userdata('user_id');
            $attribute['created_date'] = date('Y-m-d H:i:s');
            $act_id = $this->activity_model->saveData("activity",$attribute);
            if($act_id > 0){
                $userId = $this->input->post('obj_parent_id');
                $subTypeId = $this->activity_model->get_object_type_id($this->input->post('objType')); 
                $subId = $this->session->userdata('user_id'); 
                $objTypeId = $attribute['obj_type_id'];
                $objId = $attribute['obj_id'];
                $params='';
                $imageIds='';
                $notificationTypeId = $this->activity_model->get_notification_type_id($this->input->post('acttype'));
                $not_id = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                $likeCount = $this->activity_model->getLikeCount($objId, $attribute['obj_parent_id'], $attribute['act_type_id']);
                $attribute["comments"] = $this->activity_model->getCommentById($objId, $attribute['obj_parent_id'],$attribute['act_type_id']);
                $this->common_model->initialize('activity');
                $commentCount = $this->common_model->getCount(array("obj_id" => $objId, "act_type_id" => $attribute['act_type_id']));
                $attribute["commentCount"] = $commentCount;
                $comments = $this->load->view('comment_data',$attribute, TRUE); 
                echo json_encode(array('error'=> FALSE , 'message'=>'Comment has been successfully post.', "likeCount" => $likeCount,"commentsContent" => $comments,"commentCount"=>$commentCount));
                exit;
            }
        }
    }

    public function getCommentById(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $attributes['obj_type_id'] = $obj_type_id = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $attribute['obj_id'] = $obj_id = $this->input->post('objectId');
            $attribute['obj_parent_id'] = $obj_parent_id = $this->input->post('obj_parent_id');
            $attribute['act_type_id'] = $act_type_id = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['comments'] = $this->activity_model->getCommentById($obj_id, $obj_parent_id,$act_type_id);
            $attribute['total_comments'] = count($this->activity_model->getCommentById($obj_id, $obj_parent_id,$act_type_id,'',0));
            $htmlContent = $this->load->view('wall_comments',$attribute, TRUE);
            echo json_encode(array('error'=> FALSE ,"htmlContent" => $htmlContent));
            exit;
        }
    }

    public function getMoreCommentByID($offset =""){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $obj_type_id = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $obj_id = $this->input->post('objectId');
            $obj_parent_id = $this->input->post('obj_parent_id');
            $act_type_id = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['comments'] = $this->activity_model->getCommentById($obj_id, $obj_parent_id,$act_type_id,5,$offset);
            $htmlContent = $this->load->view('loadmoreComment',$attribute, TRUE);
            echo json_encode(array('title'=> '','count'=>count($attribute['comments']), 'content'=>$htmlContent));
        }
    }

    public function remove_comment()
    {
        if(IS_AJAX && $this->session->userdata('is_login') && $this->input->post(NULL, FALSE)){
            $attribute['act_id'] = $this->input->post('act_id');
            $act_id = $this->activity_model->getActivityById("activity",$attribute);
            if(!empty($act_id)){
                $deleted = $this->activity_model->delete("activity",$attribute);
                $deleted = $this->activity_model->delete("notifications", array("subject_id"=>$this->session->userdata('user_id'),"object_id" => $act_id->obj_id, "user_id" => $act_id->obj_parent_id));
                if($deleted == 1){
                    //$commentCount = $this->activity_model->getLikeCount($act_id->obj_id, $act_id->obj_parent_id, $act_id->act_type_id);
                    $this->common_model->initialize('activity');
	                $commentCount = $this->common_model->getCount(array("obj_id" => $act_id->obj_id, "act_type_id" => $act_id->act_type_id));
	                $attribute["comments"] = $commentCount;
                    echo json_encode(array('error'=> FALSE , 'message'=>'Comment has been successfully removed', 'commentCount' => $commentCount,'obj_id'=>$act_id->obj_id));
                }
            }else{
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are found. please try again.'));
            }
        }else{
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are found. please try again.'));
        }
    }

    public function bookmarkTip(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $attribute['obj_type_id'] = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $attribute['obj_id'] = $this->input->post('objectId');
            $attribute['obj_parent_id'] = $this->input->post('obj_parent_id');
            $attribute['act_type_id'] = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['user_id'] = $this->session->userdata('user_id');
            $activity_id=$this->activity_model->is_available_activity($attribute['obj_type_id'],$attribute['obj_id'],$attribute['obj_parent_id'],$attribute['act_type_id'],$attribute['user_id']);
            if(!$activity_id){
                $created_by = $attribute['created_by'] = $attribute['obj_id'];
                $modified_by = $attribute['modified_by'] = $this->session->userdata('user_id');
                $attribute['created_date'] = date('Y-m-d H:i:s');
                $act_id = $this->activity_model->saveData("activity",$attribute);
                if($act_id > 0){
                    $userId = $this->input->post('obj_parent_id');
                    $subTypeId = $this->activity_model->get_object_type_id($this->input->post('objType')); 
                    $subId = $this->session->userdata('user_id'); 
                    $objTypeId = $attribute['obj_type_id'];
                    $objId = $attribute['obj_id'];
                    $params='';
                    $imageIds='';
                    $notificationTypeId = $this->activity_model->get_notification_type_id($this->input->post('acttype'));
                    $not_id = $this->setNotification($userId, $subTypeId, $subId, $objTypeId, $objId, $notificationTypeId, $params, $imageIds, $created_by, $modified_by);
                    echo json_encode(array('error'=> FALSE , 'message'=>'Bookmarked'));
                }		
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'AllreadyBookmarked'));
            }
        }
    }

    public function unbookmarkTip(){
        if (!$this->session->userdata('is_login')) 
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else{
            $obj_type_id = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $obj_id = $this->input->post('objectId');
            $obj_parent_id = $this->input->post('obj_parent_id');
            $act_type_id = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $notificationTypeId = $this->activity_model->get_notification_type_id($this->input->post('acttype'));
            $deleted = $this->activity_model->delete_activity($obj_type_id , $obj_id ,$obj_parent_id, $act_type_id , $this->session->userdata('user_id'));
            $deleted = $this->activity_model->delete("notifications", array("subject_id"=>$this->session->userdata('user_id'),"object_id" => $obj_id, "user_id" => $obj_parent_id, "notification_type_id" => $notificationTypeId));
            if($deleted == 1){
                echo json_encode(array('error'=> FALSE , 'message'=>'UnBookmarked'));
            }else{
                echo json_encode(array('error'=>TRUE , 'message'=>'Some error are exist. please try again.'));
            }		 
        }	
    }

    public function hide_tip()
    {
        if (!$this->session->userdata('is_login'))
        {
            echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
        }else {
            $attribute['obj_type_id'] = $this->activity_model->get_object_type_id($this->input->post('objType'));
            $attribute['obj_id'] = $this->input->post('objectId');
            $attribute['obj_parent_id'] = $this->input->post('obj_parent_id');
            $attribute['act_type_id'] = $this->activity_model->get_activity_type_id($this->input->post('acttype'));
            $attribute['user_id'] = $this->session->userdata('user_id');
            $activity_id=$this->activity_model->is_available_activity($attribute['obj_type_id'],$attribute['obj_id'],$attribute['obj_parent_id'],$attribute['act_type_id'],$attribute['user_id']);
            if(!$activity_id){
                $created_by = $attribute['created_by'] = $attribute['obj_id'];
                $modified_by = $attribute['modified_by'] = $this->session->userdata('user_id');
                $attribute['created_date'] = date('Y-m-d H:i:s');
                $act_id = $this->activity_model->saveData("activity",$attribute);
                if($act_id > 0){
                    echo json_encode(array('error'=> FALSE));
                }else{
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are found. please try again.'));
                }
            }else{
                echo json_encode(array('error'=> TRUE , 'message'=>'Allready Hide'));
            }
        }
    }
}
