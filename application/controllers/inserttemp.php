<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inserttemp extends CI_Controller {
    public function __construct(){
        parent::__construct();
		$this->session->set_userdata('session_page', 'inserttemp');
        $this->load->model("inserttemp_model");  
    }
    
    public function index() {
    	$cookie = get_cookie('username_cookie');
		if( $cookie != null) {
			$data["id"] = $this -> inserttemp_model -> get_asset();        	
			$this->view->page_view("inserttemp_view", $data);
		} else {
			redirect('/login/', 'refresh');
		} 
    }

	public function insert() {
		$data = $this -> input -> post();
		$this -> inserttemp_model -> edit_store($data);
	}

	public function addval() {
		$data = $this -> input -> post();
		$this -> inserttemp_model -> add_store($data);
	}
}