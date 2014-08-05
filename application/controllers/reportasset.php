<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Reportasset extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->session->set_userdata('session_page', 'reportasset');
		$this -> load -> model("reportasset_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$showTable["id"] = 0;
			$showTable["search_asset"] = null;
			$showTable["begindate"] = null;
			$showTable["lastdate"] = null;
			$showTable["selection"] = $this -> reportasset_model -> get_assetlist();
			$this -> view -> page_view('reportasset_view', $showTable);
		} else {
			redirect('/login/', 'refresh');
		}
	}

	public function search() {
		$search_asset = $this -> input -> post('search_assetlist');
		$begindate = $_POST['begindate'];
		$lastdate = $_POST['lastdate'];

		$showTable["selection"] = $this -> reportasset_model -> get_assetlist();
		$showTable["id"] = $this -> reportasset_model -> showtable($search_asset, $begindate, $lastdate);
		if ($showTable["id"] == null) {

		}

		$showTable["search_asset"] = $search_asset;
		$showTable["begindate"] = $begindate;
		$showTable["lastdate"] = $lastdate;
		$this -> view -> page_view("reportasset_view", $showTable);
	}

	public function exportpdf() {

	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
