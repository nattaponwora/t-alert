<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Temp extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'temp');
		$this -> load -> model("temp_model");
		
		$this -> session -> sess_destroy();
		$cookie = get_cookie('username_cookie');
		if ($cookie == null) {
			redirect('/login/', 'refresh');
		}
	}

	public function index() {
		
			
		$showTable["id"] = 0;
		$showTable["infomation"] = 0;
		$showTable["searchTerm"] = null;
		$showTable["search_asset"] = null;
		$showTable["search_assettypelists"] = null;
		$showTable["selectpage"] = 1;
		$showTable["selection"] = array("โปรดเลือก");
		$showTable["selectiontype"] = array("โปรดเลือก");

		$this -> view -> page_view("temp_view", $showTable);
	}

	public function search() {
		$searchTerm = $this -> input -> post('search_storeasset');
		$search_asset = $this -> input -> post('search_assetlist');
		$search_assettypelists = $this -> input -> post('search_assettypelist');
		$showTable["selectpage"] = 1;

		//dropdown
		$showTable["selection"] = $this -> temp_model -> get_assetlist($searchTerm);
		$showTable["selectiontype"] = $this -> temp_model -> get_assettypelist($searchTerm, $search_asset);

		$showTable["id"] = $this -> temp_model -> showtable($searchTerm, $search_asset, $search_assettypelists);
		$showTable["infomation"] = $this -> temp_model -> get_infomation($searchTerm, $search_asset, $search_assettypelists);

		$current_tempview = array('searchTerm' => $searchTerm, 'search_asset' => $search_asset, 'search_assettypelists' => $search_assettypelists, 'id' => $showTable["id"][0]["id"]);
		$this -> session -> set_userdata("current_tempview", $current_tempview);

		$showTable["searchTerm"] = $searchTerm;
		$showTable["search_asset"] = $search_asset;
		$showTable["search_assettypelists"] = $search_assettypelists;
		$this -> view -> page_view("temp_view", $showTable);
	}

	public function show() {
		$current_tempview = $this -> session -> userdata("current_tempview");
		$old_id = $current_tempview["id"];
		$old_searchterm = $current_tempview["searchTerm"];
		$search_asset = $current_tempview["search_asset"];
		$search_assettypelists = $current_tempview["search_assettypelists"];
		$new_id = $this -> temp_model -> get_newid($old_id, $old_searchterm, $search_asset, $search_assettypelists);

		if (sizeof($new_id) > 0) {
			$current_tempview["id"] = $new_id[sizeof($new_id) - 1]['id'];
			$this -> session -> set_userdata("current_tempview", $current_tempview);
		}

		echo json_encode($new_id);

	}

	public function old_show($in, $type, $list) {
		$searchTerm = $in;
		$searchAsset = $in;
		$search_asset = $type;
		$search_assettypelists = $list;

		$searchasset["store_id"] = $this -> temp_model -> searchasset();
		$showTable["id"] = null;
		if (count($searchasset) > 0) {
			foreach ($searchasset["store_id"] as $r) {
				if ($r["store_id"] == $searchTerm) {
					$showTable["id"] = $this -> temp_model -> showtable($searchTerm, $search_asset, $search_assettypelists);
					break;
				}
			}
		}

		$showTable["searchTerm"] = $searchTerm;
		$showTable["search_assettypelists"] = $search_assettypelists;
		$showTable["search_asset"] = $search_asset;
		$this -> view -> page_view("temp_view", $showTable);
	}

	public function load_states($store_id) {
		if (isset($store_id)) {
			$assetlist = $this -> temp_model -> get_assetlist($store_id);
			$states = '';
			$js = 'id="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"';
			echo form_dropdown('search_assetlist', $assetlist, 0, $js);
		}
	}

	public function load_statestype($store_id, $asset_list) {
		if (isset($store_id) && isset($asset_list)) {
			$assetlist2 = $this -> temp_model -> get_assettypelist($store_id, $asset_list);
			$states = '';
			$js2 = 'id="search_assettypelist" class="btn btn-default dropdown-toggle"';
			echo form_dropdown('search_assettypelist', $assetlist2, 0, $js2);
		}
	}

	public function sendpage($getpage) {
		$showTable["selectpage"] = $getpage;
		$this -> view -> page_view("temp_view", $showTable);
	}

}
