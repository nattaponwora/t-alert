<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insertasset extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("insertasset_model");  
    }
    
    public function index() {
    	$cookie = get_cookie('username_cookie');
		if( $cookie != null) {
        	$data["assettype"] = $this -> insertasset_model -> get_assettype();
			$data["store"] = $this -> insertasset_model -> get_store();
        	$this->view->page_view("insertasset_view", $data);
		} else {
			redirect('/login/', 'refresh');
		}  
    }
	
	public function added() {
		$this->insertasset_model->insert_asset($insert); 
	}
}