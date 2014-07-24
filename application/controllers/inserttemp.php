<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inserttemp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("inserttemp_model");  
    }
    
    public function index() {
    	$data["assettype"] = $this -> inserttemp_model -> get_assettype();
        $this->view->page_view("inserttemp_view", $data);
    }
	
	public function added() {
		$insert["id"] = $this->input->post('select_assettype');
		$insert["min_temp"] = $this->input->post('min_temp');
		$insert["max_temp"] = $this->input->post('max_temp');
		$insert["std_time"] = $this->input->post('std_time');
		
		$this->inserttemp_model->insert_asset($insert); 
	}
}