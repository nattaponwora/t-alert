<script>
	$(function() {
		var str = '<?=$storename?>';
		var availableTags = str.split(',');
		$( '#search_storeasset' ).autocomplete({
			source: availableTags
		});
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
 


<form class="form-signin" name="insert_form" id="insert_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="box" style="background-color: beige">
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
					<div class="col-sm-2 input-group" id="search_assetshortname_span_d">
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
				</div>
			</div>
		</div>
		<div id='show'></div>
		<br>
		<br>
	</div>
</form>