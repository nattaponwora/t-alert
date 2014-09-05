<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportstore_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }     
	
	function showtable($in, $begindate, $lastdate) {
        $this->db->select('asset.store_id, asset.store_name, asset.asset_barcode, asset.asset_shortname, asset_type.type, temperature.temp, temperature.time');
        $this->db->select_avg('temperature.temp');
        $this->db->from('asset');
        $this->db->join('temperature', 'temperature.asset_id = asset.id');
        $this->db->join('asset_type', 'asset_type.id = asset.asset_typeid');
        $this->db->where('asset.store_id', $in);
        $this->db->where('temperature.time >=', $begindate);
		$this->db->where('temperature.time <=', $lastdate);
		
		$this->db->group_by(array('asset.store_id', 'asset.store_name', 'asset.asset_barcode', 'asset.asset_shortname', 'asset_type.type'));
        $this->db->order_by('asset.id', 'ASC');
        $query = $this->db->get();
        $assets = array();                       
        foreach ($query->result_array() as $row) {
            $assets[] = $row;
        }
		//$this->view->p($assets);
        return $assets;
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
	
	
    function get_store() {
		$this->db->select('store_id');
		$this->db->from('store');
        $query = $this->db->get();
        $assets[0] = "โปรดเลือก";
		$i = 1;
        foreach ($query->result_array() as $row) {
            $assets[$i] = $row["store_id"];
			$i++;
        }
        return $assets;
	}
	
	function set_pdf($workdata){
		$this->load->library('fpdf');
		
		extract($workdata);
	
		// $map_status = array( 'COMP' => 'เรียบร้อย' );
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

		// พิมพ์ข้อความลงเอกสาร
		$pdf -> Cell(0, 5, iconv('UTF-8', 'cp874', 'Store Report'), 0, 1, 'C');
		
		//กำหนดสีของ cell
		$pdf->SetFillColor(0, 190, 190);
		// กำหนดฟอนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 12
		$pdf->SetFont('cordia','BI',72);
		//ส่วนที่ 2 ข้อมูลสาขา
		$pdf->setXY( $x, $y  );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 180  , $boxh , iconv('UTF-8', 'cp874', "ข้อมูลสาขา" ) , 1, 0 , 'C', TRUE);
		$pdf->setXY( $x, $y += $space );		
		
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "รหัสสาขา" ) ,'TLB' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 25  , $boxh , $searchTerm , 'TB' );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh, iconv('UTF-8', 'cp874', "ชื่อสาขา" ), 'TB');
		$pdf->SetFont('cordia','',$font_size);
		foreach ($id as $r) {
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', $r["store_name"]), 'B' );
			break;
		}
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 10  , $boxh , iconv('UTF-8', 'cp874', "วันที่" ), 'B' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 20  , $boxh , $begindate, 'B' );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 10  , $boxh , iconv('UTF-8', 'cp874', "ถึง" ), 'B' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 40  , $boxh , $lastdate, 'TRB' );
		
		$pdf->setXY( $x, $y+= ($space*2)  );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "อุปกรณ์" ) ,'TLB', 0, 'C', true );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "ชื่อย่ออุปกรณ์" ) ,'TLB', 0, 'C', true );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "หมายเลขบาร์โค๊ด" ) ,'TLB', 0, 'C', true );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->SetFillColor(0, 190, 190);
		$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', "อุณหภูมิ" ) ,'TLRB', 0, 'C', true );
		$pdf->setXY( $x, $y+= $space  );
		$pdf->SetFont('cordia','',$font_size);
		foreach ($id as $r) {
			$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', $r["type"]), 'LB' );
			$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', $r["asset_shortname"]), 'LB' );
			$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', $r["asset_barcode"]), 'LB' );
			$avg = round($r["temp"], 2);
			$pdf->Cell( 45  , $boxh , iconv('UTF-8', 'cp874', $avg), 'LRB' );
			$pdf->setXY( $x, $y+= $space  );
		}
		$pdf -> Output('storereport.pdf', 'F');
	}
}
