<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Insertasset extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'insertasset');
		$this -> load -> model("insertasset_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$data["assettype"] = $this -> insertasset_model -> get_assettype();
			$data["store"] = $this -> insertasset_model -> get_store();
			$storename = "";

			for ($i = 0; $i < count($data["store"]); $i++) {
				$storename = $storename . $data["store"][$i] . ",";
			}

			$data["storename"] = $storename;
			$this -> view -> page_view("insertasset_view", $data);
		} else {
			redirect('/login/', 'refresh');
		}
	}

	public function added() {
		$data["store_id"] = $this -> input -> post('search_storeid');
		$data["store_name"] = $this -> input -> post('search_store');
		$data["asset_shortname"] = $this -> input -> post('search_assetshortname');
		$data["asset_barcode"] = $this -> input -> post('barcode_asset');
		$this -> insertasset_model -> insert_asset($data);
	}

}
