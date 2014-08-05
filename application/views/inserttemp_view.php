<form name="insert_form" id="insert_form" action= "<?= base_url("inserttemp/added") ?>" role="form" method="post">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="box" style="background-color: beige">
				<br>
				<br>
				<div class="form-group" id ="select_assettype_d" name="assetlist_d">
					<label class="col-sm-5 control-label">ประเภทอุปกรณ์</label>
					<div class="col-sm-7 form-group">
						<?php $js = 'id="select_assettype" name="select_assettype" class="btn btn-default dropdown-toggle"'; ?>
						<?= form_dropdown('select_assettype', $assettype, null, $js); ?>
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