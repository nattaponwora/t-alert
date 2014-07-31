<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Reportstore extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> load -> model("reportstore_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$showTable["id"] = 0;
			$showTable["search_asset"] = null;
			$showTable["begindate"] = null;
			$showTable["lastdate"] = null;
			$showTable["store"] = $this -> reportstore_model -> get_store();
			$storename = "";
			
			for ($i=0; $i < count($showTable["store"]); $i++) {
				$storename = $storename . $showTable["store"][$i] . ",";
			}
			
			$showTable["storename"] = $storename;
			$this -> view -> page_view('reportstore_view', $showTable);
		} else {
			redirect('/login/', 'refresh');
		}
	}

	public function search() {
		$searchTerm = $this -> input -> post('search_storeasset');
		$begindate = $_POST['begindate'];
		$lastdate = $_POST['lastdate'];

		$showTable["selection"] = $this -> reportstore_model -> get_assetlist();
		$showTable["id"] = $this -> reportstore_model -> showtable($searchTerm, $begindate, $lastdate);
		$showTable["store"] = $this -> reportstore_model -> get_store();
		$storename = "";
			
		for ($i=0; $i < count($showTable["store"]); $i++) {
			$storename = $storename . $showTable["store"][$i] . ",";
		}
			
		$showTable["storename"] = $storename;
		$showTable["begindate"] = $begindate;
		$showTable["lastdate"] = $lastdate;
		$this -> view -> page_view("reportstore_view", $showTable);
	}

	public function exportpdf() {

	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
