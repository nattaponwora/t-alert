<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
    
    function get_user($username, $password) {
        $this->db->select('login.username, login.password');
        $this->db->from('login');
		$this->db->where('login.username', $username);
		$this->db->where('login.password', $password);
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
    }
}
