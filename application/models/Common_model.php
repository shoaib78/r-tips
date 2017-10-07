<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class  Common_model extends CI_Model {

    public $table;
    public $primary_key;

    function __construct() {
        parent::__construct();
    }

    public function initialize($table=NULL, $primary_key = NULL) {
        $this->table = $table;
        $this->primary_key = $primary_key;
    }
    
    function getCount($where = array()){
        $this->db->where($where);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    /*     * *************************
     *
     * function to check if the exists
     * 
     * @param		email (assoc array)
     * @return 		bool
     * 
     */

    public function isExists($data) {
        $select_query = $this->db->get_where($this->table, $data);
        if ($select_query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************
     * 
     * Retrieves a single record
     * 
     * @param 		primary key 
     * @return		records or false
     * 
     */

    public function getById($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return array();
    }

    /*     * **********************
     * 
     * get all (or) selected data from a table
     * 
     * @param 		fields, where(assoc array) 
     * @return		records or false
     * 
     */

    public function getRow($select = '', $wdata = '',$join = array()) {

        if ($select != '') {
            $this->db->select($select);
        }
        if(!empty($join)){
            foreach($join as $table => $joinOn){
                $this->db->join($table , $joinOn);
            }
        }
        if ($wdata != '') {
            $this->db->where($wdata);
        }
        
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getResult($select = '', $wdata = '', $limit = '', $offset = 0, $order_by = '', $order = 'ASC',$join = array()) {

        if ($select != '') {
            $this->db->select($select);
        }
        if(!empty($join)){
            foreach($join as $table => $joinOn){
                $this->db->join($table , $joinOn);
            }
        }
        if ($wdata != '') {
            $this->db->where($wdata);
        }

        if ($limit != '') {
            $this->db->limit($limit, $offset);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /*     * ********************
     *
     * inserts a record of data to the table
     * 
     * @param		data(assoc array)
     * @return 		insert id or false
     * 
     * 
     */

    public function insert($data) {
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    /*     * **********************
     *
     * updates records to the table
     * 
     * @param		updated data (assoc array), where(assoc array)
     * @return 		bool
     * 
     */

    public function update($update_data, $where) {

        $this->db->where($where);
        $query = $this->db->update($this->table, $update_data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************
     * 
     * deletes a record from a table.
     * 
     * @param		primary key
     * @return 		bool
     * 
     */

    public function deleteById($id) {
        $this->db->where($this->primary_key, $id);
        if ($this->db->delete($this->table)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function softDeleteById($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->update($this->table, array('is_deleted' => 1));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function isApproved($ids, $val) {
        if (!is_array($ids)) {
            $ids = array($ids);
        }
        $this->db->where_in($this->primary_key, $ids);
        $this->db->set('is_approved', $val);
        $query = $this->db->update($this->table);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************
     *
     * deletes more than one record from table
     * 
     * @param		delete data (assoc array), where(assoc array)
     * @return 		bool
     * 
     */

    public function deleteRow($where) {

        $this->db->where($where);
        $query = $this->db->delete($this->table);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*     * **********************
     *
     * get pagination records from table
     * 
     * @param		limit       specifies the records per page
     * @param		offset      specifies the start of the record in next page
     * @param		where       specifies the condition (if any)
     * @return 		array       list of records that satisfied the condition, total row count        
     * 
     */

    public function getPaginationRecords($select , $limit, $offset, $where, $order_by = '', $order = 'ASC', $join = array()) {
        $this->db->select($select);
        if(!empty($join)){
            foreach($join as $table => $joinOn){
                $this->db->join($table , $joinOn);
            }
        }
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        $query = $this->db->get($this->table);
        
        $ret['rows'] = $query->result();
        
        
        $this->db->where($where);
        $q = $this->db->select('COUNT(*) as count', FALSE)->from($this->table);
        if(!empty($join)){
            foreach($join as $table => $joinOn){
                $this->db->join($table , $joinOn);
            }
        }
        $tmp = $q->get()->result();
        
        $ret['num_rows'] = $tmp[0]->count;
        
        return $ret;
    }
}

//End of MY_Model.php