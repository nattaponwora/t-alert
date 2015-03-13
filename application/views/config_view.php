<div class="container-fluid">
	<form id="table_form" role="form" method="post">
		<div class="row">
			<div class="box col-sm-push-3 col-sm-6 col-xs-12" style="background-color: beige">
				<br>
				<br>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-4 control-label">เปิดข้อความทั้งหมด</label>
					<div class="col-sm-4 input-group">
						<?php
				  		if($check_all == 1) {
							echo "<td style='vertical-align: middle' align='center' ><input class='trick_sms' value='1' type='checkbox' checked /></td>";
						} else if($check_all == 0) {
							echo "<td style='vertical-align: middle' align='center' ><input class='trick_sms' value='0' type='checkbox' /></td>";
						}?>
					</div>
				</div>
				<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
					<label class="col-sm-4 control-label">เครดิต</label>
					<div class="col-sm-4 input-group">
						<label class="col-sm-4 control-label"><?= $credit_remain ?></label>
					</div>
				</div>
				<br>
		  	</div>	
		</div>
	</form>	
</div>

<script>
	$(function() {
		
		$('input').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});
		
		$(".iCheck-helper").on("click", function() {
			
			var id = $(this).parent().hasClass("checked");
			if(id == true) id = 1;
			else id = 0;

			$.ajax({
		        type: "GET",
		        data:  {},
		        url: "config/sms/" + id,
		        success: function () {
		            $.get("<?=base_url('config/sms')?>" + "/" + id, $('#table_form').serialize(),function(response){});
		        }              
		    });
		});
	});
	
		
</script>