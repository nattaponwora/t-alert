<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insertasset_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function get_assettype() {
        $this->db->select('asset_type.type, asset_type.id');
        $this->db->from('asset_type');
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["type"];
        }
        return $assets;
    }
	
	function get_store() {
		$this->db->select('store_id');
		$this->db->from('store');
        $query = $this->db->get();
        $assets[0] = "โปรดเลือก";
		$i = 1;
        foreach ($query->result_array() as $row) {
            $assets[$i] = $row["store_id"];
			$i++;
        }
        return $assets;
	}
	
	function insert_asset( $in ) {
		$this->db->where('id', $in["id"]);
		$this->db->update('asset_type', $in); 
	}
}
