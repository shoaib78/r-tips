<?php

class Activity_model extends CI_Model{



	public function saveData($table,$data) {

		$this->db->insert($table, $data);

		if ($this->db->affected_rows() > 0) {

			return $this->db->insert_id();

		} else {

			return FALSE;

		}

	}



    public function getActivityById($table,$wdata) {

        $this->db->where($wdata);

        $query = $this->db->get($table);



        if ($query->num_rows() > 0) {

            return $query->row();

        }

        return array();

    }

	

	function get_object_type_id($object_type){

		$this->db->where('name', $object_type);

		$query = $this->db->get("object_types");

		if ($query->num_rows())	return $query->row()->obj_type_id;

	}



	function get_object_type($object_type_id){

		$this->db->where('obj_type_id', $object_type_id);

		$query = $this->db->get("object_types");

		if ($query->num_rows())	return $query->row()->name;

		else return 0;

	}

	

	function get_activity_type_id($activity_type){

		$this->db->where('activity', $activity_type);

		$query = $this->db->get('activity_type');

		if ($query->num_rows())	return $query->row()->activity_type_id;

		else return 0;

	}



	function get_activity_type($activity_id){

		$this->db->where('act_type_id', $activity_id);

		$query = $this->db->get('activity_type');

		if ($query->num_rows())	return $query->row()->activity;

		else return 0;

	}

	

	function get_notification_type_id($notification_type){

		$this->db->where('type', $notification_type);

		$query = $this->db->get('notification_type');

		if ($query->num_rows())	return $query->row()->notification_type_id;

		else return 0;

	}



	public function getActivityType($where_data){

		$this->db->select('*');

		$this->db->from("object_types as oc");

		$this->db->join('activity_type as ac', 'oc.name = ac.module');

		$this->db->where($where_data);

		$query = $this->db->get();

		$result = $query->row();

		return $result;

	}

	

	function is_available_activity($obj_type_id , $obj_id ,$obj_parent_id, $act_type_id ,$user_id){

		$this->db->where('obj_type_id', $obj_type_id);

		$this->db->where('obj_id', $obj_id);

		$this->db->where('act_type_id', $act_type_id);

		if($obj_parent_id){

			$this->db->where('obj_parent_id', $obj_parent_id);

		}

		$this->db->where('user_id', $user_id);  

		$res=$this->db->get("activity"); 

		if($res->num_rows()>0){

			return $res->row()->act_id;

		}else{

			return false;

		}

	}

	

	public function is_following($follower_id , $following_id){

		$this->db->select('*');

		$this->db->from("user_followers");

		$this->db->where('follower_id' , $follower_id);

		$this->db->where('following_id' , $following_id);

		$query = $this->db->get();

		

		if ($query->num_rows() == 1){

			return TRUE;

		}else{

			return FALSE;

		}

	}

	

	public function getFollowingById($follower_id , $following_id){

		$this->db->select('*');

		$this->db->from("user_followers");

		$this->db->where('follower_id' , $follower_id);

		$this->db->where('following_id' , $following_id);

		$query = $this->db->get();

		if ($query->num_rows())	return $query->row();

		else return 0;

	}

	

	public function get_followers($follower_id){

		$this->db->select('user_followers.*, users.user_id, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');

		$this->db->from("user_followers");

		$this->db->join('users', 'user_followers.following_id = users.user_id');

		$this->db->where('follower_id' , $follower_id);

		$query = $this->db->get();

		if ($query->num_rows())	return $query->result_array();

		else return array();

	}

	

	public function get_followings($following_id){

		$this->db->select('user_followers.*, users.user_id, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');

		$this->db->from("user_followers");

		$this->db->join('users', 'user_followers.follower_id = users.user_id');

		$this->db->where('following_id' , $following_id);

		$query = $this->db->get();

		if ($query->num_rows())	return $query->result_array();

		else return array();

	}

	

	function is_available_wishlist($trip_id , $owner_id ,$user_id){

		$this->db->where('trip_id', $trip_id);

		$this->db->where('owner_id', $owner_id);

		$this->db->where('user_id', $user_id); 

		$res=$this->db->get("trip_wishlists");

		if($res->num_rows()>0) return $res->row()->wishlist_id;

		else return false;

	}

	

	public function is_faverite($trip_id , $owner_id){

		$this->db->select('user_id');

		$this->db->from("trip_wishlists");

		$this->db->where('trip_id', $trip_id);

		$this->db->where('owner_id', $owner_id); 

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->result_array();

		else return array();

	}

	

	public function getUserWishlist($user_id , $trip_id=NULL){

		$this->db->select('*');

		$this->db->from("trip_wishlists");

		$this->db->where('user_id', $user_id);

		if($trip_id){

			$this->db->where('trip_id', $trip_id);

		}

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->result_array();

		else return array();

	}

	

	public function getWishlist($user_id){

		$this->db->select('trip.*, trip_wishlists.wishlist_id');

		$this->db->from("trip");

		$this->db->join('trip_wishlists', 'trip.trip_id = trip_wishlists.trip_id');

		$this->db->where('trip_wishlists.user_id', $user_id);

		$res=$this->db->get();

		//echo query(1);

		if($res->num_rows()>0) return $res->result_array();

		else return array();

	}



	public function getTipLikeCount($wishtips_id,$obj_parent_id,$user_id="")

	{

		$act_type_id = $this->get_activity_type_id("like_tip");

		$this->db->select('*');

		$this->db->from("activity");

		$this->db->where('obj_id', $wishtips_id);

		$this->db->where('obj_parent_id', $obj_parent_id);

		$this->db->where('act_type_id', $act_type_id);

		if($user_id){

			$this->db->where('user_id', $user_id);

			$this->db->where('modified_by', $user_id);

		}

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->num_rows();

		else return FALSE;

		

	}



	public function getTipLikePlaneCount($wishtips_id,$obj_parent_id,$user_id="")

	{

		$act_type_id = $this->get_activity_type_id("like_tip_in_plane");

		$this->db->select('*');

		$this->db->from("activity");

		$this->db->where('obj_id', $wishtips_id);

		$this->db->where('obj_parent_id', $obj_parent_id);

		$this->db->where('act_type_id', $act_type_id);

		if($user_id){

			$this->db->where('user_id', $user_id);

			$this->db->where('modified_by', $user_id);

		}

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->num_rows();

		else return FALSE;

	}



	public function getLikeCount($obj_id,$obj_parent_id,$act_type_id)

	{

		$this->db->select('*');

		$this->db->from("activity");

		$this->db->where('obj_id', $obj_id);

		$this->db->where('obj_parent_id', $obj_parent_id);

		$this->db->where('act_type_id', $act_type_id);

		$res=$this->db->get();

		return $res->num_rows();

	}

	

	public function getCommentById($obj_id,$obj_parent_id,$act_type_id,$count =5, $offset=0)

	{

		 $this->db->select('activity.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');

		$this->db->from("activity");

		$this->db->join('users', 'activity.user_id = users.user_id');

		$this->db->where('activity.obj_id', $obj_id);

		$this->db->where('activity.obj_parent_id', $obj_parent_id);

		$this->db->where('activity.act_type_id', $act_type_id);

		if($count!=''){

			$this->db->limit($count, $offset);

		}

		$this->db->order_by("activity.act_id", "desc");

		//echo query(1);

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->result();

		else return array();

	}



	public function getName($obj_id,$obj_parent_id,$act_type_id)

	{

		$this->db->select('users.first_name, users.last_name, users.username');

		$this->db->from("activity");

		$this->db->join('users', 'activity.user_id = users.user_id');

		$this->db->where('activity.obj_id', $obj_id);

		$this->db->where('activity.obj_parent_id', $obj_parent_id);

		$this->db->where('activity.act_type_id', $act_type_id);

		$this->db->order_by("activity.act_id", "desc");

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->result();

		else return array();

	}



	public function getTipLikePlaneInCount($wishtips_id,$obj_parent_id,$user_id="")

	{

		$act_type_id = $this->get_activity_type_id("like_tip_in_location");

		$this->db->select('*');

		$this->db->from("activity");

		$this->db->where('obj_id', $wishtips_id);

		$this->db->where('obj_parent_id', $obj_parent_id);

		$this->db->where('act_type_id', $act_type_id);

		if($user_id){

			$this->db->where('user_id', $user_id);

			$this->db->where('modified_by', $user_id);

		}

		$res=$this->db->get();

		if($res->num_rows()>0) return $res->num_rows();

		else return FALSE;

	}



	public function checkBookmarkExist($wishtips_id,$obj_parent_id,$user_id="")

	{

		$act_type_id = $this->get_activity_type_id("bookmark_tip");

		$this->db->select('*');

		$this->db->from("activity");

		$this->db->where('obj_id', $wishtips_id);

		$this->db->where('obj_parent_id', $obj_parent_id);

		$this->db->where('act_type_id', $act_type_id);

		if($user_id){

			$this->db->where('user_id', $user_id);

			$this->db->where('modified_by', $user_id);

		}

		$res=$this->db->get();
		if($res->num_rows()>0) return $res->num_rows();

		else return FALSE;

		

	}



    public function isExists($wdata) {

        $select_query = $this->db->get_where($table, $wdata);

        if ($select_query->num_rows() > 0) {

            return TRUE;

        } else {

            return FALSE;

        }

    }

	

	public function delete($table, $wdata) {

        $this->db->where($wdata);

        if ($this->db->delete($table)) {

            return TRUE;

        } else {

            return FALSE;

        }

    }



    function delete_activity($obj_type_id , $obj_id ,$obj_parent_id, $act_type_id ,$user_id){

		$this->db->where('obj_type_id', $obj_type_id);

		$this->db->where('obj_id', $obj_id);

		$this->db->where('act_type_id', $act_type_id);

		$this->db->where('obj_parent_id', $obj_parent_id);

		$this->db->where('user_id', $user_id);

		if ($this->db->delete("activity")) {

            return TRUE;

        } else {

            return FALSE;

        }

	}

}

?>