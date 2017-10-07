<?php
class User_model extends CI_Model{
	/**
     * Get account by email
     *
     * @access public
     * @param string $email
     * @return object account object
     */
    function get_by_email($email)
    {
        return $this->db->get_where("users", array('email' => $email ))->row();
    }

    /**
     * Update password reset sent datetime
     *
     * @access public
     * @param int $user_id
     * @return int password reset time
     */
    function update_reset_sent_datetime($user_id)
    {
        $resetsenton = date("Y-m-d H:i:s");
        $this->db->update("users", array('resetsenton' => $resetsenton), array('user_id' => $user_id));
        return strtotime($resetsenton);
    }

    /**
     * Get account by id
     *
     * @access public
     * @param string $user_id
     * @return object account object
     */
    function get_by_id($user_id)
    {
        return $this->db->get_where("users", array('user_id' => $user_id))->row();
    }

     /**
     * Get account by id
     *
     * @access public
     * @param string $user_id
     * @return object account object
     */
    function update_code($user_id, $code)
    {
        $code = $code;
        $this->db->update("users", array('code' => $code), array('user_id' => $user_id));
        return $code;
    }

	public function login($email, $pass)
    {
        $this->db->select('user_id,email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', $pass);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function checkpassword($OldPassword)
    {
        $this->db->from('users');
        $this ->db-> where('password', md5($OldPassword));  
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row();
        }
        else{
            return $query->num_rows();
        }
    }

    public function getUserDetail($user_id)
    {
        return $this->db->get_where('users', array('user_id' => $user_id))->row();
    }

    public function update($table, $where, $data)
    {
        $this->db->where('user_id', $where);
        if($this->db->update($table, $data) !== FALSE)
        {
            return TRUE;
        }
        return FALSE;
    }

    public function get_count($table, $where="", $value="")
    {
        $this->db->select('*');
        $this->db->from($table);
        if($where && $value){
            $this->db->where($where, $value);
        }
        $total = $this->db->count_all_results();
        return $total;
    }

    public function getMessageCount()
    {
        $this->db->distinct();
        $this->db->select('from');
        $this->db->from('message');
        $this->db->where("to", $this->session->userdata("user_id"));
        $this->db->order_by("message_id", "desc");
        $total = $this->db->count_all_results();
        return $total;
    }

    public function getUserMessage($user_id = "")
    {
        $this->db->select('message.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');
        $this->db->from('message');

        $this->db->join('users', 'message.from = users.user_id');
        $this->db->where('`message_id` IN(SELECT MAX(`message_id`) AS message_id FROM `message` WHERE `to`= '.$user_id.' GROUP BY `from` ORDER BY `message_id` DESC )',NULL,FALSE);
        $this->db->order_by("message_id", "desc");
        $query = $this->db->get();
        if ($query->num_rows()) return $query->result();
        else return array();
    }

    public function getMessageUserList($parentid, $childid)
    {
        $this->db->select('message.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');
        $this->db->from('message');
        $this->db->join('users', 'message.to = users.user_id');
        $this->db->where("to ",$parentid);
        $this->db->where("from",$childid);  
        $this->db->order_by("message_id", "desc");
        $query1 = $this->db->get();
        $array1 = $query1->result();
   

        $this->db->select('message.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');
        $this->db->from('message');
        $this->db->join('users', 'message.to = users.user_id');
        $this->db->where("from",$parentid);
        $this->db->where("to",$childid);
        $this->db->order_by("message_id", "desc");
        $query2 = $this->db->get();
        $array2 = $query2->result();
        $data = array_merge($array1,$array2); 
        /* for message sorting according to the time */
        function invenDescSort($item1,$item2)
        {
            if ($item1->message_id == $item2->message_id) return 0;
            return ($item1->message_id > $item2->message_id) ? 1 : -1;
        }
        usort($data,'invenDescSort');
        return $data;
    }

    public function get_contect_list($keyword,$user_id)
    {
        $this->db->select("users.username, users.first_name, users.last_name, users.user_id");
        $this->db->from('message');
        $this->db->join('users', 'message.from = users.user_id');
        //$this->db->where("message.to", $user_id);
        $this->db->where('`message_id` IN(SELECT MAX(`message_id`) AS message_id FROM `message` WHERE `to`= '.$user_id.' GROUP BY `from` ORDER BY `message_id` DESC )',NULL,FALSE);
        $this->db->like('users.username', trim($keyword), 'both');
        /*$this->db->or_like('users.first_name', trim($keyword), 'both');
        $this->db->or_like('users.last_name', trim($keyword), 'both');*/
        $this->db->order_by("message_id", "desc");
        $query = $this->db->get();
        // echo query(1);
        if ($query->num_rows()) return $query->result();
        else return array();
    }
	
	public function get_all_wishtips($wishtips_id = "",$count =5, $offset=0, $params = array())
	{
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

		$this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
		$this->db->from('wishtips');
		$this->db->join('users', 'wishtips.owner_id = users.user_id');
        $this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);

		if($wishtips_id){
			 $this->db->where("wishtips.wishtips_id",$wishtips_id);
		}

        if(isset($params['user_id']) && !empty($params['user_id'])){
             $this->db->where("wishtips.owner_id",$params['user_id']);
        }

        if(isset($params['location']) && !empty($params['location'])){
            $results = explode(",", $params['location']);
            if(is_array($results)){
                foreach ($results as $key => $value) {
                    if($key == 0){
                        $this->db->like('wishtips.location', trim($value), 'both'); 
                    }else{
                        $this->db->like('wishtips.location', trim($value), 'both');
                    }
                }
            }else{
                $this->db->like('wishtips.location', trim($filter_location), 'both');
            }
        }

        if(isset($params['category']) && !empty($params['category']) && $params['category'] != 'All Tips'){
            $this->db->where('wishtips.category', trim($params['category']));
        }

        if($count!=''){
            $this->db->limit($count, $offset);
        }

		$this->db->order_by("wishtips_id", "desc");
		$query = $this->db->get();

		if ($query->num_rows()) return $query->result();
		else return array();
	}

    public function get_all_wishtips_count($wishtips_id = "",$count =5, $offset=0, $params = array())
    {
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

        $this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
        $this->db->from('wishtips');
        $this->db->join('users', 'wishtips.owner_id = users.user_id');
        $this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);

        if($wishtips_id){
             $this->db->where("wishtips.wishtips_id",$wishtips_id);
        }

        if(isset($params['user_id']) && !empty($params['user_id'])){
             $this->db->where("wishtips.owner_id",$params['user_id']);
        }

        if(isset($params['location']) && !empty($params['location'])){
            $results = explode(",", $params['location']);
            if(is_array($results)){
                foreach ($results as $key => $value) {
                    if($key == 0){
                        $this->db->like('wishtips.location', trim($value), 'both'); 
                    }else{
                        $this->db->like('wishtips.location', trim($value), 'both');
                    }
                }
            }else{
                $this->db->like('wishtips.location', trim($filter_location), 'both');
            }
        }

        if(isset($params['category']) && !empty($params['category'])){
            $this->db->where('wishtips.category', trim($params['category']));
        }

        $this->db->order_by("wishtips_id", "desc");
        $query = $this->db->get();

        if ($query->num_rows()>0) return $query->num_rows();
        else return 0;
    }

    public function get_wishtips_by_id($wishtips_id = "")
    {
        $this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
        $this->db->from('wishtips');
        $this->db->join('users', 'wishtips.owner_id = users.user_id');

        if($wishtips_id){
            $this->db->where("wishtips.wishtips_id",$wishtips_id);
        }

        $this->db->order_by("wishtips_id", "desc");
        $query = $this->db->get();

        if ($query->num_rows()) return $query->result();
        else return array();
    }
	
	public function getFilterData($count ='', $offset=0, $filter_location ='', $wishtips_category = '')
	{
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

		$this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
		$this->db->from('wishtips');
		$this->db->join('users', 'wishtips.owner_id = users.user_id');
        $this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);

		if(!empty($filter_location)){
			$results = explode(",", $filter_location);
			if(is_array($results)){
				foreach ($results as $key => $value) {
					if($key == 0){
						$this->db->like('wishtips.location', trim($value), 'both'); 
					}else{
						$this->db->like('wishtips.location', trim($value), 'both');
					}
				}
			}else{
				$this->db->like('wishtips.location', trim($filter_location), 'both');
			}
		}

		if(!empty($wishtips_category) && $wishtips_category != 'All Tips'){
            $this->db->where('wishtips.category', trim($wishtips_category), 'both');
        }

        if($count!=''){
            $this->db->limit($count, $offset);
        }

		$this->db->order_by("wishtips_id", "desc");
		$query = $this->db->get();
		//echo query(1);
		if ($query->num_rows()) return $query->result();
		else return array();
	}

    public function getUserWishtipCount($user_id = "")
    {
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

        $this->db->select("*");
        $this->db->from('wishtips');
        //$this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);
        if($user_id){
            $this->db->where("owner_id",$user_id);
        }else{
            $this->db->where("owner_id",$this->session->userdata('user_id'));
        }
        
        $query = $this->db->get();
        if ($query->num_rows()) return $query->num_rows();
        else return 0;
    }

    public function getUserWishtip($count ='', $offset=0)
    {
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

         $this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
        $this->db->from('wishtips');
        $this->db->join('users', 'wishtips.owner_id = users.user_id');
        $this->db->where("wishtips.owner_id",$this->session->userdata('user_id'));
        //$this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);
        if($count!=''){
            $this->db->limit($count, $offset);
        }
        $this->db->order_by("wishtips_id", "desc");
        $query = $this->db->get();
        if ($query->num_rows()) return $query->result();
        else return array();
    }


    public function getUserBookmarkTip($count ='', $offset=0 , $act_id)
    {
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

         $this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id,o.profile_pic as owner_profile_pic");
        $this->db->from('activity');
        $this->db->join('wishtips', 'wishtips.wishtips_id = activity.obj_id');
        $this->db->join('users', 'users.user_id = activity.user_id');
        $this->db->join('users as o', 'o.user_id = wishtips.owner_id');
        $this->db->where("activity.user_id",$this->session->userdata('user_id'));
        $this->db->where('activity.act_type_id', $act_id);
        $this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);
        if($count!=''){
            $this->db->limit($count, $offset);
        }
        $this->db->order_by("wishtips_id", "desc");
        $query = $this->db->get();
        
        if ($query->num_rows()) return $query->result();
        else return array();
    }

    public function getUserBookmarkTipCount($count ='', $offset=0 , $act_id)
    {
        #Create where clause
        $this->db->select('obj_id');
        $this->db->from('activity');
        $this->db->where("act_type_id",13);
        $this->db->where("user_id",$this->session->userdata('user_id'));
        $where_clause = $this->db->get_compiled_select();

         $this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
        $this->db->from('activity');
        $this->db->join('wishtips', 'wishtips.wishtips_id = activity.obj_id');
        $this->db->join('users', 'users.user_id = activity.user_id');
        $this->db->where("activity.user_id",$this->session->userdata('user_id'));
        $this->db->where('activity.act_type_id', $act_id);
        $this->db->where("`wishtips_id` NOT IN ($where_clause)", NULL, FALSE);
        if($count!=''){
            $this->db->limit($count, $offset);
        }
        $this->db->order_by("wishtips_id", "desc");
        $query = $this->db->get();
        
        if ($query->num_rows()>0) return $query->num_rows();
        else return 0;
    }

    /*     * **********************
     *
     * deletes more than one record from table
     * 
     * @param       delete data (assoc array), where(assoc array)
     * @return      bool
     * 
     */

    public function remove_wishtips($where) {

        $this->db->where('wishtips_id',$where);
        $query = $this->db->delete('wishtips');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('object_id',$where);
            $query = $this->db->delete('notifications');
            $this->db->where('obj_id',$where);
            $query = $this->db->delete('activity');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checksubscriber($email)
    {
        $this->db->from('subscriber');
        $this ->db-> where('email',$email);  
        $query = $this->db->get();
        if($query->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function getAllNotifications($count="",$offset=0)
    {
    
         $this->db->select('notifications.* , users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id , notification_type.notification_type_id,notification_type.type,notification_type.module,notification_type.body');
        $this->db->from('notifications');
        $this->db->join('notification_type', 'notifications.notification_type_id = notification_type.notification_type_id');
        $this->db->join('users', 'notifications.user_id = users.user_id');

        $this->db->where('notifications.notification_type_id !=',2);
        if($count!=''){
            $this->db->limit($count, $offset);
        }
        
        $this->db->order_by('notifications.created_date','desc');
        $query = $this->db->get();
        if ($query->num_rows()) return $query->result();
        else return array();
    }
}
