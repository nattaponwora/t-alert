<div class="row">  
    <div class="box" style="width: 80%">
		<?php 
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'ALERT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'ALERT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'ALERT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'ALERT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'WAIT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'WAIT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'WAIT');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'NORMAL');
			$id[] = array('store_id' => '02192','store_name' => 'พันธ์ทิพย์พลาซ่า (BW)', 'type' => 'ตู้ไอศกรีมวอล์', 'shortcode' => 'WAL', 'asset_barcode' => '0000000228296', 'temp' => '-18', 'status' => 'NORMAL');
		
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
<script type='text/javascript'>
    setTimeout(a, 5000);
    function a() {
        $("#table_form").load("<?= base_url("criticaltemp/show") ?> #table_form");
        setTimeout(a, 5000);
    }
</script>