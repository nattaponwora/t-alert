<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Criticaltemp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function showtable() {
        $this->db->select('asset.store_id, asset.store_name, asset.asset_barcode, asset_shortname, asset_type.shortcode, asset_type.type, temperature.temp, 
        				   temperature.status');
        $this->db->from('asset');
        $this->db->join('temperature', 'temperature.asset_id = asset.id');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
		$this->db->where('temperature.status', 'ALERT');
        //$this->db->order_by('temperature.id', 'DESC');
		//$this->db->limit(10);
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
	}
}
