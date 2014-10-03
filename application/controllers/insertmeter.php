<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Insertmeter extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'insertmeter');
		$this -> load -> model("insertmeter_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if ($cookie != null) {
			$data["id"] = 0;
			$data["infomation"] = 0;
			$data["searchTerm"] = null;
			$data["search_asset"] = null;
			$data["search_assettypelists"] = null;
			$data["selection"] = array("โปรดเลือก");
			$data["selectiontype"] = array("โปรดเลือก");
			$data["store"] = $this -> insertmeter_model -> get_store();
			$data["data_table"] = $this -> insertmeter_model -> get_table();
			$storename = "";

			for ($i = 0; $i < count($data["store"]); $i++) {
				$storename = $storename . $data["store"][$i] . ",";
			}

			$data["storename"] = $storename;
			
			$this -> view -> page_view("insertmeter_view", $data);
		} else {
			redirect('/login/', 'refresh');
		}
	}

	public function added() {
		$meter_id = $this -> input -> post('search_meterid');
		$store_id = $this -> input -> post('search_storeasset');
		$asset_shortname = $this -> input -> post('search_assettypelist');
		$this -> insertmeter_model -> insert_asset($meter_id, $store_id, $asset_shortname);

		redirect('/insertmeter', 'refresh');
	}

	public function get_shortname($get_shortnameid) {
		$assettype = $this -> insertmeter_model -> get_assetshortname($get_shortnameid);
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
		$storename = $this -> insertmeter_model -> get_storename($get_storenameid);
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
	
	public function load_states($store_id) {
		if (isset($store_id)) {
			$assetlist = $this -> insertmeter_model -> get_assetlist($store_id);
			$states = '';
			$js = 'id="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"';
			echo form_dropdown('search_assetlist', $assetlist, 0, $js);
		}
	}

	public function load_statestype($store_id, $asset_list) {
		if (isset($store_id) && isset($asset_list)) {
			$assetlist2 = $this -> insertmeter_model -> get_assettypelist($store_id, $asset_list);
			$states = '';
			$js2 = 'id="search_assettypelist" class="btn btn-default dropdown-toggle"';
			echo form_dropdown('search_assettypelist', $assetlist2, 0, $js2);
		}
	}
	
	public function insert() {
		$data = $this -> input -> post();
		$this -> insertmeter_model -> edit_meter($data);
	}
}
