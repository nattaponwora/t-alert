
<div class="row">  
    <div class="box" style="width: 80%; background-color: beige">
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
                        <th style="width:100px">ระยะเวลา (hh:mm:ss)</th>
                        <th style="width:100px">เวลาเริ่ม</th>
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
                        		$remem[] = $c['id'];
                        		foreach ($getstart as $g) {
	                        		foreach ($id as $r) {
	                        			if($c['id'] == $r['id'] && $g['id'] == $c['id']) {
				                            echo "<tr class='alertcolor'>";	
											echo "<td>{$r['store_id']}</td>";
				                            echo "<td>{$r['store_name']}</td>";
											echo "<td>{$r['type']}</td>";
				                            echo "<td>{$r['asset_shortname']}</td>";
				                            echo "<td>{$r['asset_barcode']}</td>";
				                            echo "<td>{$r['temp']}</td>";
											$diff = DateTimeDiff($r['abnormal_period']);
											echo "<td>$diff</td>";
											echo "<td>{$g['time']}</td>";
				                            echo "</tr>";
											break;
										}
									}	
								}
							}
						}

						foreach ($sorttime as $c) {
		                    if( $c['status'] == 'WAIT') {
	                        	foreach ($id as $r) {
	                        		if($c['id'] == $r['id']) {
			                            echo "<tr class='waitingcolor'>";	
										echo "<td>{$r['store_id']}</td>";
			                            echo "<td>{$r['store_name']}</td>";
										echo "<td>{$r['type']}</td>";
			                            echo "<td>{$r['asset_shortname']}</td>";
			                            echo "<td>{$r['asset_barcode']}</td>";
			                            echo "<td>{$r['temp']}</td>";
										$diff = DateTimeDiff($r['abnormal_period']);
										echo "<td>$diff</td>";
										echo "<td>{$c['time']}</td>";
			                            echo "</tr>";
										break;
									}
								}	
							}
						}
						
						
						// foreach ($id as $r) {
                        	// if( $r['status'] == 'NORMAL') {
	                            // echo "<tr class='normalcolor'>";
								// echo "<td>{$r['store_id']}</td>";
	                            // echo "<td>{$r['store_name']}</td>";
								// echo "<td>{$r['type']}</td>";
	                            // echo "<td>{$r['shortcode']}</td>";
	                            // echo "<td>{$r['asset_barcode']}</td>";
	                            // echo "<td>{$r['temp']}</td>";
								// echo "<td>".round(abs($r['time']) / 60,2)."</td>";
								// echo "<td>{$r['time']}</td>";
	                            // echo "</tr>";
							// }
                        // }
                    }
                    ?>
                </tbody>
            </table>
        </form>
	</div>
</div>

<script type='text/javascript'>
	var jArray= <?php echo json_encode($remem ); ?>;
    for(var i = 0; i < 2; i++){
        //alert(jArray[i]);
    }
    
    setTimeout(a, 5000);
    function a() {
    	
        $("#table_form").load("<?= base_url("criticaltemp/show/") ?> #table_form");
        setTimeout(a, 5000);
        
        var jArray= <?php echo json_encode($remem ); ?>;
        alertation = document.getElementById('alert').value;
		// if(alertation == 'alert') {
			 // alert(alertation);
		// }
    }
</script>
