<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportstore_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
	
	function showtable($in, $begindate, $lastdate) {
        $this->db->select('asset.store_id, asset.store_name, asset.asset_barcode, asset.asset_shortname, asset_type.type, temperature.temp, temperature.time');
        $this->db->select_avg('temperature.temp');
        $this->db->from('asset');
        $this->db->join('temperature', 'temperature.asset_id = asset.id');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $this->db->where('asset.store_id', $in);
        $this->db->where('temperature.time >=', $begindate);
		$this->db->where('temperature.time <=', $lastdate);
		
		$this->db->group_by(array('asset.store_id', 'asset.store_name', 'asset.asset_barcode', 'asset.asset_shortname', 'asset_type.type'));
        $this->db->order_by('asset.id', 'ASC');
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
		//$this->view->p($assets);
        return $assets;
    }	
    
    function get_assetlist( ) {
        $this->db->distinct();
        $this->db->select('asset_type.id, asset_type.type');
        $this->db->from('asset');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
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
	
}
