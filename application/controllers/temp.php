<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("temp_model");
    }
    
    public function index() {
        $showTable["id"] = $this->temp_model->showtable();  
        $this->load->section_view("temp_view", $showTable);
    }
}