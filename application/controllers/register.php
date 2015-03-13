<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'register');
		$this -> load -> model("register_model");
		
		///////////////////////////////////////////////////////////////////
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'register', 'permission');
 		if($user_id['name'] != 'register') {
			redirect('/login/error_page', 'refresh');
		} 

		///////////////////////////////////////////////////////////////////
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$data['user_group'] = $this -> register_model -> get_usertype();
		$this -> view -> page_view("register_view", $data);
		
	}

	public function regis() {
		$regis['username'] = $this -> input -> post('username');
		$regis['password'] = $this -> input -> post('password');
		$repassword = $this -> input -> post('repassword');
		$regis['email'] = $this -> input -> post('email');
		$user_type_regis = $this -> input -> post('search_assetlist');
		$data['user_group'] = $this -> register_model -> get_usertype_regis($user_type_regis);
		$regis['permission_group'] = $data['user_group'];
		$this -> view -> p($regis);
		if ($regis['username'] == '' || $regis['password'] == '' || $regis['email'] == '') {
			echo "Please fill all require.";
		} else if ($repassword != $regis['password']) {
			echo "Your password is not match";
		} else {
			$this -> register_model -> regis($regis);
			redirect('/register/', 'refresh');
		}
	}
}
