<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Reportstore extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->session->set_userdata('session_page', 'reportstore');
		$this -> load -> model("reportstore_model");
		
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
		$showTable["searchTerm"] = null;
		$showTable["store"] = $this -> reportstore_model -> get_store();
		$storename = "";
		
		for ($i=0; $i < count($showTable["store"]); $i++) {
			$storename = $storename . $showTable["store"][$i] . ",";
		}
		
		$showTable["storename"] = $storename;
		$this -> view -> page_view('reportstore_view', $showTable);
	}

	public function search() {
		$searchTerm = $this -> input -> post('search_storeasset');
		$begindate = $this -> input -> post('begindate');
		$lastdate = $this -> input -> post('lastdate');

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
		$showTable["searchTerm"] = $searchTerm;
		$this -> view -> page_view("reportstore_view", $showTable);
	}

	public function exporttopdf() {
		$searchTerm = $this -> input -> post('search_storeasset');
		$begindate = $this -> input -> post('begindate');
		$lastdate = $this -> input -> post('lastdate');
		$showTable["selection"] = $this -> reportstore_model -> get_assetlist();
		$showTable["id"] = $this -> reportstore_model -> showtable($searchTerm, $begindate, $lastdate);
		$showTable["store"] = $this -> reportstore_model -> get_store();
		
		$storename = "";
		for ($i=0; $i < count($showTable["store"]); $i++) {
			$storename = $storename . $showTable["store"][$i] . ",";
		}
		
		//$this->view->p($showTable["id"]);
		$showTable["searchTerm"] = $searchTerm;
		$showTable["begindate"] = $begindate;
		$showTable["lastdate"] = $lastdate;
		$this->reportstore_model->set_pdf($showTable);
		redirect('/reportstore/', 'refresh');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
