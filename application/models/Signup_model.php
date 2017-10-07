<?php
class Signup_model extends CI_Model{
	
	public function create($data){
		$this->db->insert('users', $data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
}
?>