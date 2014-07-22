<form name="insert_form" id="insert_form" role="form" method="post">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="box" >
				<br>
				<br>
				<div class="form-group">
					<label class="col-sm-5 control-label">ประเภทอุปกรณ์</label>
					<div class="col-sm-7 form-group">
						<?php $js = 'id="select_assettype" name="select_assettype" class="dropdown-toggle"'; ?>
            			<?= form_dropdown('select_assettype', $assettype, $js); ?>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="form-group">
					<label class="col-sm-5 control-label">อุณหภูมิมาตราฐาน</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="" />
						</p>
					</div>
					<label class="col-sm-1 control-label">ถึง</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="" />
						</p>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="form-group">
					<label class="col-sm-5 control-label">เวลาที่อุณหภูมิเกินได้สูงสุด</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="" />
						</p>
					</div>
					<label class="col-sm-1 control-label">ถึง</label>
					<div class="col-sm-2">
						<p>
							<input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="" />
						</p>

					</div>
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
				<br>
				<br>
			</div>
		</div>
	</div>
</form>