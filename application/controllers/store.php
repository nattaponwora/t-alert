<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Store extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'store');
		$this -> load -> model("store_model");
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'store', 'permission');
 		if($user_id['name'] != 'store') {
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
		$user_id_edit = $this -> permission_model -> get_userid($user_type, 'store', "permission_edit");
		$data["user_id_edit"] = "";
		if($user_id_edit['name'] != 'store') {
			$data["user_id_edit"] = "none";
		} 
		//////////////////////////////////////////////////////////
		
		
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
	
	public function remove($in) {
	 	$this -> store_model -> remove_store($in);
	 }
}
