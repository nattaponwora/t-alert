<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function showtable( $in, $type_id) {
        $query = $this->db->query("SELECT * FROM asset
                                   JOIN temperature ON temperature.asset_id = asset.id
                                   JOIN asset_type ON asset_type.id = asset.asset_desc
                                   WHERE (asset.store_id = '$in' AND asset_type.id = '$type_id')
                                   ORDER BY temperature.id DESC ");
        $asset[] = null;                       
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

    function selection() {
        $query = $this->db->query("SELECT * FROM asset_type");
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["type"];
        }
        return $assets;
    }
 }
