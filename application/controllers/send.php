<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("temp_model");  
    }
    
    public function index() {
        $showTable["id"] = 0;
        $showTable["searchTerm"] = null;
        $this->view->section_view("temp_view", $showTable);
    }
}