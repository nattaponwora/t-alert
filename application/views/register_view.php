<form class="form-signin" name="regis_form" id="regis_form" action= "<?= base_url("register/regis") ?>" role="form" method="post">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="box" style="background-color: beige">
				<br>
				<br>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-5 control-label">ชื่อผู้ใช้</label>
					<div class="col-sm-4 input-group">
				  		<input class="form-control" id="username" name="username" type="username">
					</div>
					
				</div>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-5 control-label">รหัสผ่าน</label>
					<div class="col-sm-4 input-group">
				  		<input class="form-control" id="password" name="password" type="password">
					</div>
				</div>
				<div class="form-group" id ="barcode_asset_d" name="barcode_asset_d">
                    <label class="col-sm-5 control-label">ยืนยันรหัสผ่าน</label>
                    <div class="col-sm-4 input-group">
                        <input class="form-control" id="repassword" name="repassword" type="password">
                    </div>
                </div>
                <div class="form-group" id ="barcode_asset_d" name="barcode_asset_d">
                    <label class="col-sm-5 control-label">Email</label>
                    <div class="col-sm-4 input-group">
                        <input class="form-control" id="email" name="email">
                    </div>
                </div>
				<br>
				<br>
				<br>
				
				<div class="row">
					<div class="form-group">
						<div class="col-xs-4 col-xs-offset-3">
							<button id="search" name="search" type="submit" class="btn btn-success btn-lg btn-block">
								Submit
							</button>
						</div>
						<div class="">
							<button id="search" name="search" type="reset" class="btn btn-danger btn-lg ">
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