<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Insertasset extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'insertasset');
		$this -> load -> model("insertasset_model");
		
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		$data["assettype"] = $this -> insertasset_model -> get_assettype();
		$data["store"] = $this -> insertasset_model -> get_store();
		$data["data_table"] = $this -> insertasset_model -> get_table();
		$storename = "";

		for ($i = 0; $i < count($data["store"]); $i++) {
			$storename = $storename . $data["store"][$i] . ",";
		}

		$data["storename"] = $storename;
		
		$this -> view -> page_view("insertasset_view", $data);
	}

	public function added() {
		$data["store_id"] = $this -> input -> post('search_storeid');
		$data["asset_shortname"] = $this -> input -> post('hidden_search_assetshortname_span') . " " . $this -> input -> post('search_assetshortname');
		$data["asset_barcode"] = $this -> input -> post('barcode_asset');
		$data["asset_typeid"] = $this -> input -> post('asset_typeid_d');
		$this -> insertasset_model -> insert_asset($data);

		redirect('/insertasset', 'refresh');
	}

	public function get_shortname($get_shortnameid) {
		$assettype = $this -> insertasset_model -> get_assetshortname($get_shortnameid);
		$states = '';
		if($get_shortnameid != 0) {
			foreach($assettype as $r) {
				echo "<span class='input-group-addon' id='shortname'>{$r}</span>";
				echo "<input type='hidden' name='hidden_search_assetshortname_span' value ='$r'>";
				echo "<input type='hidden' name='asset_typeid_d' value =$get_shortnameid>";
				echo "<input class='form-control' type='text' id='search_assetshortname' name='search_assetshortname' required=''>";
			}
		}
		else {
			echo "<span class='input-group-addon' id='shortname'></span>";
			echo "<input class='form-control' type='text' id='search_assetshortname' name='search_assetshortname' required=''>";
		}
	}
	
	public function get_storename($get_storenameid) {
		$storename = $this -> insertasset_model -> get_storename($get_storenameid);
		$states = '';
		if($storename != null) {
			foreach($storename as $r) {
				echo "<input class='form-control' readonly='readonly' id='search_store' name='search_store' value='$r' required=''>";
			}
		}
		else {
			echo "<input class='form-control' readonly='readonly' id='search_store' name='search_store' value='' required=''>";
		}
	}
	
	public function insert() {
		$data = $this -> input -> post();
		$this -> insertasset_model -> edit_asset($data);
	}
}
