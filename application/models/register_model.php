<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function regis( $regis ) {
        $this->db->insert('login', $regis); 
	}
}
