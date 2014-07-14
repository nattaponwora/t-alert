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
        $showTable["selection"] = $this->temp_model->selection();  
        
        $total = 1024;
$per_page = 10;
$current_page = 2;
$adjacent_links = 4;

print_r(Pagination($total, $per_page, $current_page, $adjacent_links));

        $this->view->section_view("temp_view", $showTable);
    }
   
    public function search() {
        $searchTerm = $this->input->post('search_storeasset');
        $search_asset = $this->input->post('search_assetlist');
        
        if ($searchTerm == "") {
            echo "โปรดกรอกรหัสร้านก่อนค้นหา.";
            exit();
        }
             
        $searchasset["store_id"] = $this->temp_model->searchasset();  
        $showTable["selection"] = $this->temp_model->selection();  
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
    
    function Pagination($data, $limit = null, $current = null, $adjacents = null)
{
    $result = array();

    if (isset($data, $limit) === true)
    {
        $result = range(1, ceil($data / $limit));

        if (isset($current, $adjacents) === true)
        {
            if (($adjacents = floor($adjacents / 2) * 2 + 1) >= 1)
            {
                $result = array_slice($result, max(0, min(count($result) - $adjacents, intval($current) - ceil($adjacents / 2))), $adjacents);
            }
        }
    }

    return $result;
}
}