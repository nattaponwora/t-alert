<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Criticaltemp_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function showtable() {
		$this -> db -> select('asset.id, asset.store_id, store.store_name, asset.asset_barcode, asset_shortname, asset_type.type, temperature.temp, 
        				   temperature.status, temperature.time, temperature.abnormal_period');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> join('store', 'asset.store_id = store.store_id');
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

	function sorting() {
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

	function getstart() {
		$this -> db -> select('asset.id, temperature.time');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> where('temperature.status', 'WAIT');
		$this -> db -> order_by('temperature.time', 'DESC');
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[$row['id']] = $row;
		}
		return $assets;
	}

}
