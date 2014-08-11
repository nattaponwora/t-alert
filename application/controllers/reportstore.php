<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Reportstore extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->session->set_userdata('session_page', 'reportstore');
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
		//$showTable["id"] = $this -> reportstore_model -> showtable($searchTerm, $begindate, $lastdate);
		$showTable["store"] = $this -> reportstore_model -> get_store();
		$storename = "";
			
		for ($i=0; $i < count($showTable["store"]); $i++) {
			$storename = $storename . $showTable["store"][$i] . ",";
		}
		$showTable["id"] = array(
            array('store_id' => '04770', 'store_name' => 'วิภาวดี 62', 'type' => 'Open Type', 'asset_shortname' => 'OSC 1', 'asset_barcode' => '0000000046059', 'temp' => 3),
            array('store_id' => '04770', 'store_name' => 'วิภาวดี 62', 'type' => 'Open Type', 'asset_shortname' => 'OSC 2', 'asset_barcode' => '0000000046060', 'temp' => 4),
            array('store_id' => '04770', 'store_name' => 'วิภาวดี 62', 'type' => 'Open Type', 'asset_shortname' => 'OSC 3', 'asset_barcode' => '0000000046061', 'temp' => 2),
            array('store_id' => '04770', 'store_name' => 'วิภาวดี 62', 'type' => 'ตู้ไอศกรีมวอลล์', 'asset_shortname' => 'WAL 1', 'asset_barcode' => '0000000046068', 'temp' => -20),
            array('store_id' => '04770', 'store_name' => 'วิภาวดี 62', 'type' => 'ตู้แช่ข้าวกล่อง', 'asset_shortname' => 'FFB 1', 'asset_barcode' => '0000000046072', 'temp' => -19),
        );
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
