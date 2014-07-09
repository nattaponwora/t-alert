<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("temp_model");  
    }
    
    public function index() {
        session_start();
        $showTable["id"] = 0;
        $this->view->section_view("temp_view", $showTable);
    }
   
    public function search() {
        $searchTerm = $this->input->post('search_storeasset');
        if ($searchTerm == "") {
            echo "Enter name you are searching for.";
            exit();
        }
        
        $searchasset["store_id"] = $this->temp_model->searchasset();  
        $showTable["id"] = null;
        if(count($searchasset) > 0)
        {
            foreach ($searchasset["store_id"] as $r) {
                if($r["store_id"] == $searchTerm) {
                    $showTable["id"] = $this->temp_model->showtable($searchTerm);
                    break;
                }
            }
        } 
        if($showTable["id"] == null) {
            echo "There was no matching record for the name " . $searchTerm;
        }
        
        $this->view->section_view("temp_view", $showTable);          
    }
}