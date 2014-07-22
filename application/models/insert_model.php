<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function get_assettype() {
        $this->db->select('asset_type.type, asset_type.id');
        $this->db->from('asset_type');
        $query = $this->db->get();
        $asset = array();                       
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["type"];
        }
        return $assets;
    }
}
