<script type="text/javascript">
	var count = 0;
	var first_alert = false;
	
    function load_asset() {
    var search_value = document['search_form']['search_storeasset'].value; 
        if(search_value != "") {
	        var url = '<?= base_url("temp/load_states") ?>/' + search_value; 
	        loadStates(url, 'assetlist'); 
	        load_assettype();
	    }
    }
    
    function load_assettype() {
        var search_value = document['search_form']['search_storeasset'].value; 
        var search_valuelist = document['search_form']['search_assetlist'].value; 
        var url = '<?= base_url("temp/load_statestype") ?>/' + search_value + '/' + search_valuelist; 
        loadStates(url, 'assettypelist');    
    }
    
    $(function () {
    	$( "#dialog" ).dialog({
		    modal: true,
		    autoOpen: false,
		   	buttons: {
		    	OK: function() {
		    		$( this ).dialog( "close" );
		        }
		    },
		    show: {
		    	effect: "blind",
		    	duration: 500
		  	}
		});
		
    	$('#table_page').dataTable( {
        	"pagingType": "full_numbers",
        	"order": [ 3, 'desc' ],
        	"sort" : true,
        	"searching": false,
        	"info": false,
        	"columnDefs": [{
        		"targets": [0],
            	"visible": false,
            	"searchable": false,	
            }],
            "language": {
	            "lengthMenu": "Display _MENU_ records per page",
	            "zeroRecords": "ไม่มีข้อมูลที่ค้นหา",
	            "info": "Showing page _PAGE_ of _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)"
        	}
    	});
   	});
	
	function test() {
	 	$.getJSON('<?= base_url("temp/show") ?>', function(data) {
      		$.each(data, function(k, arrayItem) {	
      			var t = $('#table_page').DataTable();
        		var order = $('.first').attr('order');
        		$('.first').removeClass('first');
        		
        		if(arrayItem.temp != '85')  {
	        		var rowNode = t.row.add( [
	        			count,
	        			arrayItem.temp,
	        			secondsToString(arrayItem.abnormal_period),
	            		arrayItem.time
	        		] ).draw().node();
	        		
	        		t.column(3).order( 'desc' );
        		}
        		if(arrayItem.temp == '85')  {
        			rowNode = t.row.add( [
	        			count,
	        			' ',
	        			'Start',
	            		arrayItem.time
	        		] ).draw().node();
	        		t.column(3).order( 'desc' );
        			$( rowNode ).addClass('startcolor first');
        		} 
        		else if(arrayItem.status == 'ALERT') {
        			if(first_alert == false) {
        				$( "#time_alert").text(secondsToString(arrayItem.abnormal_period));
        				$( "#temp_alert").text(arrayItem.temp);
        				$( "#dialog" ).dialog( "open" );
        				first_alert = true;
        			}
        			$( rowNode ).addClass('alertcolor first');
        		}
        		else if(arrayItem.status == 'WAIT'){$( rowNode ).addClass('waitcolor first');}
        		else if(arrayItem.status == 'NORMAL'){first_alert = false;}
        		$(rowNode).attr('order', order - 1);
        		count--;
      		});
	 	});
	 	setTimeout(test, 3000);
	 }	
	 
	 function secondsToString(seconds)
	 {
		var numhours = Math.floor(seconds / 3600);
		var numminutes = Math.floor((seconds % 3600) / 60);
		var numseconds = (seconds % 3600) % 60;
		
		if(numhours < 10) { numhours = "0" + (numhours); } 
		if(numminutes < 10) { numminutes = "0" + (numminutes); } 
		if(numseconds < 10) { numseconds = "0" + (numseconds); } 
		return numhours + ":" + numminutes + ":" + numseconds;
	 }
</script>

<div id="dialog" title="Alert" style="font: white">
	<p><b>อุณหภูมิ </b> <span id='temp_alert'></span> <b>องศาเซลเซีย</p>
	<p>อุณหภูมิมีความผิดปกติเกินจากมาตราฐานมา</b> <span id='time_alert'></span> <b>ชั่วโมง</b></p>
	<?php
		foreach($infomation as $r) {
	?>
			<p><b>รหัสร้าน</b> : <?= $r['store_id'] ?></p>
			<p><b>ชื่อสาขา</b> : <?= $r['store_name'] ?></p>
			<p><b>อุปกรณ์ </b> : <?= $r['type'] ?></p>
			<p><b>ชื่อย่ออุปกรณ์</b> : <?= $r['asset_shortname'] ?></p>
	<?php	 	
			break;
		}
	?>
</div>
<div class="row"></div>
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="box" style="background-color: beige">
		    <form name="search_form" id="search_form" class="form-inline" role="form" action="<?= base_url("temp/search") ?>" method="post">
		        <label>รหัสร้าน</label>
		        <div class="form-group">
		            <?php if($searchTerm == null) { ?>
		            <input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="" onchange="load_asset()" />
		            <?php } ?>
		            <?php if($searchTerm != null ) { ?>
		            <input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="<?= $searchTerm ?>" onchange="load_asset()" />
		            <?php } ?>
		        </div>
		        
		        <label>อุปกรณ์</label>
		        <div class="form-group" id ="assetlist" name="assetlist">            
		            <?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()" img="public/images/loading.gif"'; ?>
		            <?= form_dropdown('search_assetlist', $selection, $search_asset, $js); ?>
		        </div>
		        <div id="spinner" class="spinner" style="display:none;"><img id="img-spinner" src="public/images/loading.gif" alt="Loading"/></div>
		        
		        <label>หมายเลขอุปกรณ์</label>
		        <div class="form-group" id ="assettypelist" name="assettypelist">
		            <?php $js2 = 'id="search_assettypelist" name="search_assettypelist" class="btn btn-default dropdown-toggle"'; ?>
		            <?= form_dropdown('search_assettypelist', $selectiontype, $search_assettypelists, $js2); ?>
		        </div>

		        <button id="search" name="search" type="submit" class="button blue small">
		            Search
		        </button>
		    </form>
		    <br>
		</div>
	</div>
</div>
<div class="row"></div>
    <div class="col-xs-12 col-sm-4 col-sm-offset-1">
    <div class="box" style="background-color: beige">
        <div class="form-group">
            <label class="col-xs-12 col-sm-5 control-label">รหัสสาขา</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['store_id']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-xs-12 col-sm-5 control-label">ชื่อสาขา</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['store_name']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-xs-12 col-sm-5 control-label">อุปกรณ์</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['type']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-xs-12 col-sm-5 control-label">หมายเลขบาร์โค้ด</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['asset_barcode']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-xs-12 col-sm-5 control-label">ชื่อย่ออุปกรณ์</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['asset_shortname']}"; }}?> </p>
            </div>
        </div>
        <br>
    </div>    
    </div>    
    <div class="col-xs-12 col-sm-6">
	    <div class="box" style="background-color: beige">
	   		<form id="table_form" method="post">
	   			<div class="table-responsive">
		            <table id="table_page" class="table table-hover" cellspacing="0" width="100%" border="0">
		                <thead class="center">
		                    <tr style="background-color: #004276; color: white;">
		                    	<th class="hidden" style="width:100px">id</th>
		                    	<th class='text-overflow' style="width:100px">อุณหภูมิ(เซลเซียส)</th>
		                        <th class='text-overflow' style="width:100px">เวลาที่เกินมาตรฐาน(ชั่วโมง)</th>
		                        <th class='text-overflow' style="width:100px">เวลา</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php	                    	
		                    if ($id > 0) {
		                        $i = 1;
		                        foreach ($id as $r) {
		                        	if($i==1){
		                        		$first = " first";
		                        	} else {
										$first = "";
									}
									if($r['temp'] == '85')
									{
										echo "<tr class='startcolor$first' order=$i >";
										echo "<td class='hidden'>{$i}</td>";
			                            echo "<td></td>";
									    echo "<td class='text-overflow'>"."Start"."</td>";
			                            echo "<td style='white-space: nowrap;'>{$r['time']}</td>";
			                            echo "</tr>";
									}
									else 
									{
			                        	if($r['status'] == 'ALERT') {
				                            echo "<tr class='alertcolor$first' order=$i >";
											echo "<td class='hidden'>{$i}</td>";
				                            echo "<td>{$r['temp']}</td>";
										    echo "<td class='text-overflow'>".gmdate('H:i:s',$r['abnormal_period'])."</td>";
				                            echo "<td style='white-space: nowrap;'>{$r['time']}</td>";
				                            echo "</tr>";
										} else if($r['status'] == 'WAIT') {
											echo "<tr class='waitcolor$first' order=$i >";
											echo "<td class='hidden'>{$i}</td>";
				                            echo "<td>{$r['temp']}</td>";
										    echo "<td>".gmdate('H:i:s',$r['abnormal_period'])."</td>";
				                            echo "<td style='white-space: nowrap;'>{$r['time']}</td>";
				                            echo "</tr>";
										} else {
											echo "<tr class='normalcolor$first' order=$i >";
											echo "<td class='hidden'>{$i}</td>";
				                            echo "<td>{$r['temp']}</td>";
										    echo "<td>".gmdate('H:i:s',$r['abnormal_period'])."</td>";
				                            echo "<td style='white-space: nowrap;'>{$r['time']}</td>";
				                            echo "</tr>";
										}
										$i++;
									}
								}
		                    }
		                    ?>
		                </tbody>
		            </table>
	            </div>
	        </form>		
		</div>
	</div>
</div>

<script type='text/javascript'>
    setTimeout(test, 5000);
</script>