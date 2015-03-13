<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Config_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	/* * */
	function check_sms() {
		$this -> db -> select('meter.get_sms');
		$this -> db -> from('meter');
		$query = $this -> db -> get();
		$assets = Array();
		$i = 0;
		foreach ($query->result_array() as $row) {
			$assets[$i] = $row;
			$i++;
		}
		return $assets;
	}
	
	/* * */
	function change_sms($data) {
		if($data['get_sms'] == 1){ $data['get_sms'] = 1; }
		else if($data['get_sms'] == 0){ $data['get_sms'] = 0; }
		
		$this -> db -> set('m.get_sms', $data['get_sms']);
		//$this -> db -> where('m.meter_id', $data['id']);
		$this -> db -> update('meter as m');
	}

}
