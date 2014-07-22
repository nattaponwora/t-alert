<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("insert_model");  
    }
    
    public function index() {
    	$data["assettype"] = $this -> insert_model -> get_assettype();
        $this->view->section_view("insert_view", $data);
    }
}