<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Store extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'store');
		$this -> load -> model("store_model");
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$data["id"] = $this -> store_model -> get_store();
		$this -> view -> page_view("store_view", $data);
	}

	public function insert() {
		$data = $this -> input -> post();
		$this -> store_model -> edit_store($data);
	}

	public function addval() {
		$data = $this -> input -> post();
		$this -> store_model -> add_store($data);
	}

}
