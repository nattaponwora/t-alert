<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportasset_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     

    function showtable($type_id, $begindate, $lastdate) {
        //$this->db->select('temperature.temp, temperature.time');
        $this->db->from('asset');
        $this->db->join('temperature', 'temperature.asset_id = asset.id');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $this->db->where('asset_typeid', $type_id);
        $this->db->where('temperature.time >=', $begindate);
		$this->db->where('temperature.time <=', $lastdate);
        $this->db->order_by('temperature.id', 'DESC');
		$this->db->limit(10);
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
    }
    
    function searchasset() {         
        $query = $this->db->query("SELECT store_id FROM asset");
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
    }
    
    function inserttemp($id, $temp) {
        $query = $this->db->insert("temperature", array('asset_id' => $id,'temp' => $temp));  
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
	
	
    
    function get_assettypelist( $in, $in2){
        $this->db->select('asset.id, asset.asset_shortname, asset_type.type');
        $this->db->from('asset');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $this->db->where('asset.store_id', $in);
        $this->db->where('asset_typeid', $in2);
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["asset_shortname"];
        }

        return $assets;
    }
    
    function get_assettypelistout( $in, $in2) {
        $this->db->select('asset.id, asset.asset_shortname');
        $this->db->from('asset');
        $this->db->where('asset.asset_typeid', $in);
        $this->db->where('asset.id', $in2);
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["asset_shortname"];
        }
        return $assets;
    }
	
	function get_store() {
		$this->db->select('store_id');
		$this->db->from('store');
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        $i = 1;
        foreach ($query->result_array() as $row) {
            $assets[$i] = $row["store_id"];
			$i++;
        }
        return $assets;
	}
}