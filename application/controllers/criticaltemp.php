<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Criticaltemp extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("temp_model");  
    }
    
    public function index() {
        $showTable["id"] = 0;
        $showTable["infomation"] = 0;
        $showTable["searchTerm"] = null;
        $showTable["search_asset"] = null;
        $showTable["search_assettypelists"] = null;
        $showTable["selection"] = array("โปรดเลือก");  
        $showTable["selectiontype"] = array("โปรดเลือก");  

        $this->view->page_view("temp_view", $showTable);
    }
   
    public function search() {
        $searchTerm = $this->input->post('search_storeasset');
        $search_asset = $this->input->post('search_assetlist');
        $search_assettypelists = $this->input->post('search_assettypelist');
        if ($searchTerm == "") {
            echo "โปรดกรอกรหัสร้านก่อนค้นหา.";
            exit();
        }
        
        if ($search_assettypelists == "") {
            echo "โปรดเลือกประเภทอุปกรณ์ก่อนค้นหา.";
            exit();
        }
        
        $showTable["selection"] = $this -> temp_model -> get_assetlist($searchTerm);
        $showTable["selectiontype"] = $this -> temp_model -> get_assettypelist($searchTerm, $search_asset);
                        
        //$searchasset["store_id"] = $this->temp_model->searchasset();   //ไม่ได้ใช้
        $showTable["id"] = $this->temp_model->showtable($searchTerm, $search_asset, $search_assettypelists);
        $showTable["infomation"] = $this->temp_model->get_infomation($searchTerm, $search_asset, $search_assettypelists);
        //$showTable[""]
        if($showTable["id"] == null) {
          
        }
        $showTable["searchTerm"] = $searchTerm;
        $showTable["search_asset"] = $search_asset;
        $showTable["search_assettypelists"] = $search_assettypelists;
        $this->view->page_view("temp_view", $showTable);           
    }
    
    public function show( $in, $type, $list) {
        $searchTerm = $in;
        $searchAsset = $in;
        $search_asset = $type;
        $search_assettypelists = $list;
        $searchasset["store_id"] = $this->temp_model->searchasset();  
        $showTable["id"] = null;
        if(count($searchasset) > 0)
        {
            foreach ($searchasset["store_id"] as $r) {
                if($r["store_id"] == $searchTerm) {
                    $showTable["id"] = $this->temp_model->showtable($searchTerm, $search_asset, $search_assettypelists);
                    break;
                }
            }
        } 
        $showTable["searchTerm"] = $searchTerm;
        $this->view->page_view("temp_view", $showTable, $search_asset, $search_assettypelists);   
    }
    
    public function load_states($store_id){
        if(isset($store_id))
        {
            $assetlist = $this -> temp_model -> get_assetlist($store_id);
            $states = '';
            $js = 'id="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"';
            echo form_dropdown('search_assetlist', $assetlist, 0, $js);
        }
    }
    
    public function load_statestype($store_id, $asset_list){
        if(isset($store_id) && isset($asset_list))
        {
            $assetlist2 = $this -> temp_model -> get_assettypelist($store_id, $asset_list);
            $states = '';
            $js2 = 'id="search_assettypelist" class="btn btn-default dropdown-toggle"';
            echo form_dropdown('search_assettypelist', $assetlist2, 0, $js2);
        }
    }
}