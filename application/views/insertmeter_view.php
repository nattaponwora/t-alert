<script>
	$(function() {
		$('#insertmeter_table').dataTable();
	});
	
	function load_asset() {
		var search_value = document['insert_form']['search_storeasset'].value; 
        var url = '<?= base_url("insertmeter/load_states") ?>/' + search_value; 
        loadStates(url, 'assetlist'); 
        
		
		var storename = document['insert_form']['search_storeasset'].value;		
       	var url = '<?= base_url("insertmeter/get_storename") ?>/' + storename; 
        loadStates(url, 'search_storename_span_d');  
        
    	load_assettype(); 
    }
    
    function load_assettype() {
        var search_value = document['insert_form']['search_storeasset'].value; 
        var search_valuelist = document['insert_form']['search_assetlist'].value; 
        var url = '<?= base_url("insertmeter/load_statestype") ?>/' + search_value + '/' + search_valuelist; 
        loadStates(url, 'assettypelist');      
    }
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px; position: absolute; left: 0; right: 0; margin: 0 auto; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel">Insert Meter</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form class="form-signin" name="insert_form" id="insert_form" action= "<?= base_url("insertmeter/added") ?>" role="form" method="post">

					<br>
					<br>
					<div class="form-group">
						<label class="col-sm-5 control-label">หมายเลขเครื่องวัด</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="search_meterid" name="search_meterid" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">รหัสร้าน</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="search_storeasset" name="search_storeasset" required="" onchange="load_asset()">
						</div>			
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ชื่อร้าน</label>
						<div class="col-sm-4 input-group" id="search_storename_span_d">
					  		<input class="form-control" readonly='readonly' id="search_store" name="search_store" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ประเภทอุปกรณ์</label>
						<div class="col-sm-7 input-group" id ="assetlist">            
				            <?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"'; ?>
				            <?= form_dropdown('search_assetlist', $selection, $search_asset, $js); ?>
				        </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ชื่อย่ออุปกรณ์</label>
						<div class="col-sm-2 input-group" id ="assettypelist">
							<?php $js2 = 'id="search_assettypelist" name="search_assettypelist" class="btn btn-default dropdown-toggle"'; ?>
				            <?= form_dropdown('search_assettypelist', $selectiontype, $search_assettypelists, $js2); ?>
				        </div>
					</div>
					<br>
					
					<div class="row">
						<div class="form-group">
							<div class="col-xs-3 col-xs-offset-4">
								<button id="search" name="search" type="submit" class="button green medium">
									Insert
								</button>
							</div>
							<div class="">
								<button id="search" name="search" type="reset" class="button orange medium">
									Reset
								</button>
							</div>
						</div>
					</div>
				</div>
			<div id='show'></div>
			<br>
			<br>
      </div>
    </div>
  </div>
</div>


<form class="form-signin" name="table_form" id="table_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
	<div class="box" style="background-color: beige	; margin-top: 60px; width: 70%">
		<div class="row">
			<div class="form-group">
				<form id="table_form" name="table_form" method="post">
					<div class="table-responsive">
						<table id="insertmeter_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
							<thead>
								<tr style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef;">
									<th style="max-width:30px; width: 30px">หมายเลขเครื่องวัด</th>
									<th style="max-width:30px; width: 30px">รหัสร้าน</th>
									<th style="max-width:50px; width: 50px">ชื่อร้าน</th>
									<th style="max-width:50px; width: 50px">ประเภทอุปกรณ์</th>
									<th style="max-width:50px; width: 50px">ชื่อย่ออุปกรณ์</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($data_table > 0) {
									foreach ($data_table as $r) {
										echo "<tr id='".$r['id']."'>";
										echo "<td style='max-width:30px; width: 30px'>{$r['meter_id']}</td>";
										echo "<td style='max-width:30px; width: 30px'>{$r['store_id']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['store_name']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['type']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['asset_shortname']}</td>";
										// echo ("<td><a href=\"edit_form.php?id=$row[employees_number]\">Edit</a></td></tr>");
										//echo "<td><a href='".base_url('technician')."/".$count . "'>"."<img src='public/images/icon/edit_icon.png' height='32px' width='32px'></a></td>";
										echo "</tr>";
									}
								}
								?>
							</tbody>
						</table>
						<div id='show'></div>
					</div>
				</form>
				<br>
			<form id="add_form" name="add_form" method="post">
				<a id="add_icon" name="add_icon" class="col-xs-offset-11 mouse_hover" data-toggle="modal" data-target="#myModal"> <img src='public/images/icon/add_icon.png' height='32px' width='32px'></a>				
			</form>
			</div>
		</div>
	</div>
</form>

<div id="dialog2" title="Insert Meter" style="display: none; min-width: 500px">
	
</div>