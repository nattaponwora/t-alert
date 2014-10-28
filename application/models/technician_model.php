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
	
	function add_technical($data) {
		$this->db->set('team', $data["team_input"]);
		$this->db->set('supervisor_name', $data["supervisor_name_input"]);
		$this->db->set('tel', $data["tel_input"]);
		$this->db->insert('optteam');
	}
	
	function remove_technician($data) {
		$this->db->delete('optteam', array('id' => $data)); 
	}

}
