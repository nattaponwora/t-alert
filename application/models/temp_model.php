<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Temp_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function get_infomation($in, $type_id, $droptype) {
		$this -> db -> select('asset.store_id, asset.store_name, asset.asset_barcode, asset.asset_shortname, asset_type.type');
		$this -> db -> from('asset');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> where('asset.store_id', $in);
		$this -> db -> where('asset_typeid', $type_id);
		$this -> db -> where('asset.id', $droptype);
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}

	function showtable($in, $type_id, $droptype) {
		$this -> db -> select('temperature.id, temperature.temp, temperature.status, temperature.time, temperature.abnormal_period');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> where('asset.store_id', $in);
		$this -> db -> where('asset_typeid', $type_id);
		$this -> db -> where('asset.id', $droptype);
		$this -> db -> order_by('temperature.id', 'DESC');
		//$this->db->limit(10,0);
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}

	function searchasset() {
		$query = $this -> db -> query("SELECT store_id FROM asset");
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
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

	function get_assettypelistout($in, $in2) {
		$this -> db -> select('asset.id, asset.asset_shortname');
		$this -> db -> from('asset');
		$this -> db -> where('asset.asset_typeid', $in);
		$this -> db -> where('asset.id', $in2);
		$query = $this -> db -> get();
		$assets[0] = "โปรดเลือก";
		foreach ($query->result_array() as $row) {
			$assets[$row["id"]] = $row["asset_shortname"];
		}
		return $assets;
	}

	function get_newid($old_id, $old_searchterm, $search_asset, $search_assettypelists) {
		$this -> db -> select('temperature.id, temperature.temp, temperature.status, temperature.time, temperature.abnormal_period');
		$this -> db -> from('asset');
		$this -> db -> join('temperature', 'temperature.asset_id = asset.id');
		$this -> db -> join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this -> db -> where('temperature.id >', $old_id);
		$this -> db -> where('asset.store_id', $old_searchterm);
		$this -> db -> where('asset.asset_typeid', $search_asset);
		$this -> db -> where('asset_type.id', $search_assettypelists);
		$this -> db -> order_by('temperature.id', 'ASC');
		$query = $this -> db -> get();
		$assets = array();
		foreach ($query->result_array() as $row) {
			$assets[] = $row;
		}
		return $assets;
	}
}
