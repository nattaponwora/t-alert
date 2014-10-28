<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Inserttemp_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function get_asset() {
		$this -> db -> from('asset_type');
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}

	function edit_store($data) {
		$this -> db -> where('asset_type.id', $data['id']);
		$arrays[$data['type']] = $data['editvar']; 
		$this -> db -> update( 'asset_type', $arrays);
	}

	function add_store($data) {
		
		$this -> db -> set('type', $data["type_input"]);
		$this -> db -> set('shortcode', $data["shortcode_input"]);
		$this -> db -> set('min_temp', $data["min_temp_input"]);
		$this -> db -> set('max_temp', $data["max_temp_input"]);
		$this -> db -> set('std_time', $data["std_time_input"]);
		$this -> db -> insert('asset_type');
	}
	
	function remove_assettype($data) {
		$this->db->delete('asset_type', array('id' => $data)); 
	}
}
