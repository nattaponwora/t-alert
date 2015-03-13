<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inserttemp extends CI_Controller {
    public function __construct(){
        parent::__construct();
		$this->session->set_userdata('session_page', 'inserttemp');
        $this->load->model("inserttemp_model");  
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'inserttemp', 'permission');
 		if($user_id['name'] != 'inserttemp') {
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
		$user_id_edit = $this -> permission_model -> get_userid($user_type, 'inserttemp', "permission_edit");
		$data["user_id_edit"] = "";
		if($user_id_edit['name'] != 'inserttemp') {
			$data["user_id_edit"] = "none";
		} 
		//////////////////////////////////////////////////////////
		$data["id"] = $this -> inserttemp_model -> get_asset();        	
		$this->view->page_view("inserttemp_view", $data);
    }

	public function insert() {
		$data = $this -> input -> post();
		$this -> inserttemp_model -> edit_store($data);
	}

	public function addval() {
		$data = $this -> input -> post();
		$this -> inserttemp_model -> add_store($data);
	}
	
	public function remove($in) {
	 	$this -> inserttemp_model -> remove_assettype($in);
	}
}