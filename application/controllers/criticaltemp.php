<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Criticaltemp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("criticaltemp_model");  
    }
    
    public function index() {
		
		
        //$showTable["id"] = $this->criticaltemp_model->showtable();  
        //$this->view->page_view("criticaltemp_view", $showTable);
        $this->view->page_view("criticaltemp_view");
    }
   
    public function show( $in, $type, $list) {
        $showTable["id"] = $this->criticaltemp_model->showtable();  
        $this->view->page_view("criticaltemp_view", $showTable);
    }
}