<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function showtable( $in) {         
        $query = $this->db->query("SELECT * FROM asset 
                                   JOIN temperature
                                   ON temperature.asset_id = asset.asset_id
                                   WHERE store_id = '$in' ");
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
    
    // function searchtemp( $in) {
        // $query = $this->db->query("SELECT * FROM temperature WHERE asset_id = '$in' ");
        // foreach ($query->result_array() as $row) {
            // $assets[] = $row;
        // }
        // return $assets;
    // }
 }
