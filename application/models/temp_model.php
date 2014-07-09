<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function showtable( $in) {         
        $query = $this->db->query("SELECT * FROM asset 
                                   JOIN temperature
                                   ON temperature.asset_id = asset.id
                                   WHERE store_id = '$in' ORDER BY temperature.id DESC ");
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        // $this->view->p($query);
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
 }
