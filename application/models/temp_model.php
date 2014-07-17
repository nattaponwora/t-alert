<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function showtable( $in, $type_id, $droptype) {
        $query = $this->db->query("SELECT * FROM asset
                                   JOIN temperature ON temperature.asset_id = asset.id
                                   JOIN asset_type ON asset_type.id = asset.asset_typeid
                                   WHERE (asset.store_id = '$in' AND asset_type.id = '$type_id' AND asset.id = '$droptype')
                                   ORDER BY temperature.id DESC ");
        $asset = array();                       
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

    // function selection() {
        // $query = $this->db->query("SELECT * FROM asset_type");
        // $assets[0] = "ทั้งหมด";
        // foreach ($query->result_array() as $row) {
            // $assets[$row["id"]] = $row["type"];
        // }
        // return $assets;
    // }
    
    function get_assetlist( $in){
        $query = $this->db->query("SELECT DISTINCT asset_type.id, asset_type.type FROM asset
                                   JOIN asset_type ON asset_type.id = asset.asset_typeid
                                   WHERE asset.store_id = '$in'");
        $assets[0] = "โปรดเลือก";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["type"];
        }
        return $assets;
        
    }
    
    function get_assettypelist( $in, $in2){
        $query = $this->db->query("SELECT asset.id, asset.asset_shortname, asset_type.type FROM asset
                                   JOIN asset_type ON asset_type.id = asset.asset_typeid
                                   WHERE asset.store_id = '$in' AND asset_typeid = '$in2'");
        $assets[0] = "โปรดเลือก";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["asset_shortname"];
        }
        return $assets;
    }
    
    function get_assettypelistout( $in, $in2) {
        $query = $this->db->query("SELECT asset.id, asset.asset_shortname FROM asset
                                   WHERE asset.asset_typeid = '$in' AND asset.id = '$in2'");
        $assets[0] = "โปรดเลือก";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["asset_shortname"];
        }
        return $assets;
    }
 }
