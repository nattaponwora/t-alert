<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Criticaltemp extends CI_Controller {
    public function __construct(){
        parent::__construct();
		$this->session->set_userdata('session_page', 'criticaltemp');
        $this->load->model("criticaltemp_model");  
    }
    
    public function index() {
		$cookie = get_cookie('username_cookie');
		if( $cookie != null) {
        	$this->view->page_view("criticaltemp_view");
		} else {
			redirect('/login/', 'refresh');
		}  
    }
   
    public function show( $in, $type, $list) {
        $showTable["id"] = $this->criticaltemp_model->showtable();  
        $this->view->page_view("criticaltemp_view", $showTable);
    }
}