<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insertasset extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("insertasset_model");  
    }
    
    public function index() {
    	$data["assettype"] = $this -> insertasset_model -> get_assettype();
        $this->view->page_view("insertasset_view", $data);
    }
	
	public function added() {
		$this->insertasset_model->insert_asset($insert); 
	}
}