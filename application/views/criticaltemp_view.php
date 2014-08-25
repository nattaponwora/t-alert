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
                    
                    function DateTimeDiff($strDateTime1,$strDateTime2)
	 				{
	 					$time = strtotime($strDateTime2) - strtotime($strDateTime1);
						$sec = $time % (60);
						$min = floor(($time % 3600) / (60));
						$hour = floor($time / 3600);
						//if($hour == 0) $hour = "00";
						return str_pad($hour, 2, 0, STR_PAD_LEFT).":".str_pad($min, 2, 0, STR_PAD_LEFT).":".str_pad($sec, 2, 0, STR_PAD_LEFT);
	 				}
					
					$countable['count'] = array();
                    if ($sorttimeDESC > 0 && $sorttimeASC > 0 && $id > 0) {
                        
	                        foreach ($sorttimeASC as $c) {
		                    	if( $c['status'] == 'ALERT') {
	                        		//$countable['count'] = $c['id'];
		                        	foreach ($sorttimeDESC as $d) {
		                        		foreach ($id as $r) {
		                        			if($c['id'] == $d['id']) {
					                            echo "<tr class='alertcolor'>";
												echo "<td>{$r['store_id']}</td>";
					                            echo "<td>{$r['store_name']}</td>";
												echo "<td>{$r['type']}</td>";
					                            echo "<td>{$r['shortcode']}</td>";
					                            echo "<td>{$r['asset_barcode']}</td>";
					                            echo "<td>{$r['temp']}</td>";
												$diff = DateTimeDiff( $d['time'], $c['time']);
												echo "<td>$diff</td>";
												echo "<td>{$d['time']}</td>";
					                            echo "</tr>";
												break;
											}
										}
									}
								}
							}
							             
		                  	foreach ($sorttimeASC as $c) {
		                    	if( $c['status'] == 'WAIT') {
	                        		//$countable['count'] = $c['id'];
		                        	foreach ($sorttimeDESC as $d) {
		                        		foreach ($id as $r) {
		                        			if($c['id'] == $d['id']) {
					                            echo "<tr class='waitingcolor'>";
												echo "<td>{$r['store_id']}</td>";
					                            echo "<td>{$r['store_name']}</td>";
												echo "<td>{$r['type']}</td>";
					                            echo "<td>{$r['shortcode']}</td>";
					                            echo "<td>{$r['asset_barcode']}</td>";
					                            echo "<td>{$r['temp']}</td>";
												$diff = DateTimeDiff( $d['time'], $c['time']);
												echo "<td>$diff</td>";
												echo "<td>{$d['time']}</td>";
					                            echo "</tr>";
												break;
											}
										}
									}
								}
							}
						// foreach ($id as $r) {
                        	// if( $r['status'] == 'WAIT') {
	                            // echo "<tr class='waitingcolor'>";
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
// 						
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
    setTimeout(a, 5000);
    function a() {
        $("#table_form").load("<?= base_url("criticaltemp/show/") ?> #table_form");
        setTimeout(a, 5000);
    }
</script>