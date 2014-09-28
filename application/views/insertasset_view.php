<script>
	$(function() {
		var str = '<?=$storename?>';
		var availableTags = str.split(',');
		$( '#search_storeasset' ).autocomplete({
			source: availableTags
		});
		
		$('#insertasset_table').dataTable();
		

	});
	
	function change_shortname(){
		var assettype = document['insert_form']['search_assettype'].value;		      	
       	var url = '<?= base_url("insertasset/get_shortname") ?>/' + assettype; 
        loadStates(url, 'search_assetshortname_span_d');  
	}
	
	function change_storename(){
		var storename = document['insert_form']['search_storeid'].value;		
       	var url = '<?= base_url("insertasset/get_storename") ?>/' + storename; 
        loadStates(url, 'search_storename_span_d');  
	}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"  style="max-width: 500px; position: absolute; left: 0; right: 0; margin: 0 auto; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel">Insert Asset</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
	<form class="form-signin" name="insert_form" id="insert_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
					<br>
					<br>
					<div class="form-group">
						<label class="col-sm-5 control-label">รหัสร้าน</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="search_storeid" name="search_storeid" required="" onchange="change_storename()">
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
						<div class="col-sm-7 input-group">
							<?php $js = 'id="search_assettype" name="search_assettype" class="btn btn-default dropdown-toggle" onchange="change_shortname()"'; ?>
							<?= form_dropdown('select_assettype', $assettype, null, $js); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ชื่อย่ออุปกรณ์</label>
						<div class="col-sm-3 input-group" id="search_assetshortname_span_d">
							<span class="input-group-addon" id="shortname"></span>
							<input type="hidden" name="hidden_search_assetshortname_span" value ="">
							<input class="form-control" type="text" id="search_assetshortname" name="search_assetshortname" required="">
						</div>
					</div>
					<div class="form-group">
	                    <label class="col-sm-5 control-label">หมายเลขบาร์โค๊ดอุปกรณ์</label>
	                    <div class="col-sm-4 input-group">
	                        <input class="form-control" id="barcode_asset" name="barcode_asset"  required="">
	                    </div>
	                </div>
	                <!-- <div class="form-group">
	                    <label class="col-sm-5 control-label">หมายเลขเครื่องวัดอุณหภูมิ</label>
	                    <div class="col-sm-1 input-group">
	                        <input class="form-control" id="barcode_asset" name="barcode_asset"  required="">
	                    </div>
	                </div> -->
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

			<div id='show'></div>
			<br>
			<br>
		</div>
	</form>
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
						<table id="insertasset_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
							<thead>
								<tr style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef;">
									<th style="max-width:30px; width: 30px">รหัสร้าน</th>
									<th style="max-width:50px; width: 50px">ชื่อร้าน</th>
									<th style="max-width:50px; width: 50px">ประเภทอุปกรณ์</th>
									<th style="max-width:50px; width: 50px">ชื่อย่ออุปกรณ์</th>
									<th style="max-width:50px; width: 50px">หมายเลขบาร์โค๊ดอุปกรณ์</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($data_table > 0) {
									foreach ($data_table as $r) {
										echo "<tr id='".$r['id']."'>";
										echo "<td style='max-width:30px; width: 30px'>{$r['store_id']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['store_name']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['type']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['asset_shortname']}</td>";
										echo "<td style='max-width:50px; width: 50px'>{$r['asset_barcode']}</td>";
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

