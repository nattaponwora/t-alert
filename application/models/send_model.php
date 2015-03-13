<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     

    function get_asset_type( $asset_id ){
        $this -> db -> select('asset_type.*');
        $this -> db -> from('asset');
        $this -> db -> join('asset_type', 'asset.asset_typeid = asset_type.id');
        $this -> db -> where('asset.id', $asset_id);
        $result = $this -> db -> get();
        
        foreach( $result->result_array() as $row ){
           	return $row;
        }
    }
    
    function get_history($id) {
        $this -> db -> where('asset_id', $id);
        $this -> db -> order_by( "time", "desc" );
        $result = $this -> db -> get ('temperature');
        foreach( $result->result_array() as $row ){
            return $row;
        }
    }
    	
    function get_assetid_from_meter( $meter_id ){
        $this -> db -> where( 'meter_id', $meter_id );
        $rs = $this -> db -> get('meter');
        foreach ($rs -> result_array() as $row) {
            return $row['asset_id'];
        }
    }
    
    function inserttemp($data) {
        
        $query = $this->db->insert("temperature", $data );  
    }
	
	function get_asset_data($asset_id){
		
		$this->db->select('asset.asset_shortname, store.store_name, optteam.tel');
		$this->db->from('asset');
		$this->db->join('store', 'asset.store_id = store.store_id');
		$this->db->join('optteam', 'store.opt_team = optteam.team');
		$this->db->where('asset.id', $asset_id);
		$rs= $this->db->get();
		echo $this->db->last_query();
		foreach ($rs->result_array() as $row) {
			return $row;
		}
	}

	function permiss($data) {
		$this->db->select('meter.get_sms');
		$this->db->from('meter');
		$this->db->where('meter.meter_id', $data);
		$rs= $this->db->get();
		foreach ($rs->result_array() as $row) {
			return $row;
		}
	}
	
	function get_adjust_value($data) {
		$this->db->select('asset.adjust_value');
		$this->db->from('asset');
		$this->db->where('asset.id', $data);
		$rs= $this->db->get();
		foreach ($rs->result_array() as $row) {
			return $row['adjust_value']	;
		}
	}
	
	function get_sending() {
		
	}
}


