<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("temp_model");  
    }
    
    public function index() {
        $showTable["id"] = 0;
        $showTable["searchTerm"] = null;
        $showTable["search_asset"] = null;
        $showTable["selection"] = array("กรอกรหัสร้าน");  
        $this->view->section_view("temp_view", $showTable);
    }
   
    public function search() {
        $searchTerm = $this->input->post('search_storeasset');
        $search_asset = $this->input->post('search_assetlist');
        
        if ($searchTerm == "") {
            echo "โปรดกรอกรหัสร้านก่อนค้นหา.";
            exit();
        }
        
        $showTable["selection"] = $this -> temp_model -> get_assetlist($searchTerm);
        $searchasset["store_id"] = $this->temp_model->searchasset();  
        $showTable["id"] = null;
        if(count($searchasset) > 0)
        {
            foreach ($searchasset["store_id"] as $r) {
                if($r["store_id"] == $searchTerm) {
                    $showTable["id"] = $this->temp_model->showtable($searchTerm, $search_asset);
                    break;
                }
            }
        } 
        if($showTable["id"] == null) {
            echo "There was no matching record for the name " . $searchTerm;
        }
        $showTable["searchTerm"] = $searchTerm;
        $showTable["search_asset"] = $search_asset;
        $this->view->section_view("temp_view", $showTable);           
    }
    
    public function show( $in, $type) {
        $searchTerm = $in;
        $searchAsset = $in;
        $search_asset = $type;
             
        $searchasset["store_id"] = $this->temp_model->searchasset();  
        $showTable["id"] = null;
        if(count($searchasset) > 0)
        {
            foreach ($searchasset["store_id"] as $r) {
                if($r["store_id"] == $searchTerm) {
                    $showTable["id"] = $this->temp_model->showtable($searchTerm, $search_asset);
                    break;
                }
            }
        } 
        $showTable["searchTerm"] = $searchTerm;
        $this->view->section_view("temp_view", $showTable, $search_asset);   
    }
    
    public function load_states($store_id){
        if(isset($store_id))
        {
            $assetlist = $this -> temp_model -> get_assetlist($store_id);
            $states = '';
            $js = 'id="search_assetlist" class="btn btn-default dropdown-toggle"';
            echo form_dropdown('search_assetlist', $assetlist, 0, $js);
            
            //echo '<select name="state"><option disabled>Select State</option>'.$states.'</select>';
        }
    }
}