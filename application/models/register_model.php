<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Register_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function regis($regis) {
		$this -> db -> insert('login', $regis);
	}

	function get_usertype() {
		$this -> db -> distinct();
		$this -> db -> select('id, group');
		$this -> db -> from('permission');
		$this -> db -> group_by('group');
		$query = $this -> db -> get();

		$assets[0] = "โปรดเลือก";
		foreach ($query->result_array() as $row) {
			$assets[$row['id']] = $row['group'];
		}
		return $assets;
	}

	function get_usertype_regis($user_type_regis) {
		$this -> db -> distinct();
		$this -> db -> select('group');
		$this -> db -> from('permission');
		$this -> db -> where('id', $user_type_regis);
		$query = $this -> db -> get();

		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets = $row['group'];
		}
		return $assets;
	}

}
