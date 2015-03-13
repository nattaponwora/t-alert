<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Reportstore extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->session->set_userdata('session_page', 'reportstore');
		$this -> load -> model("reportstore_model");
		
		$this -> load -> model("permission_model");
		$log_user = get_cookie('log_cookie');
		$user_type = $this -> permission_model -> get_usertype($log_user, "permission");
		$user_id = $this -> permission_model -> get_userid($user_type, 'reportstore', 'permission');
 		if($user_id['name'] != 'reportstore') {
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
		$showTable["searchTerm"] = null;
		$showTable['g_show'] = null;
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
		
		$showTable['get_date'] = $this -> reportstore_model -> get_date($searchTerm, $begindate, $lastdate);
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
	  	if($searchTerm != null) {
			foreach ($showTable['get_date'] as $r) {
				$timestop =  gmdate('m', strtotime($r['time']));
				$timesec = gmdate('d', strtotime($r['time']));
				
				$showTable['pot'][$r['asset_shortname']][$r['asset_shortname'] . $timestop][$timestop][$timesec] = 0;
				$showTable['pot'][$r['asset_shortname']]['countable' . $timestop][$timesec] = 0;
			}
			

			foreach ($showTable['get_date'] as $r) {	
				$timestop =  gmdate('m', strtotime($r['time']));
				$timesec = gmdate('d', strtotime($r['time']));
				if($r['temp'] != '85') {
					//$this->view->p($r);
					$showTable['pot'][$r['asset_shortname']][$r['asset_shortname'] . $timestop][$timestop][$timesec] += $r['temp'];
					$showTable['pot'][$r['asset_shortname']]['countable' . $timestop][$timesec]++;
					$showTable['g_show'][$r['asset_shortname']][$timestop][$timesec] = $showTable['pot'][$r['asset_shortname']][$r['asset_shortname'] . $timestop][$timestop][$timesec] / $showTable['pot'][$r['asset_shortname']]['countable' . $timestop][$timesec];
	 				$showTable['g_show'][$r['asset_shortname']][-1] = $r['asset_shortname'];
				}	
			}
			// $this->view->p($showTable['g_show']);
		}
		
		// $this->view->p($showTable['g_show']);
		// $timestp = $showTable['get_date'][0]['time'];
		//echo gmdate('m', strtotime($timestp));
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
