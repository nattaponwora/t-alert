<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Technician_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function get_technician() {
		//$this->db->select('');
		$this -> db -> from('optteam');
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}

	function edit_technician($data) {
		$this -> db -> where('id', $data['id']);
		$arrays[$data['type']] = $data['editvar']; 
		$this -> db -> update( 'optteam', $arrays);
	}

}
