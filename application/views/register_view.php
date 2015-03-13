<div class="container-fluid">
<form class="form-signin" name="regis_form" id="regis_form" action= "<?= base_url("register/regis") ?>" role="form" method="post">
	<div class="row">
		<div class="col-sm-6 col-sm-push-3 col-xs-12">
			<div class="box" style="background-color: beige">
				<br>
				<br>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-4 control-label">ชื่อผู้ใช้</label>
					<div class="col-sm-4 input-group">
				  		<input class="form-control" id="username" name="username" type="username" placeholder="Username" required="" />
					</div>
				</div>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-4 control-label">รหัสผ่าน</label>
					<div class="col-sm-4 input-group">
				  		<input class="form-control" id="password" name="password" type="password" placeholder="Password" required="" />
					</div>
				</div>
				<div class="form-group" id ="barcode_asset_d" name="barcode_asset_d">
                    <label class="col-sm-4 control-label">ยืนยันรหัสผ่าน</label>
                    <div class="col-sm-4 input-group">
                        <input class="form-control" id="repassword" name="repassword" type="password" placeholder="Confirm Password" required="" />
                    </div>
                </div>
                <div class="form-group" id ="barcode_asset_d" name="barcode_asset_d">
                    <label class="col-sm-4 control-label">อีเมล์</label>
                    <div class="col-sm-4 input-group">
                        <input class="form-control" id="email" name="email" placeholder="Email" required="" />
                    </div>
                </div>
				<div class="form-group" id ="barcode_asset_d" name="barcode_asset_d">
                    <label class="col-sm-4 control-label">ประเภท</label>
                    <div class="col-sm-4 input-group">
					    <?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()" img="public/images/loading.gif"'; ?>
	           		    <?= form_dropdown('search_assetlist', $user_group, 0, $js); ?>
                    </div>
                </div>
				<br>
			</div>
		</div>
	</div>
	<div class="form-inline row-centered ">
		<button id="search" name="search" type="submit" class="button green medium">
			Submit
		</button>

		<button type="reset" class="button orange medium">
			Reset
		</button>
	</div>
	
</form>
</div>

<script>
	$(function () {
		$('#regis_form').bootstrapValidator({
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            username: {
	                validators: {
	                    notEmpty: {
	                        message: 'Username is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[a-z0-9\s]+$/,
	                        message: 'Username can consist of numberic and character'
	                    },
	                    stringLength: {
	                        min: 4,
	                        max: 16,
	                        message: 'Username must be 4-16 digits'
	                    }
	                }
	            },
	            password: {
	            	validators: {
	            		notEmpty: {
	                        message: 'Password cannot be empty'
	                    }
	            	}
	            },	
	            repassword: {
                validators: {
                    identical: {
                        field: 'password',
                        	message: 'The password and its confirm are not the same'
                    	}
                	}
            	},
	            email: {
                validators: {
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }
	        },
	    });
	});
</script>