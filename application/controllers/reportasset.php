<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Reportasset extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'reportasset');
		$this -> load -> model("reportasset_model");
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'reportasset', 'permission');
 		if($user_id['name'] != 'reportasset') {
			redirect('/login/error_page', 'refresh');
		} 
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$showTable["id"] = 0;
		$showTable["search_asset"] = null;
		$showTable["begindate"] = null;
		$showTable["lastdate"] = null;
		$showTable["selection"] = $this -> reportasset_model -> get_assetlist();
		$this -> view -> page_view('reportasset_view', $showTable);
	}

	public function search() {
		$search_asset = $this -> input -> post('search_assetlist');
		$begindate = $this -> input -> post('begindate');
		$lastdate = $this -> input -> post('lastdate');
		
		$showTable["selection"] = $this -> reportasset_model -> get_assetlist();
		$showTable["id"] = $this -> reportasset_model -> showtable($search_asset, $begindate, $lastdate);
		if ($showTable["id"] == null) {

		}

		$showTable["search_asset"] = $search_asset;
		$showTable["begindate"] = $begindate;
		$showTable["lastdate"] = $lastdate;
		$this -> view -> page_view("reportasset_view", $showTable);
	}

	public function exporttopdf() {
		$search_asset = $this -> input -> post('set_search_asset');
		$begindate = $this -> input -> post('begindate');
		$lastdate = $this -> input -> post('lastdate');

		$showTable["selection"] = $this -> reportasset_model -> get_assetlist();
		$showTable["id"] = $this -> reportasset_model -> showtable($search_asset, $begindate, $lastdate);
		$showTable["search_asset"] = $this -> reportasset_model -> get_type($search_asset);

		$showTable["begindate"] = $begindate;
		$showTable["lastdate"] = $lastdate;
		$this -> reportasset_model -> set_pdf($showTable);
		redirect('/reportasset/', 'refresh');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
