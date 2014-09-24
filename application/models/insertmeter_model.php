<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Insertmeter_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function get_assettype() {
		$this -> db -> select('asset_type.type, asset_type.id');
		$this -> db -> from('asset_type');
		$query = $this -> db -> get();
		$assets[0] = "โปรดเลือก";
		foreach ($query->result_array() as $row) {
			$assets[$row["id"]] = $row["type"];
		}
		return $assets;
	}

	function get_store() {
		$this -> db -> select('store_id');
		$this -> db -> from('store');
		$query = $this -> db -> get();
		$assets[0] = "โปรดเลือก";
		$i = 1;
		foreach ($query->result_array() as $row) {
			$assets[$i] = $row["store_id"];
			$i++;
		}
		return $assets;
	}

	function insert_asset($meter_id, $store_id, $asset_shortname) {
		$data = array('meter_id' => $meter_id, 
					  'asset_id' => $asset_shortname, 
					 );

		$this -> db -> insert('meter', $data);
	}

	function get_storename($in) {
		$this -> db -> select('store_id, store_name');
		$this -> db -> from('store');
		$this -> db -> where('store_id', $in);
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[$row['store_id']] = $row['store_name'];
		}
		return $assets;
	}

	function get_assetlist($in) {
		$this -> db -> distinct();
		$this -> db -> select('asset_type.id, asset_type.type');
		$this -> db -> from('asset');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> where('asset.store_id', $in);
		$query = $this -> db -> get();
		$assets[0] = "โปรดเลือก";
		foreach ($query->result_array() as $row) {
			$assets[$row["id"]] = $row["type"];
		}
		return $assets;

	}

	function get_assettypelist($in, $in2) {
		$this -> db -> select('asset.id, asset.asset_shortname, asset_type.type');
		$this -> db -> from('asset');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> where('asset.store_id', $in);
		$this -> db -> where('asset_typeid', $in2);
		$query = $this -> db -> get();
		$assets[0] = "โปรดเลือก";
		foreach ($query->result_array() as $row) {
			$assets[$row["id"]] = $row["asset_shortname"];
		}

		return $assets;
	}

	function get_table() {
		$this -> db -> from('asset');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> join('meter', 'meter.asset_id = asset.id');
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}
}
