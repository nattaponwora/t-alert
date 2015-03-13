<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Criticaltemp extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'criticaltemp');
		$this -> load -> model("criticaltemp_model");
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'criticaltemp', "permission");
 		if($user_id['name'] != 'criticaltemp') {
			redirect('/login/error_page', 'refresh');
		} 
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$showTable["id"] = $this -> criticaltemp_model -> showtable();
		$showTable["sorttime"] = $this -> criticaltemp_model -> sorting();
		
		//$this->view->p($showTable["id"]);
		$showTable['get'] = "";
		foreach($showTable["sorttime"] as $row ) {
			if($row['status'] == "WAIT" || $row['status'] == 'ALERT') {
				$showTable['get'] = "none";
			}
		}
		
		$showTable['get2'] = "none";
		foreach($showTable["sorttime"] as $row ) {
			if($row['status'] == "WAIT" || $row['status'] == 'ALERT') {
				$showTable['get2'] = "";
				break;
			}
		}
		
		//$this->view->p("GET 1: ". $showTable['get'] . "GET 2:". $showTable['get2'] );
		$this -> view -> page_view("criticaltemp_view", $showTable);
	}

	public function show() {
		$showTable["id"] = $this -> criticaltemp_model -> showtable();
		$showTable["sorttime"] = $this -> criticaltemp_model -> sorting();
			
		$showTable['get2'] = "none";
		foreach($showTable["sorttime"] as $row ) {
			if($row['status'] == "WAIT" || $row['status'] == 'ALERT') {
				$showTable['get2'] = "";
				break;
			}
		}
		
		$this -> view -> page_view("criticaltemp_view", $showTable);
	}

	public function checkd() {
		$showTable["sorttime"] = $this -> criticaltemp_model -> sorting();
		
		$showTable['get'] = "";
		foreach($showTable["sorttime"] as $row ) {
			if($row['status'] == "WAIT" || $row['status'] == 'ALERT') {
				$showTable['get'] = "none";
				break;
			}
		}
		
		$this -> view -> page_view("criticaltemp_view", $showTable);
	}
}
