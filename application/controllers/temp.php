<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("temp_model");  
    }
    
    public function index() {
        $showTable["id"] = 0;
        $showTable["searchTerm"] = null;
        $this->view->section_view("temp_view", $showTable);
    }
   
    public function search() {
        $searchTerm = $this->input->post('search_storeasset');
        $searchAsset = $this->input->post('search_assetlist');
        
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
        $showTable["searchTerm"] = $searchTerm;
        $this->view->section_view("temp_view", $showTable);         
    }
}