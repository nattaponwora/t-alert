<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Criticaltemp_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function showtable() {
		$this -> db -> select('asset.store_id, asset.store_name, asset.asset_barcode, asset_shortname, asset_type.shortcode, asset_type.type, temperature.temp, 
        				   temperature.status, temperature.time');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> where('temperature.status', 'ALERT');
		$this -> db -> or_where('temperature.status', 'WAIT');
		$this -> db -> order_by('temperature.id', 'DESC');
		//$this->db->limit(10);
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}

	function sortingDESC() {
		$this -> db -> select('asset.id, temperature.status, temperature.time');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> where('temperature.status', 'ALERT');
		$this -> db -> or_where('temperature.status', 'WAIT');
		$this -> db -> order_by('temperature.time', 'DESC');
		$query = $this -> db -> get(); 
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[$row['id']] = $row;
		}
		return $assets;
	}

	function sortingASC() {
		$this -> db -> select('asset.id, temperature.status, temperature.time');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> where('temperature.status', 'ALERT');
		$this -> db -> or_where('temperature.status', 'WAIT');
		$this -> db -> order_by('temperature.time', 'ASC');
		$query = $this -> db -> get(); 
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[$row['id']] = $row;
		}
		return $assets;
	}

}
