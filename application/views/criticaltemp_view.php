<div class="row">  
    <div class="box" style="width: 80%; background-color: beige">
		<?php 
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'Open Type', 'shortcode' => 'OSC 1', 'asset_barcode' => '0000000228296', 'temp' => '8.1', 'status' => 'ALERT', 'time' => '120', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '06589','store_name' => 'ชุมชนใสน้ำเย็น 2 (RS)', 'type' => 'Open Type', 'shortcode' => 'OSC 1', 'asset_barcode' => '00000253814', 'temp' => '7.4', 'status' => 'ALERT', 'time' => '98', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '04678','store_name' => 'สาขา ปตท.เลิงนกทา', 'type' => 'Open Type', 'shortcode' => 'OSC 1', 'asset_barcode' => '0000000311438', 'temp' => '7.8', 'status' => 'ALERT', 'time' => '77', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '07412','store_name' => 'สาขา หมื่นไวย์', 'type' => 'Open Type', 'shortcode' => 'OSC 2', 'asset_barcode' => '0000000064636', 'temp' => '8.4', 'status' => 'ALERT', 'time' => '66', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '01230','store_name' => 'สาขา สันติสุข', 'type' => 'Open Type', 'shortcode' => 'OSC 2', 'asset_barcode' => '0000000242895', 'temp' => '6.7', 'status' => 'WAIT', 'time' => '56', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '06842','store_name' => 'เทคโน ซอย 11 ( โคราช ) (RN)', 'type' => 'Open Type', 'shortcode' => 'OSC 2', 'asset_barcode' => '0000000451296', 'temp' => '7.0', 'status' => 'WAIT', 'time' => '48', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '01230','store_name' => 'สาขา สันติสุข', 'type' => 'Open Type', 'shortcode' => 'OSC 1', 'asset_barcode' => '0000000242894', 'temp' => '6.6', 'status' => 'WAIT', 'time' => '39', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '06589','store_name' => 'ชุมชนใสน้ำเย็น 2 (RS)', 'type' => 'Open Type', 'shortcode' => 'OSC 3', 'asset_barcode' => '00000253816', 'temp' => '4.5', 'status' => 'NORMAL', 'time' => '130', 'datetime' => '2014-07-22');
			$id[] = array('store_id' => '06842','store_name' => 'เทคโน ซอย 11 ( โคราช ) (RN)', 'type' => 'Open Type', 'shortcode' => 'OSC 1', 'asset_barcode' => '0000000451295', 'temp' => '4.2', 'status' => 'NORMAL', 'time' => '144', 'datetime' => '2014-07-22'	);
		
		?>
        <form id="table_form" method="post">
            <table class="table table- -->hover table table-hover" border="0">
                <thead>
                    <tr>
                    	<th style="width:100px">รหัสสาขา</th>
                        <th style="width:100px">ชื่อสาขา</th>
                        <th style="width:100px">อุปกรณ์</th>
                        <th style="width:100px">ชื่อย่ออุปกรณ์</th>
                        <th style="width:100px">หมายเลขบาร์โค้ด</th>
                        <th style="width:100px">อุณหภูมิ</th>
                        <th style="width:100px">ระยะเวลาที่เกิด(นาที)</th>
                        <th style="width:100px">เวลาเริ่ม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($id > 0) {
                        foreach ($id as $r) {
                        	if( $r['status'] == 'ALERT') {
	                            echo "<tr bgcolor='#f36c60' style='color:#000000'>";
								echo "<td>{$r['store_id']}</td>";
	                            echo "<td>{$r['store_name']}</td>";
								echo "<td>{$r['type']}</td>";
	                            echo "<td>{$r['shortcode']}</td>";
	                            echo "<td>{$r['asset_barcode']}</td>";
	                            echo "<td>{$r['temp']}</td>";
								echo "<td>{$r['time']}</td>";
								echo "<td>{$r['datetime']}</td>";
	                            echo "</tr>";
							}
                        }
                        
						foreach ($id as $r) {
                        	if( $r['status'] == 'WAIT') {
	                            echo "<tr bgcolor='#ffd54f' style='color:#000000'>";
								echo "<td>{$r['store_id']}</td>";
	                            echo "<td>{$r['store_name']}</td>";
								echo "<td>{$r['type']}</td>";
	                            echo "<td>{$r['shortcode']}</td>";
	                            echo "<td>{$r['asset_barcode']}</td>";
	                            echo "<td>{$r['temp']}</td>";
								echo "<td>{$r['time']}</td>";
								echo "<td>{$r['datetime']}</td>";
	                            echo "</tr>";
							}
                        }
						
						foreach ($id as $r) {
                        	if( $r['status'] == 'NORMAL') {
	                            echo "<tr bgcolor='#ccff90' style='color:#000000'>";
								echo "<td>{$r['store_id']}</td>";
	                            echo "<td>{$r['store_name']}</td>";
								echo "<td>{$r['type']}</td>";
	                            echo "<td>{$r['shortcode']}</td>";
	                            echo "<td>{$r['asset_barcode']}</td>";
	                            echo "<td>{$r['temp']}</td>";
								echo "<td>{$r['time']}</td>";
								echo "<td>{$r['datetime']}</td>";
	                            echo "</tr>";
							}
                        }
                    }
                    ?>
                </tbody>
            </table>
        </form>
	</div>
</div>