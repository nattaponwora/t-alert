<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function get_store() {
        $this->db->from('store');
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
    }
	
	function edit_store($data) {
		$this -> db -> where('store_id', $data['id']);
		$arrays[$data['type']] = $data['editvar']; 
		$this -> db -> update( 'store', $arrays);
	}
}
