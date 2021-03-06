<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Insertasset_model extends CI_model {

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

	function insert_asset($in) {
		$this -> db -> insert('asset', $in);
	}

	function get_assetshortname($in) {
		$this -> db -> select('id, shortcode, std_temp');
		$this -> db -> from('asset_type');
		$this -> db -> where('asset_type.id', $in);
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[$row['id']] = $row;
		}
		return $assets;
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

	function get_table() {
		$this -> db -> select('asset.id, asset.store_id, asset.asset_barcode, asset.asset_shortname, asset.adjust_value, asset_type.type, store.store_name');
		$this -> db -> from('asset');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> join('store', 'asset.store_id = store.store_id');
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}

	function edit_asset($data) {
		$this -> db -> where('asset.id', $data['id']);
		$arrays[$data['type']] = $data['editvar']; 
		$this -> db -> update( 'asset', $arrays);
	}
	
	function remove_asset($data) {
		$this->db->delete('asset', array('id' => $data)); 
	}
}
