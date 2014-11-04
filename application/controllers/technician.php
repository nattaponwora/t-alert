<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Technician extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'technician');
		$this -> load -> model("technician_model");
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$data["id"] = $this -> technician_model -> get_technician();
		$this -> view -> page_view("technician_view", $data);
	}

	public function insert() {
		$data = $this -> input -> post();
		$this -> technician_model -> edit_technician($data);
	}
	
	public function addval() {		
		$data = $this -> input -> post();
		$db = $this -> technician_model -> add_technical($data);
		echo $db;
	}
	
	public function remove($in) {
	 	$this -> technician_model -> remove_technician($in);
		
	}
}
