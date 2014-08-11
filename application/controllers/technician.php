<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Technician extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'technician');
		$this -> load -> model("technician_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$data["id"] = $this -> technician_model -> get_technician();
			$this -> view -> page_view("technician_view", $data);
		} else {
			redirect('/login/', 'refresh');
		}
	}

	public function insert() {
		$data = $this -> input -> post();
		$this -> technician_model -> edit_technician($data);
	}
}
