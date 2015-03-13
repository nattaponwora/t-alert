<div class="container-fluid">
<div class="row">  
	<form id="table_form" method="post">
    <div class="container box" id="fnot_use" style="background-color: beige; display: <?= $get2 ?>"  >
        
        	<div class="table-responsive" >
            <table id="critical_table" class="table table- -->hover table table-hover rwd-table" border="0">
                <thead>
                    <tr style="background-color: #004276; color: white; white-space: nowrap">
                    	<th style="width:100px">รหัสสาขา</th>
                        <th style="width:100px">ชื่อสาขา</th>
                        <th style="width:100px">อุปกรณ์</th>
                        <th style="width:100px">ชื่อย่ออุปกรณ์</th>
                        <th style="width:100px">หมายเลขบาร์โค้ด</th>
                        <th style="width:100px">อุณหภูมิ</th>
                        <th style="width:100px">ระยะเวลา (hh:mm:ss)</th>
                        <th style="width:150px">เวลาเริ่ม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function DateTimeDiff($strDateTime)
	 				{
	 					$time = $strDateTime;
						$sec = $time % (60);
						$min = floor(($time % 3600) / (60));
						$hour = floor($time / 3600);
						//if($hour == 0) $hour = "00";
						return str_pad($hour, 2, 0, STR_PAD_LEFT).":".str_pad($min, 2, 0, STR_PAD_LEFT).":".str_pad($sec, 2, 0, STR_PAD_LEFT);
	 				}
					
                    if ($sorttime > 0 && $id > 0) {
                    	//foreach ($getid as $i) {
						foreach ($sorttime as $c) {
	                    if( $c['status'] == 'ALERT') {
                    		?><input type="hidden" id="alert" value="alert" /><?php
                    		$remem[] = $c['asset_id'];
             				// $this->view->p($getstart);	
                        		foreach ($id as $r) {
                        			if($c['asset_id'] == $r['id']) {
			                            echo "<tr style='white-space: nowrap;' class='alertcolor'>";	
										echo "<td>{$r['store_id']}</td>";
			                            echo "<td>{$r['store_name']}</td>";
										echo "<td>{$r['type']}</td>";
			                            echo "<td>{$r['asset_shortname']}</td>";
			                            echo "<td>{$r['asset_barcode']}</td>";
			                            echo "<td>{$r['temp']}</td>";
										$diff = DateTimeDiff($r['abnormal_period']);
										echo "<td>$diff</td>";
										echo "<td>{$r['time']}</td>";
			                            echo "</tr>";
										break;
									}
								}	
							}
						}
						

						foreach ($sorttime as $c) {
		                    if( $c['status'] == 'WAIT') {
	                        	foreach ($id as $r) {
	                        		if($c['asset_id'] == $r['id']) {	                        			
			                            echo "<tr style='white-space: nowrap;' class='waitcolor'>";	
										echo "<td>{$r['store_id']}</td>";
			                            echo "<td>{$r['store_name']}</td>";
										echo "<td>{$r['type']}</td>";
			                            echo "<td>{$r['asset_shortname']}</td>";
			                            echo "<td>{$r['asset_barcode']}</td>";
			                            echo "<td>{$r['temp']}</td>";
										$diff = DateTimeDiff($r['abnormal_period']);
										echo "<td>$diff</td>";
										echo "<td>{$r['time']}</td>";
			                            echo "</tr>";
										break;
									}
								}	
							}
							
						}
                    }
                    ?>
                </tbody>
            </table>
            </div>
            
            
        
	</div>
	</form>
	<form id="dialogd_form" method="post">
		<div class="row" style="display: <?= $get ?>">
			<div style="text-align: center;position: absolute; top: 40%; z-index: 0" class="well col-sm-4 col-sm-push-4 col-xs-12">
				<label>ไม่มีอุณหภูมิที่ผิดปกติ</label>
			</div>
		</div>
	</form>
</div>



<script type='text/javascript'>

    setTimeout(a);
    function a() {
        $("#table_form").load("<?= base_url('criticaltemp/show/') ?> #table_form");
        $("#dialogd_form").load("<?= base_url('criticaltemp/checkd/') ?> #dialogd_form");
        	
        //refresh table every 1minite
        setTimeout(a, 60000);
    }
</script>


