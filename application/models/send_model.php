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

}
