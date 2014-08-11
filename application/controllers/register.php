<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'register');
		$this -> load -> model("register_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$this -> view -> page_view("register_view");
		} else {
			redirect('/login/', 'refresh');
		}
	}
	
	public function regis() {
		$regis['username'] = $this -> input -> post('username');
		$regis['password'] = $this -> input -> post('password');
		$regis['email'] = $this -> input -> post('email');
		$this -> register_model -> regis($regis);
		redirect('/register/', 'refresh');
	}

}
