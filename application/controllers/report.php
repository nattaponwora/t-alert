<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this -> load -> model("report_model");
	}

	public function index() {
		$cookie = get_cookie('username_cookie');
		if( $cookie != null) {
	        $showTable["id"] = 0;
	        $showTable["infomation"] = 0;
	        $showTable["searchTerm"] = null;
	        $showTable["search_asset"] = null;	
	        $showTable["search_assettypelists"] = null;
	        $showTable["selection"] = array("โปรดเลือก");  
	        $showTable["selectiontype"] = array("โปรดเลือก");  
	
	        $this -> view -> page_view('report_view', $showTable);
		} else {
			redirect('/login/', 'refresh');
		}
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
        
        $showTable["selection"] = $this -> report_model -> get_assetlist($searchTerm);
        $showTable["selectiontype"] = $this -> report_model -> get_assettypelist($searchTerm, $search_asset);
                        
        //$searchasset["store_id"] = $this->temp_model->searchasset();   //ไม่ได้ใช้
        $showTable["id"] = $this->report_model->showtable($searchTerm, $search_asset, $search_assettypelists);
        $showTable["infomation"] = $this->report_model->get_infomation($searchTerm, $search_asset, $search_assettypelists);
        //$showTable[""]
        if($showTable["id"] == null) {
          
        }
        $showTable["searchTerm"] = $searchTerm;
        $showTable["search_asset"] = $search_asset;
        $showTable["search_assettypelists"] = $search_assettypelists;
        $this->view->page_view("report_view", $showTable);           
    }

    public function load_states($store_id){
        if(isset($store_id))
        {
            $assetlist = $this -> report_model -> get_assetlist($store_id);
            $states = '';
            $js = 'id="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"';
            echo form_dropdown('search_assetlist', $assetlist, 0, $js);
        }
    }
    
    public function load_statestype($store_id, $asset_list){
        if(isset($store_id) && isset($asset_list))
        {
            $assetlist2 = $this -> report_model -> get_assettypelist($store_id, $asset_list);
            $states = '';
            $js2 = 'id="search_assettypelist" class="btn btn-default dropdown-toggle"';
            echo form_dropdown('search_assettypelist', $assetlist2, 0, $js2);
        }
    }
	
	public function exportpdf() {
		
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
