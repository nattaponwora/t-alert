<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this -> load -> model("login_model");
	}

	public function index() {
		$this -> view -> section_view('login_view');
	}

	public function check() {
		$username = $this -> input -> get('username');
		$password = $this -> input -> get('password');

		$data["id"] = $this -> login_model -> get_user($username, $password);

		if ($data["id"] != null) {
			$cookie = array('name' => 'username_cookie', 
							'value' => 'username', 
							'expire' => '86500',
							'path'   => '/',
			);

			$this -> input -> set_cookie($cookie);
			//$this->input->cookie('username_cookie', TRUE);
			redirect('/temp/', 'refresh');
		} else {
			delete_cookie("username_cookie");
			redirect('/login/', 'refresh');
		}
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
