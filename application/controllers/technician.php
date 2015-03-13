<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Technician extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'technician');
		$this -> load -> model("technician_model");
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'technician', 'permission');
 		if($user_id['name'] != 'technician') {
			redirect('/login/error_page', 'refresh');
		} 
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		/***** how to reduce IDK sorry 
		 * This under code mean permission can edit or not
		 */
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission_edit");
		$user_id_edit = $this -> permission_model -> get_userid($user_type, 'technician', "permission_edit");
		$data["user_id_edit"] = "";
		if($user_id_edit['name'] != 'technician') {
			$data["user_id_edit"] = "none";
		} 
		//////////////////////////////////////////////////////////
		
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
