<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
	
	public function validate(){
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
        $this->db->where('login.username', $username);
        $this->db->where('login.password', $password);
                
        // Run the query
        $query = $this->db->get('login');
		
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            return $username;
        }
		
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
	