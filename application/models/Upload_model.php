<?php
class Upload_model extends CI_Model{
	
	public function save_photos($photo_data){
		$this->db->insert('photos', $photo_data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	
	public function get_file_by_id($photo_id){
		$this->db->select('file_name');
		$this->db->from('photos');
		$this->db->where('photo_id', $photo_id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){
			return $result->file_name;
		}else{
			return false;
		}
	}
	
	public function delete($photo_id){
		$this->db->where('photo_id', $photo_id);
		$this->db->delete('photos');
	}
}
?>