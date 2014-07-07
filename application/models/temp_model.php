<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function showtable( ) { 
        $result = $this->db->query('SELECT * FROM asset');
        foreach ($result->result_array() as $row) {
            $asset[] = $row;
        }
        return $asset;
    }
 }
