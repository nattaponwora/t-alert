<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportasset_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     

    function showtable($type_id, $begindate, $lastdate) {
        $this->db->select('asset.store_id, asset.store_name, asset.asset_barcode, asset.asset_shortname, asset_type.type, temperature.temp, temperature.time');
        $this->db->select_avg('temperature.temp');	
        $this->db->from('asset');
        $this->db->join('temperature', 'temperature.asset_id = asset.id');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $this->db->where('asset_typeid', $type_id);
        $this->db->where('temperature.time >=', $begindate);
		$this->db->where('temperature.time <=', $lastdate);
		$this->db->group_by(array('asset.store_id', 'asset.store_name', 'asset.asset_barcode', 'asset.asset_shortname', 'asset_type.type'));
        $this->db->order_by('asset.id', 'ASC');
        //$this->db->order_by('temperature.id', 'DESC');
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
    }
    
    function searchasset() {         
        $query = $this->db->query("SELECT store_id FROM asset");
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
        return $assets;
    }
    
    function inserttemp($id, $temp) {
        $query = $this->db->insert("temperature", array('asset_id' => $id,'temp' => $temp));  
    }
    
    function get_assetlist( ) {
        $this->db->distinct();
        $this->db->select('asset_type.id, asset_type.type');
        $this->db->from('asset');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["type"];
        }
        return $assets;
        
    }
	 
    function get_assettypelist( $in, $in2){
        $this->db->select('asset.id, asset.asset_shortname, asset_type.type');
        $this->db->from('asset');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $this->db->where('asset.store_id', $in);
        $this->db->where('asset_typeid', $in2);
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["asset_shortname"];
        }

        return $assets;
    }
    
    function get_assettypelistout( $in, $in2) {
        $this->db->select('asset.id, asset.asset_shortname');
        $this->db->from('asset');
        $this->db->where('asset.asset_typeid', $in);
        $this->db->where('asset.id', $in2);
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        foreach ($query->result_array() as $row) {
            $assets[$row["id"]] = $row["asset_shortname"];
        }
        return $assets;
    }
	
	function get_store() {
		$this->db->select('store_id');
		$this->db->from('store');
        $query = $this->db->get();
        $assets[0] = "ทั้งหมด";
        $i = 1;
        foreach ($query->result_array() as $row) {
            $assets[$i] = $row["store_id"];
			$i++;
        }
        return $assets;
	}
	
	function get_type($in) {
		$this->db->select('asset_type.type');
		$this->db->from('asset_type');
		$this->db->where('asset_type.id', $in);
		$query = $this->db->get();
		$assets[] = null;
		foreach ($query->result_array() as $row) {
            $assets = $row["type"];
        }
        return $assets;
	}
	
	function set_pdf($workdata){
		$this->load->library('fpdf');
		
		extract($workdata);
	
		$font_size = 12;
		$x = 15;
		$y = 30;
		$space = 7;
		$boxh = 7;

		$pdf = new FPDF();

		//สร้างหน้าเอกสาร
		$pdf -> AddPage();
		
		$pdf->SetAutoPageBreak('true',0);
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','','cordia.php');
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','B','cordiab.php');
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','I','cordiai.php');
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','BI','cordiaz.php');
		// กำหนดฟ้อนต์ที่จะใช้  time new roman ตัวธรรมดา ขนาด 14
		
		$pdf -> SetFont('cordia', '', 14);

		$pdf->Image( base_url('public/images/logo.png'), 15, 6 , 18 , 10 );
		//$pdf->setXY( $x, $y+=($space*2)  );
		// พิมพ์ข้อความลงเอกสาร
		$pdf -> Cell(0, 5, iconv('UTF-8', 'cp874', 'รายงานของอุปกรณ์'), 0, 1, 'C');
		
		//กำหนดสีของ cell
		$pdf->SetFillColor(0, 190, 190);
		
		// กำหนดฟอนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 12
		$pdf->SetFont('cordia','BI',72);
		//ส่วนที่ 2 ข้อมูลสาขา
		$pdf->setXY( $x, $y  );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 50, $boxh , iconv('UTF-8', 'cp874', "ประเภทอุปกรณ์" ) , 'TLB', 0, 'C', true);
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 40, $boxh , iconv('UTF-8', 'cp874', $search_asset ) , 'TB', 0, 'C', true); 
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 20, $boxh , iconv('UTF-8', 'cp874', "วันที่" ), 'TB', 0, 'C', true);
		$pdf->SetFont('cordia','',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 20, $boxh , $begindate, 'TB', 0, 'C', true );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 10, $boxh , iconv('UTF-8', 'cp874', "ถึง" ), 'TB', 0, 'C', true);
		$pdf->SetFont('cordia','',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 40, $boxh , $lastdate, 'TRB', 0, 'C', true );
		
		$pdf->setXY( $x, $y+=($space*2)  );
		$pdf->Cell( 36, $boxh , iconv('UTF-8', 'cp874', "รหัสสาขา" ) , 'TLB', 0, 'C', true);
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 36, $boxh , iconv('UTF-8', 'cp874', "ชื่อสาขา" ) , 'TLB', 0, 'C', true); 
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 36, $boxh , iconv('UTF-8', 'cp874', "หมายเลขบาร์โค๊ด" ), 'TLB', 0, 'C', true);
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 36, $boxh , iconv('UTF-8', 'cp874', "อุณหภูมิเฉลี่ย" ), 'TLB', 0, 'C', true );
		$pdf->SetFont('cordia','B',$font_size);	
		$pdf->Cell( 36, $boxh , iconv('UTF-8', 'cp874', "ชื่อย่ออุปกรณ์" ), 'TLRB', 0, 'C', true);
 		
		$pdf->setXY( $x, $y+= $space  );
		$pdf->SetFont('cordia','',$font_size);
		foreach ($id as $r) {
			$pdf->Cell( 36  , $boxh , iconv('UTF-8', 'cp874', $r["store_id"]), 'LB' );
			$pdf->Cell( 36  , $boxh , iconv('UTF-8', 'cp874', $r["store_name"]), 'LB' );
			$pdf->Cell( 36  , $boxh , iconv('UTF-8', 'cp874', $r["asset_barcode"]), 'LB' );
			$avg = round($r["temp"], 2);
			$pdf->Cell( 36  , $boxh , iconv('UTF-8', 'cp874', $avg), 'LB' );
			$pdf->Cell( 36  , $boxh , iconv('UTF-8', 'cp874', $r["asset_shortname"]), 'LRB' );
			$pdf->setXY( $x, $y+= $space  );
		}
		// $pdf->setXY( $x, $y+= ($space*2)  );
		// $pdf->SetFont('cordia','B',$font_size);
		// $pdf->Cell( 180  , $boxh , iconv('UTF-8', 'cp874', "ตาราง" ) , 1, 0 , 'C', TRUE);
		// $pdf->setXY( $x, $y+= $space  );
		// $pdf->SetFont('cordia','B',$font_size);
		// $pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "อุปกรณ์" ) ,'TLB', 0, 'C' );
		// $pdf->SetFont('cordia','B',$font_size);
		// $pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "ชื่อย่ออุปกรณ์" ) ,'TLB', 0, 'C' );
		// $pdf->SetFont('cordia','B',$font_size);
		// $pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "หมายเลขบาร์โค๊ด" ) ,'TLB', 0, 'C' );
		// $pdf->SetFont('cordia','B',$font_size);
		// $pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "อุณหภูมิ" ) ,'TLRB', 0, 'C' );
		
		$pdf -> Output('assetreport.pdf', 'F');
	}

	function set_excel(){
		
	}	
}
	

