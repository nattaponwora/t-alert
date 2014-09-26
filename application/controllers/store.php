<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Store extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'store');
		$this -> load -> model("store_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$data["id"] = $this -> store_model -> get_store();
			$this -> view -> page_view("store_view", $data);

		} else {
			redirect('/login/', 'refresh');
		}
	}

	public function insert() {
		$data = $this -> input -> post();
		$this -> store_model -> edit_store($data);
	}

	public function addval() {
		$data = $this -> input -> post();
		// $this->view->p($data);
		// $this->load->library('form_validation');
		// $this->form_validation->set_rules('store_id_input', 'store_id_input', 'required');
		// $this->form_validation->set_rules('store_name_input', 'store_name_input', 'required');
		// $this->form_validation->set_rules('opt_team_input', 'opt_team_input', 'required');
		$this -> store_model -> add_store($data);
	}

}
