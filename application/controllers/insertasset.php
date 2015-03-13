<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Insertasset extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> session -> set_userdata('session_page', 'insertasset');
		$this -> load -> model("insertasset_model");
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'insertasset', "permission");
		
 		if($user_id['name'] != 'insertasset') {
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
		$user_id_edit = $this -> permission_model -> get_userid($user_type, 'insertasset', "permission_edit");
		$data["user_id_edit"] = "";
		if($user_id_edit['name'] != 'insertasset') {
			$data["user_id_edit"] = "none";
		} 
		//////////////////////////////////////////////////////////
		
		echo $data["user_id_edit"];
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
		$data["adjust_value"] = $this -> input -> post('search_adjust_value');
		$this -> insertasset_model -> insert_asset($data);

		redirect('/insertasset', 'refresh');
	}

	public function get_shortname($get_shortnameid) {
		$i=1;	
		$assettype = $this -> insertasset_model -> get_assetshortname($get_shortnameid);
		$states = '';
		if(isset($get_shortnameid)) {
			foreach($assettype as $r) {
				$i=0;				
				echo "<span class='input-group-addon' id='shortname'>{$r['shortcode']}</span>";
				echo "<input type='hidden' name='hidden_search_assetshortname_span' value ='".$r['shortcode'] ."'/>";
				echo "<input type='hidden' name='asset_typeid_d' value =$get_shortnameid>";
				echo "<input class='form-control' type='text' id='search_assetshortname' name='search_assetshortname' required=''/>";
			}
		}
		if($i == 1) {
			echo "<span class='input-group-addon' id='shortname'></span>";
			echo "<input class='form-control' type='text' id='search_assetshortname' name='search_assetshortname' required=''>";		}
	}
	
	public function get_standardtemp($get_shortnameid){
		$i=1;
		$assettype = $this -> insertasset_model -> get_assetshortname($get_shortnameid);
		$states = '';
		if(isset($get_shortnameid)) {
			foreach($assettype as $r) {
				$i=0;
				echo "<span class='input-group-addon' id='std_temp'>{$r['std_temp']}</span>";
				//echo "<input type='hidden' name='hidden_search_std_temp_span' value ='".$r['std_temp'] ."' />";
				echo "<input class='form-control' type='text' id='search_adjust_value' name='search_adjust_value' required='' />";
			}
		}
		if($i == 1) {
			echo "<span class='input-group-addon' id='std_temp'></span>";
			echo "<input class='form-control' type='text' id='search_adjust_value' name='search_adjust_value' required=''>";
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
	
	public function remove($in) {
	 	$this -> insertasset_model -> remove_asset($in);
	 }
}
