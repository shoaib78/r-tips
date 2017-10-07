<?php
class Trip_model extends CI_Model{
	
	public function save_places_data($postdata)
    {
        $this->db->insert('trip', $postdata);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    public function save($data, $table_name)
    {
        $this->db->insert($table_name, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function update($table , $update_data, $where) {
        $this->db->where($where);
        $query = $this->db->update($table, $update_data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isExists($table,$data) {
        $select_query = $this->db->get_where($table, $data);
        if ($select_query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function save_trip_id_by_img($photo_id,$data)
    {
        $this->db->where('photo_id', $photo_id);
        $this->db->update('photos', $data); 
    }
    public function get_all_tags()
    {
        $this->db->distinct();
        $this->db->select('tag');
        $this->db->from('trip_tags');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_all_data($table,$fields, $is_distinct ="")
    {
        if(isset($is_distinct)){
            $this->db->distinct();
        }
        $this->db->select($fields);
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripCategories()
    {
        $this->db->select('category_id,category');
        $this->db->from('trip_categories');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_discover_favorite_detail($table)
    {
        $result = $this->db->order_by("order", "asc")->get($table)->result_array();
        return $result;
    }

    public function getPhotosByTripId($where)
    {
        $this->db->select();
        $this->db->from("photos");
        $this->db->where("trip_id",$where);
        $this->db->order_by("photo_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getSimilerTripCount($location = "", $whole_result="")
    {
        $results = explode(",", $location);
        $this->db->select("trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username");
        $this->db->from("trip");
        $this->db->join('users', 'trip.user_id = users.user_id');
        if(is_array($results)){
            foreach ($results as $key => $value) {
                if($key == 0){
                    $this->db->like('trip.location', trim($value), 'both'); 
                }else{
                    $this->db->or_like('trip.location', trim($value), 'both');
                }
            }
        }else{
            $this->db->or_like('trip.location', trim($favorite_trip->location), 'both');
        }
        $this->db->where("trip.publish",1);
        if($whole_result){
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $result = $this->db->count_all_results();
        }
        return $result;
    }

    public function getTripByParams($favorite_trip = array())
    {
        $results = explode(",", $favorite_trip->location);
        $this->db->select("trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username");
        $this->db->from("trip");
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this->db->like('trip.location', trim($favorite_trip->title), 'both');
        $this->db->or_like('trip.location', trim($favorite_trip->check_in), 'both');
        $this->db->or_like('trip.location', trim($favorite_trip->check_out), 'both');
        $this->db->where("trip.publish",1);
        if(is_array($results)){
            foreach ($results as $key => $value) {
                $this->db->or_like('trip.location', trim($value), 'both');
            }
        }else{
            $this->db->or_like('trip.location', trim($favorite_trip->location), 'both');
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripById($table, $where_data)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where($where_data);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function getUserVisitedCountry($user_id="")
    {
        $this->db->select('country, COUNT(country) AS similer_country');
        $this->db->from('trip');
        if($user_id){
            $this ->db-> where('user_id', $user_id);    
        }
        $this->db->where("trip.publish",1);
        $this->db->group_by("country");
        $this->db->having(" COUNT(country) > 0");
        $this->db->order_by("similer_country","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getUserTripById($user_id="")
    {
        $this->db->select('trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');
        $this->db->from('trip');
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this->db->where("trip.publish",1);
        if($user_id){
            $this ->db-> where('trip.user_id', $user_id);   
        }
        $this->db->order_by("trip.trip_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripReviewById($trip_id="")
    {
        $this->db->select('trip_reviews.rating, trip_reviews.description, trip_reviews.created_date,users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');
        $this->db->from('trip_reviews');
        $this->db->join('users', 'trip_reviews.review_by = users.user_id');
        $this ->db-> where('trip_reviews.review_for', $trip_id);    
        $this->db->order_by("trip_reviews.review_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripReviewByUserId($user_id="")
    {
        $this->db->select('trip.title,trip_reviews.rating, trip_reviews.description,trip_reviews.review_for as trip_id, trip_reviews.created_date,users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');
        $this->db->from('trip_reviews');
        $this->db->join('trip', 'trip_reviews.review_for = trip.trip_id');
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this ->db-> where('trip_reviews.owner', $user_id); 
        $this->db->where("trip.publish",1);
        $this->db->order_by("trip_reviews.review_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripSearchResult($location="",$category="")
    {
        $this->db->select('trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');
        $this->db->from('trip');
        $this->db->join('users', 'trip.user_id = users.user_id');
        if($location !=""){
            $results = explode(",", $location);
            if(is_array($results)){
                foreach ($results as $key => $value) {
                    if($key == 0){
                        $this->db->like('trip.location', trim($value), 'both'); 
                    }else{
                        $this->db->or_like('trip.location', trim($value), 'both');
                    }
                }
            }else{
                $this->db->or_like('trip.location', trim($favorite_trip->location), 'both');
            }
        }
        if($category !=""){
            $this ->db-> where('trip.category', $category); 
        }
        $this->db->where("trip.publish",1);
        $this->db->order_by("trip.trip_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripDetails($id = NULL)
    {
        $this->db->select("trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, trip_categories.category as category_name");
        $this->db->from("trip");
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this->db->join('trip_categories', 'trip.category = trip_categories.category_id');
        $this ->db-> where("trip_id", $id);
        $this->db->where("trip.publish",1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_all_trip_data($count ='', $offset=0)
    { 
        $this->db->select('trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');
        $this->db->from('trip');
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this->db->where("trip.publish",1);
        if($count!=''){
            $this->db->limit($count, $offset);
        }
        $this->db->order_by("trip_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getFilterData($key =NULL, $value= NULL)
    {
        $this->db->select('trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');
        $this->db->from('trip');
        if($key == "location" && $value !=""){
            $results = explode(",", $value);
            if(is_array($results)){
                foreach ($results as $key => $value) {
                    if($key == 0){
                        $this->db->like('trip.location', trim($value), 'both'); 
                    }else{
                        $this->db->or_like('trip.location', trim($value), 'both');
                    }
                }
            }else{
                $this->db->like('trip.location', trim($value), 'both');
            }
        }elseif($key == "nearby_attraction" && $value !=""){
            $results = explode(",", $value);
            if(is_array($results)){
                foreach ($results as $key => $value) {
                    if($key == 0){
                        $this->db->like('trip.nearby_attractions', trim($value), 'both'); 
                    }else{
                        $this->db->or_like('trip.nearby_attractions', trim($value), 'both');
                    }
                }
            }else{
                $this->db->like('trip.nearby_attractions', trim($value), 'both');
            }
        }elseif($key == "transportation" && !empty($value)){
            foreach ($value as $key => $val) {
                if($key == 0){
                    $this->db->like('trip.go_there', trim($val), 'both'); 
                }else{
                    $this->db->or_like('trip.go_there', trim($val), 'both');
                }
            }
        }elseif($key == "category"){
            $this->db->join('trip_categories', 'trip.category = trip_categories.category_id');
            foreach ($value as $key => $val) {
                if($key == 0){
                    $this->db->like('trip.category', trim($val)); 
                }else{
                    $this->db->or_like('trip.category', trim($val));
                }
            }

        }elseif($key == "tag"){
            if(!empty($value) && is_array($value)){
                foreach ($value as $key => $val) {
                    if($key == 0){
                        $this->db->like('trip.tags', trim($val), 'before');
                    }else{
                        $this->db->or_like('trip.tags', trim($val), 'before');
                    }
                }
            }
        }elseif($key == "min_max_budget" && !empty($value)){
            $this->db->where('trip.budget_min >=', $value['min_budget']);
            $this->db->where('trip.budget_max <=', $value['max_budget']);
        }elseif($key == "check_in_check_out" && !empty($value)){
            $this->db->where('trip.check_in_date >=', date("Y-m-d",strtotime($value['check_in'])));
            $this->db->where('trip.check_out_date <=', date("Y-m-d",strtotime($value['check_out'])));
        }
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this->db->where("trip.publish",1);
        $this->db->order_by("trip_id","desc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getTripsByParams($count ='', $offset=0,$params=array())
    { 
        $this->db->select('trip.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username');
        $this->db->from('trip');
        $this->db->join('users', 'trip.user_id = users.user_id');
        $this->db->where("trip.publish",1);
        
        if(isset($params['location']) && !empty($params['location'])){
            $results = explode(",", $params['location']);
            if(is_array($results)){
                foreach ($results as $key => $value) {
                    if($key == 0){
                        $this->db->like('trip.location', trim($value), 'before'); 
                    }else{
                        $this->db->or_like('trip.location', trim($value), 'before');
                    }
                }
            }else{
                $this->db->like('trip.location', trim($filter_location), 'before');
            }
        }

        if(isset($params['category']) && !empty($params['category'])){
            $this->db->like('trip.category', trim($params['category']), 'before');   
        }

        if($count!=''){
            $this->db->limit($count, $offset);
        }
        
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function save_currency($from='', $to='', $rate='')
    {
        $data['from'] = $from;
        $data['to'] = $to;
        $data['rates'] = (float)$rate;
        $data['created'] = date("Y-m-d H:i:s");
        $data['modified'] = date("Y-m-d H:i:s");

        if($this->isExists("currency_converter", array("from"=> $data['from'], "to"=>$data['to']))){
            $this->db->update("currency_converter", $data, array("from"=> $data['from'], "to"=>$data['to']));
            $last_id = true;
        }else{
            $this->db->insert("currency_converter", $data);
            $last_id = $this->db->insert_id();
        }

        return $last_id;
    }

    public function getResult($table="") {
        $query=$this->db->get($table);
		return $query->result_array();
    }
}
?>