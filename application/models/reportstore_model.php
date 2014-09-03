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
	
		$map_status = array( 'COMP' => 'เรียบร้อย' );
		$font_size = 12;
		$x = 15;
		$y = 30;
		$space = 7;
		$boxh = 7;
		 
		$param = array('','','','','','','380','25','60','280','','','60','23');
		 //make pdf class
		$pdf=new FPDF();
		$pdf->SetAutoPageBreak('true',0);
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวธรรมดา กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','','cordia.php');
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','B','cordiab.php');
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','I','cordiai.php');
		 
		// เพิ่มฟอนต์ภาษาไทยเข้ามา ตัวหนา  กำหนด ชื่อ เป็น cordia
		$pdf->AddFont('cordia','BI','cordiaz.php');
		
		//สร้างหน้าเอกสาร
		$pdf->AddPage();
		//กำหนดสีของ cell
		$pdf->SetFillColor(169, 255, 176);
		// กำหนดฟอนต์ที่จะใช้  อังสนา ตัวธรรมดา ขนาด 12
		$pdf->SetFont('cordia','BI',24);
		// สว่นที่ 1 header ของ report
		$pdf->setXY( $x, 15  );
		$pdf->MultiCell( 0  , 0 , iconv('UTF-8', 'cp874', "รายงานการทำงาน" ) );
		$pdf->Image( base_url('public/image/pdf_cpr_logo.png'), 115, 6 , 28 , 20 );
		$pdf->Image( base_url('public/image/pdf_kbank_logo.png'), 150, 10 );
		//ส่วนที่ 2 ข้อมูลสาขา
		$pdf->setXY( $x, $y  );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 180  , $boxh , iconv('UTF-8', 'cp874', "ข้อมูลสาขา" ) , 1, 0 , 'C', TRUE);
		
		$pdf->setXY( $x, $y += $space );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "รหัสสาขา" ) ,'TL' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 25  , $boxh , $parent['LOCATION'] , 'T' );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh, iconv('UTF-8', 'cp874', "ชื่อสาขา" ), 'T');
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 105  , $boxh , $parent['DESCRIPTION'], 'TR' );
		
		$pdf->setXY( $x, $y += $space );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "เขตช่าง" ), 'L' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 25  , $boxh , $parent["GP_OPTSITE"] );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "ทีมช่าง" ) );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 105  , $boxh , $parent["PERSONGROUP"], 'R' );
		
		$pdf->setXY( $x, $y += $space );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "ที่อยู่" ) , 'L' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 155  , $boxh , $parent["PLUSPSTREETADDRESS"] , 'R' );
		
		$pdf->setXY( $x, $y += $space );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "เริ่มบริการ" ), 'LB' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 50  , $boxh , iconv('UTF-8', 'cp874', "13-03-2557 17.57.29 น." ), 'B' );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "เสร็จงาน" ), 'B' );
		$pdf->SetFont('cordia','',$font_size);
		$pdf->Cell( 80  , $boxh , iconv('UTF-8', 'cp874', "13-03-2557 18.06.40 น." ) , 'RB' );
		
		$pdf->setXY( $x, $y += $space );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "ช่างผู้ให้บริการ" ), 'TL' );
		
		$pdf->SetFont('cordia','',$font_size);
		/**    debug    **/
		//unset($tech[2]);unset($tech[3]);
		/**    END      **/
		$num_tech = sizeof($tech);
		
		foreach ($tech as $num => $man) {
			if( $num % 2 == 0 && $num != 0 ){
				$pdf->setXY( $x, $y += $space );
				$pdf->Cell( 25  , $boxh , '' , 'L' );
			}
			if( $num < 2 ){
				$top_border = "T";
			}else{
				$top_border = "";
			}
			
			$pdf->Cell( 15  , $boxh , ($num + 1)."." , $top_border);
			$pdf->Cell( 25  , $boxh , $man['id'], $top_border );
			$pdf->Cell( 35  , $boxh , $man['name'], $top_border );
			if( $num % 2 == 1 ){
				$pdf->Cell( 5  , $boxh , '', $top_border.'R' );
			}
			if( $num + 1 == $num_tech && $num_tech % 2 == 1 ){
				$pdf->Cell( 80  , $boxh , '', $top_border.'R' );
			}
		}
		
		$work_num = 1;
		foreach ($child as $wonum => $work) {
			if( ( ( sizeof($work['ACTIVITY']) + 5 ) * $space ) + $y > ( 35 * $space) + 30 ){
				$pdf->AddPage();
				$y = $space;
			}
				
			$pdf->setXY( $x, $y += $space );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 180  , $boxh , iconv('UTF-8', 'cp874', "ข้อมูลอุปกรณ์ - " ) . $work['GP_ASSET_SHORT_NAME'] . " - " . $work['DESCRIPTION'] , 1, 0 , 'C', TRUE);
			$pdf->setXY( $x, $y += $space );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "ยี่ห้อเครื่อง" ), 'L' );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 35  , $boxh , $work['GP_BRAND'] );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "บริเวณที่ติดตั้ง" ) );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 95  , $boxh , $work['DESCRIPTION'], 'R' );
			
			$pdf->setXY( $x, $y += $space );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 15  , $boxh , iconv('UTF-8', 'cp874', "ชื่อย่อ" ), 'L' );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 20  , $boxh , $work['GP_ASSET_SHORT_NAME'] );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 15  , $boxh , iconv('UTF-8', 'cp874', "ขนาด" ) );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 20  , $boxh , $work['ACTIVITY'][0]['VAL'] );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 20  , $boxh , 'BTU' );
			$pdf->Cell( 20  , $boxh , iconv('UTF-8', 'cp874', "ประเภท" ) );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 70  , $boxh , $work['GP_PRODUCT_TYPE'] , 'R' );
			
			
			$pdf->setXY( $x, $y += $space );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "คอยล์เย็นรุ่น" ), 'LB' );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 35  , $boxh , $work['GP_MANUF_MODEL_NUM'] , 'B' );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "หมายเลขเครื่อง" ), 'B' );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 35  , $boxh , $work['SERIALNUM'] , 'B' );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "คอยล์ร้อนรุ่น" ), 'B' );
			$pdf->SetFont('cordia','',$font_size);
			$pdf->Cell( 35  , $boxh , $work['GP_SERIALNUM2'], 'RB' );
			
			$pdf->setXY( $x, $y += $space );
			$pdf->SetFont('cordia','B',$font_size);
			$pdf->Cell( 15  , $boxh , iconv('UTF-8', 'cp874', "Task ID" ), 'LTRB', 0 , 'C', TRUE );
			$pdf->Cell( 80  , $boxh , iconv('UTF-8', 'cp874', "รายการ" ), 'LTRB', 0 , 'C', TRUE );
			$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', "สถานะ" ), 'LTRB', 0 , 'C', TRUE );
			$pdf->Cell( 30  , $boxh , iconv('UTF-8', 'cp874', "ค่ามาตรฐาน" ), 'LTRB', 0 , 'C', TRUE );
			$pdf->Cell( 30  , $boxh , iconv('UTF-8', 'cp874', "ค่าที่วัดได้" ) , 'LTRB', 0 , 'C', TRUE );
			
			foreach ($work['ACTIVITY'] as $act) { 
				$pdf->setXY( $x, $y += $space );
				$pdf->SetFont('cordia','',$font_size);
				$pdf->Cell( 15  , $boxh , $act['TASKID'], 1, 0 , 'C' );
				$pdf->Cell( 80  , $boxh , $act['DESCRIPTION'], 1 );
				$pdf->SetFont('cordia','B',$font_size);
				$pdf->Cell( 25  , $boxh , iconv('UTF-8', 'cp874', $map_status[ $act['STATUS'] ] ), 1, 0, 'C' );
				$pdf->SetFont('cordia','',$font_size);
				$pdf->Cell( 30  , $boxh , $act['TASKID'] == 10 ? '-' : $act['LOWER']. " - ". $act['UPPER'] , 1, 0 , 'C' );
				$pdf->Cell( 30  , $boxh , $act['VAL'] , 1, 0 , 'C' );
			}
			$work_num ++;
		}

		if( ( 6 * $space ) + $y > ( 35 * $space) + 30 ){
				$pdf->AddPage();
				$y = 0;
		}
		
		$pdf->setXY( $x, $y += $space );
		$pdf->SetFont('cordia','B',$font_size);
		$pdf->Cell( 90  , $boxh , iconv('UTF-8', 'cp874', 'ความพึงพอใจของลูกค้า'), 1, 0 , 'C', TRUE );
		$pdf->Cell( 90  , $boxh , iconv('UTF-8', 'cp874', 'ลายเซ็นลูกค้า' ), 1, 0, 'C', TRUE );
		
		$pdf->setXY( $x += 90, $y += $space );
		$pdf->SetFont('cordia','I',72);
		
		file_put_contents('public/tmp/sign.jpg', $sign);
		$pdf->Cell( 90  , $boxh * 4 , $pdf->Image(base_url('public/tmp/sign.jpg'), $x + 15, $y + 3 ) , 1, 0 , 'C' );
		
		$pdf->setXY( $x -= 90, $y );
		$pdf->SetFont('cordia','',$font_size);
		$first = true;
		$i=1;
		foreach( $sat as $s ){
			if( ! $first ){
				$pdf->setXY( $x, $y += $space );
			}else{
				$first = false;
			}
			$pdf->Cell( 45  , $boxh , $s['CRITERIA'], 'LRB', 0 , 'C' );
			$pdf->Cell( 45  , $boxh , $s['SCORE'], 'RB', 0 , 'C' );
			//if(++$i >4) break; //debug
		}
		
		//$pdf->Output( );
		$pdf->Output(REPORT_PATH . $parent['WONUM'] .'.pdf','f');
		$this -> db -> where ('wonum', $parent['WONUM']);
		$this -> db -> update ('summary', array( 'report_path' => $parent['WONUM'] .'.pdf' ));
	}
}
