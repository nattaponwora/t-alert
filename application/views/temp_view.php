<script type="text/javascript">
	var count = 0;
    function load_asset() {
        var search_value = document['search_form']['search_storeasset'].value; 
        var url = '<?= base_url("temp/load_states") ?>/' + search_value; 
        loadStates(url, 'assetlist'); 
        load_assettype();     
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
        	"sort" : false,
        	"searching": false,
        	"info": false,
        	"columnDefs": [{
        		"targets": [0],
            	"visible": false,
            	"searchable": false,	
            }]
    	});
   	});
	
	function test() {
	 	//alert("in");
	 	
	 	//t.fnReloadAjax();
	 	// count = 0;
	 	$.getJSON('<?= base_url("temp/show") ?>', function(data) {
      		$.each(data, function(k, arrayItem) {	
      			var t = $('#table_page').DataTable();
        		//alert(arrayItem.id + " " + arrayItem.temp + " " + arrayItem.status + " " + arrayItem.time + " " + arrayItem.abnormal_period);
        		var order = $('.first').attr('order');
        		//alert(order + ' ' + (order-1));
        		$('.first').removeClass('first');
        		var rowNode = t.row.add( [
        			(count--),
        			arrayItem.temp,
        			arrayItem.abnormal_period,
            		arrayItem.time
        		] ).draw().node();
        		
        		t.column(3).order( 'desc' );
        		
        		if(arrayItem.status == 'ALERT'){
        			$( "#dialog" ).dialog( "open" );
        			$( rowNode ).addClass('alertcolor first');
        		}
        		else if(arrayItem.status == 'WAIT'){$( rowNode ).addClass('waitcolor first');};
        		//else if(arrayItem.status == 'NORMAL'){$( rowNode ).addClass('normalcolor');};
        		$(rowNode).attr('order', order - 1);
      		});
	 	});
	 	setTimeout(test, 3000);
	 }	
</script>
    
<div id="dialog" title="Alert">
	<p>อุณหภูมิผิดปรกติ</p>
</div>

<div class="container box" style="background-color: beige">
    <form name="search_form" id="search_form" class="form-inline" role="form" action="<?= base_url("temp/search") ?>" method="post">
        <label>รหัสร้าน</label>
        <div class="form-group">
            <?php if($searchTerm == null) { ?>
            <input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="" onchange="load_asset()" />
            <?php } ?>
            <?php if($searchTerm != null) { ?>
            <input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="<?= $searchTerm ?>" onchange="load_asset()" />
            <?php } ?>
        </div>
        
        <label>อุปกรณ์</label>
        <div class="form-group" id ="assetlist" name="assetlist">            
            <?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"'; ?>
            <?= form_dropdown('search_assetlist', $selection, $search_asset, $js); ?>
        </div>
        
        
        <label>หมายเลขอุปกรณ์</label>
        <div class="form-group" id ="assettypelist" name="assettypelist">
            <?php $js2 = 'id="search_assettypelist" name="search_assettypelist" class="btn btn-default dropdown-toggle"'; ?>
            <?= form_dropdown('search_assettypelist', $selectiontype, $search_assettypelists, $js2); ?>
        </div>
        
        <button id="search" name="search" type="submit" class="btn btn-primary">
            Search
        </button>
    </form>
    <br>
</div>
<div class="row"></div>
    <div class="col-xs-4 col-xs-offset-1">
    <div class="box" style="background-color: beige">
        <div class="form-group">
            <label class="col-sm-5 control-label">รหัสสาขา</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['store_id']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-5 control-label">ชื่อสาขา</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['store_name']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-5 control-label">อุปกรณ์</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['type']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-5 control-label">หมายเลขบาร์โค้ด</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['asset_barcode']}"; }}?> </p>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-5 control-label">ชื่อย่ออุปกรณ์</label>
            <div class="col-sm-7">
                <p><?php if($infomation > 0) { foreach($infomation as $r){ echo "{$r['asset_shortname']}"; }}?> </p>
            </div>
        </div>
        <br>
    </div>    
    </div>    
    <div class="col-xs-6">
	    <div class="box" style="background-color: beige">
	   		<form id="table_form" method="post">
	            <table id="table_page" class="table table-hover " cellspacing="0" width="100%" border="0">
	                <thead>
	                    <tr>
	                    	<th class="hidden" style="width:100px">id</th>
	                    	<th style="width:100px">อุณหภูมิ</th>
	                        <th style="width:100px">เวลาที่เกินมาตรฐาน(นาที)</th>
	                        <th style="width:100px">เวลา</th>
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
	                        	if($r['status'] == 'ALERT') {
		                            echo "<tr class='alertcolor$first' order=$i >";
									echo "<td class='hidden'>{$i}</td>";
		                            echo "<td>{$r['temp']}</td>";
		                            echo "<td>{$r['abnormal_period']}</td>";
		                            echo "<td>{$r['time']}</td>";
		                            echo "</tr>";
								} else if($r['status'] == 'WAIT') {
									echo "<tr class='waitcolor$first' order=$i >";
									echo "<td class='hidden'>{$i}</td>";
		                            echo "<td>{$r['temp']}</td>";
		                            echo "<td>{$r['abnormal_period']}</td>";
		                            echo "<td>{$r['time']}</td>";
		                            echo "</tr>";
								} else {
									echo "<tr class='normalcolor$first' order=$i >";
									echo "<td class='hidden'>{$i}</td>";
		                            echo "<td>{$r['temp']}</td>";
		                            echo "<td>{$r['abnormal_period']}</td>";
		                            echo "<td>{$r['time']}</td>";
		                            echo "</tr>";
								}
								$i++;
							}
	                    }
	                    ?>
	                </tbody>
	            </table>
	        </form>		
		</div>
	</div>
</div>

<script type='text/javascript'>
    setTimeout(test, 5000);
   // function a() {
        //$("#table_form").load("<?= base_url("temp/show/$searchTerm/$search_asset/$search_assettypelists") ?> #table_form");
        //setTimeout(a, 5000);
    //}
    
</script>