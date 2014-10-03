<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'register');
		$this -> load -> model("register_model");
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$this -> view -> page_view("register_view");
	}

	public function regis() {
		$regis['username'] = $this -> input -> post('username');
		$regis['password'] = $this -> input -> post('password');
		$regis['repassword'] = $this -> input -> post('repassword');
		$regis['email'] = $this -> input -> post('email');
		if ($regis['username'] == '' || $regis['password'] == '' || $regis['email'] == '') {
			echo "Please fill all require.";
		} else if ($regis['repassword'] != $regis['password']) {
			echo "Your password is not match";
		} else {
			$this -> register_model -> regis($regis);
			redirect('/register/', 'refresh');
		}
	}

}
