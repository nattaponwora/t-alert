<script type="text/javascript">
    function load_asset() {
        var search_value = document['search_form']['search_storeasset'].value; 
        var url = '<?= base_url("temp/load_states") ?>/' + search_value; 
        loadStates(url, 'assetlist'); 
        load_assettype();     
    }
    
    function load_assettype() {
        var search_value = document['search_form']['search_storeasset'].value; 
        var search_valuelist = document['search_form']['search_assetlist'].value; 
        
        //alert(search_valuelist);
        var url = '<?= base_url("temp/load_statestype") ?>/' + search_value + '/' + search_valuelist; 
        loadStates(url, 'assettypelist');      
    }
    
    $(function () {
		$(".pagec").on("click", function () { 	
			var current_page = $(this).text();
			alert(current_page);
			<?php $selectpage ?> = current_page;
			$.post("<?= base_url('temp/sendpage')?>/" + current_page, $('#table_form').serialize(), 
				function(response){
	 				
				}
			);
		}); 
	});
</script>
    
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
	            <table class="table table-hover table table-hover" border="0">
	                <thead>
	                    <tr>
	                        <th style="width:100px">ลำดับที่</th>
	                        <th style="width:100px">อุณหภูมิ</th>
	                        <th style="width:100px">เวลา</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php
	                    if ($id > 0) {
	                        $i = 1;
	                        foreach ($id as $r) {
	                        	if($r['status'] == 'ALERT') {
		                            echo "<tr class='alertcolor'>";
		                            echo "<td>{$i}</td>";
		                            echo "<td>{$r['temp']}</td>";
		                            echo "<td>{$r['time']}</td>";
		                            echo "</tr>";
								} else if($r['status'] == 'WAIT') {
									echo "<tr class='waitingcolor'>";
		                            echo "<td>{$i}</td>";
		                            echo "<td>{$r['temp']}</td>";
		                            echo "<td>{$r['time']}</td>";
		                            echo "</tr>";
								} else {
									echo "<tr class='normalcolor'>";
		                            echo "<td>{$i}</td>";
		                            echo "<td>{$r['temp']}</td>";
		                            echo "<td>{$r['time']}</td>";
		                            echo "</tr>";
								}
								$i++;
							}
	                    }
	                    ?>
	                </tbody>
	            </table>
	            
	            <div class="col-md-offset-4">
	            	
		            <ul class="pagination" id="pagination">
						<li class="<?= $selectpage == 1 ? 'active' : 'last' ?> pagec"><a>1</a></li>
						<li class="<?= $selectpage == 2 ? 'active' : 'last' ?> pagec"><a>2</a></li>
						<li class="<?= $selectpage == 3 ? 'active' : 'last' ?> pagec"><a>3</a></li>
						<li class="<?= $selectpage == 4 ? 'active' : 'last' ?> pagec"><a>4</a></li>
						<li class="<?= $selectpage == 5 ? 'active' : 'last' ?> pagec"><a>5</a></li>
					</ul>
					<div id='show'></div>
					<?php echo $selectpage; ?>
				</div>
	        </form>		
		</div>
	</div>
</div>

<!-- <script type='text/javascript'>
    setTimeout(a, 5000);
    function a() {
        $("#table_form").load("<?= base_url("temp/show/$searchTerm/$search_asset/$search_assettypelists") ?> #table_form");
        setTimeout(a, 5000);
    }
</script> -->