<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Config extends CI_Controller {
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
		$this -> session -> set_userdata('session_page', 'config');
		$this -> load -> model("config_model");
				
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'config', "permission");
 		if($user_id['name'] != 'config') {
			redirect('/login/error_page', 'refresh');
		} 

		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	/* * */
	public function index() {
		$datavar = $this -> config_model -> check_sms();
		
		$data['check_all'] = 1;
		foreach($datavar as $row) {
			if($row['get_sms'] == 0) {
				$data['check_all'] = 0;
				break;
			}
		}
		
		$data['credit_remain'] = $this -> get_credit();
		$this -> view -> page_view('config_view', $data);
	}

	/* ** */
	public function sms($bool_sms) {
		$data['get_sms'] = $bool_sms;
		//$data['id'] = $sms_all;
		$this -> config_model -> change_sms($data);
	}

	private function get_credit() {
		$url = "http://www.thaibulksms.com/sms_api.php";
		$username = "0830971773";
		$password = "753278";
		
		$data_string = "username=$username&password=$password&tag=credit_remain";

		$agent = $_SERVER['HTTP_USER_AGENT'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		return $result = curl_exec($ch);
		
	}
}

/* End of file config.php */
/* Location: ./application/controllers/cnfig.php */
