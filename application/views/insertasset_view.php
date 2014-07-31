<?php 
echo "
<script>
  $(function() {
  	var str = '".$storename."';
    var availableTags = str.split(',');
    $( '#search_storeasset' ).autocomplete({
      source: availableTags
    });
  });
</script>";
?>
 


<form name="insert_form" id="insert_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="box">
				<br>
				<br>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-5 control-label">รหัสร้าน</label>
					<div class="col-sm-4 form-group">
				  		<input class="form-control" id="search_storeasset" name="search_storeasset">
					</div>
					
				</div>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-5 control-label">ชื่อร้าน</label>
					<div class="col-sm-4 form-group">
				  		<input class="form-control" id="search_storeasset" name="search_storeasset">
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="form-group" id ="select_assettype_d" name="assetlist_d">
					<label class="col-sm-5 control-label">ชื่ออุปกรณ์</label>
					<div class="col-sm-7 form-group">
						<?php $js = 'id="select_assettype" name="select_assettype" class="btn btn-default dropdown-toggle"'; ?>
						<?= form_dropdown('select_assettype', $assettype, null, $js); ?>
					</div>
				</div>
				<div class="form-group" id ="barcode_asset_d" name="barcode_asset_d">
					<label class="col-sm-5 control-label">หมายเลขบาร์โค๊ดของอุปกรณ์</label>
					<div class="col-sm-7 form-group">
				  		<input class="form-control" id="barcode_asset" name="barcode_asset">
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="form-group">
					<label class="col-sm-5 control-label">อุณหภูมิมาตราฐาน</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="min_temp" name="min_temp" type="text" value="" />
						</p>
					</div>
					<label class="col-sm-1 control-label">ถึง</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="max_temp" name="max_temp" type="text" value="" />
						</p>
					</div>
					<label class="control-label">องศาเซลเซียส</label>
				</div>
				<br>
				<div class="form-group">
					<label class="col-sm-5 control-label">เวลาที่อุณหภูมิเกินได้สูงสุด</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="std_time" name="std_time" type="text" value="" />
						</p>
					</div>
					<label class="control-label">นาที</label>
				</div>
				<br>
				<br>
				<br>

				<div class="row">
					<div class="form-group">
						<div class="col-xs-4 col-xs-offset-3">
							<button id="search" name="search" type="submit" class="btn btn-success btn-lg btn-block">
								Insert
							</button>
						</div>
						<div class="">
							<button id="search" name="search" type="submit" class="btn btn-danger btn-lg ">
								Reset
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<br>
	</div>
</form>