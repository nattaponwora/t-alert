<script>
	var dialogr = 0;
	var temp_meterid = "";
	var temp_storeid = "";
	var temp_shortname = "";
	
	$(function() {
		// $("#search").on("click", function () {
			// //alert("IN");
			// var check_duc = false;	
			// var meterid_echeck = $("#search_meterid").val();
			// var storeid_echeck = $("#search_storeasset").val();
			// var shortname = $("#search_assettypelist option:selected").text();
			// if(temp_meterid == meterid_echeck && temp_storeid == storeid_echeck && temp_shortname ==  shortname) {}
			// else {
				// $('#insertmeter_table tbody tr').each(function() {
					// var meter_check = $(this).children().eq(0).text();
					// var storeid_check = $(this).children().eq(1).text();
					// var shortname_check = $(this).children().eq(4).text();
// 					
					// if(meterid_echeck == meter_check && meterid_echeck != temp_meterid ) {
						// alert("ไม่สามารถใส่หมายเลขเครื่องวัดซ้ำได้");
						// check_duc = true;
						// return false;
					// } 
// 					
					// else if(storeid_echeck == storeid_check && meter_check == meterid_echeck) {
						// if(shortname == shortname_check) {
							// alert("ไม่สามารถใส่หรหัสร้านซ้ำได้");
							// check_duc = true;
							// return false;
						// }
					// }
// 					
					// else if(storeid_echeck == storeid_check && shortname == shortname_check ) {
						// alert("ไม่สามารถใส่อุปกรณ์ซ้ำได้");
						// check_duc = true;
						// return false;
					// }
				// });
			// }
// 			
			// if(check_duc == true) {
				// return false;
			// }
// 			
			// $('#insert_form').append("<input type='hidden' id='temp3' name='asset_shortname'  value='"  + shortname + "' />");
		// });
		
		$('.registerForm').bootstrapValidator({
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            search_storeid: {
	                validators: {
	                    notEmpty: {
	                        message: 'Store id is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'Store id can only consist of numberic and character'
	                    },
	                    stringLength: {
	                        min: 5,
	                        max: 5,
	                        message: 'Store id must be 5 digits'
	                    }
	                }
	            },
	            
	            barcode_asset: {
	            	validators: {
	                    notEmpty: {
	                        message: 'Barcode is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'Barcode can only consist of numberic'
	                    }
	                }
	            },
	            
	            search_assettype: {
                    validators: {
                        0: {
                            message: 'The type of asset is required'
                        }
                    }
                }
	        }
	    });
		
		var checkpoint_id = null;
		var checkpoint_type = null;
		var checkpoint_value = null;
		var str = '<?=$storename?>';
		var availableTags = str.split(',');
		$( '#search_storeasset' ).autocomplete({
			source: availableTags
		});
		
		$( "#dialog-confirm" ).dialog({
			resizable: false,
		    modal: true,
		    
		    autoOpen: false,
		   	buttons: {
		        "ใช่": function() {
		        	// alert(dialogr);
		        	$.get("<?=base_url('insertasset/remove')?>/" + dialogr,$('#table_form').serialize(),function(response){});
		        	$(".removetr").remove();
		        	$(this).dialog( "close" );
		        	
		        },
		        "ไม่ใช่": function() {
		         	$(this).dialog( "close" );
		        }
			},
			close: function( event, ui ) {
		        $(".removetr").removeClass("removetr");
		    }
	    });
	    
		$(".remove_icon").on("click", function () {
			var newcontent = $(this).parent().parent().attr('id');
			$(this).parent().parent().addClass("removetr");
			if(newcontent != 0) {
				dialogr = newcontent;
				$("#dialog-confirm").dialog( "open" );
				
			}
		});
		
		
		$(".editableTable").on("dblclick", ".editable", function () {
			if($(this).hasClass( "editable" ) && (!$(this).hasClass( "none" )))
			{
				if(checkpoint_id != null) {
					var old_id = "#" + checkpoint_id;
					var old = $( old_id + " td[type='" + checkpoint_type + "']" );
					$("#table_form input").remove();
					$("#ok").remove();
					$(old).html( checkpoint_value );
					$(old).removeClass('cellEditing');
					$(old).addClass("editable"); 
				}
				$(this).removeClass("editable");
				var element_row = $(this).parent().attr("id");
				var element_col = $(this).attr("type");
				checkpoint_id = element_row;
				checkpoint_type = element_col;
				$('#table_form').append("<input type='hidden' id='temp1' name='id'  value='"  + element_row + "' />");
				$('#table_form').append("<input type='hidden' id='temp2' name='type'  value='"  + element_col + "' />");
				
				var OriginalContent = $(this).text();
				checkpoint_value = OriginalContent;
				
				$(this).addClass("cellEditing"); 
				$(this).html("<input id='editvar' name='editvar' type='text' value='" + OriginalContent + "' />"); 			
				$(this).append("&nbsp&nbsp<input type='image' class='margin_center_okay' id='ok' name='ok' src='public/images/icon/ok_icon.png' height='24px' width='24px' /> &nbsp");
				$(this).append("<input type='image' class='margin_center_no_okay' id='cancel' name='cancel' src='public/images/icon/cancel_icon.png' height='24px' width='24px' />");
				
				$(this).children().first().focus(); 
				$("#ok").on("click", function(){
					$.post("<?=base_url('insertasset/insert')?>",$('#table_form').serialize(),function(response){
						$('#show').html(response);
					});
					var textbox = $(this).parent().find('input').eq(0);
					var newContent = $(textbox).val();
					$('#temp1').remove();
					$('#temp2').remove();
					$(textbox).parent().removeClass();
					$(textbox).parent().addClass("editable"); 
					$(textbox).parent().text(newContent);
					checkpoint_id = null;
					checkpoint_type = null;
					checkpoint_value = null;
				});
				
				$("#cancel").on("click", function(){
					$('#temp1').remove();
					$('#temp2').remove();
					$(this).parent().removeClass();
					$(this).parent().addClass("editable"); 
					$(this).parent().text(checkpoint_value);
					
					checkpoint_id = null;
					checkpoint_type = null;
					checkpoint_value = null;
				});
			}
		}); 
		
		$('#insertasset_table').dataTable();
	});
	
	function change_shortname(){
		var assettype = document['insert_form']['search_assettype'].value;		      	
       	var url = '<?= base_url("insertasset/get_shortname") ?>/' + assettype; 
        loadStates(url, 'search_assetshortname_span_d');  
        
        var assettype = document['insert_form']['search_assettype'].value;		      	
       	var url = '<?= base_url("insertasset/get_standardtemp") ?>/' + assettype; 
        loadStates(url, 'search_std_temp_span_d');  
	}
	
	function change_storename(){
		var storename = document['insert_form']['search_storeid'].value;		
       	var url = '<?= base_url("insertasset/get_storename") ?>/' + storename; 
        loadStates(url, 'search_storename_span_d');  
	}
</script>
<div class="container-fluid">
<div id="dialog-confirm" title="ยืนยันการลบ" style="font: white">
	<p>คุณต้องการจะลบข้อมูลใช่หรือไม่</p>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel">Insert Asset</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
		<form class="form-signin registerForm" name="insert_form" id="insert_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
		<br>
		<br>
		<div class="form-group">
			<label class="col-sm-5 control-label">รหัสร้าน</label>
			<div class="col-sm-4 input-group">
		  		<input class="form-control" id="search_storeid" name="search_storeid" onchange="change_storename()" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-5 control-label">ชื่อร้าน</label>
			<div class="col-sm-4 input-group" id="search_storename_span_d">
		  		<input class="form-control" readonly='readonly' id="search_store" name="search_store" />
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
			<label class="col-sm-5 control-label">ค่าความคาดเคลื่อน</label>
			<div class="col-sm-3 input-group" id="search_std_temp_span_d">
				<span class="input-group-addon" id="std_temp"></span>
				<input type="hidden" name="hidden_search_std_temp_span" value ="">
				<input class="form-control" type="text" id="search_adjust_value" name="search_adjust_value" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-5 control-label">ชื่อย่ออุปกรณ์</label>
			<div class="col-sm-3 input-group" id="search_assetshortname_span_d">
				<span class="input-group-addon" id="shortname"></span>
				<input type="hidden" name="hidden_search_assetshortname_span" value ="">
				<input class="form-control" type="text" id="search_assetshortname" name="search_assetshortname" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-5 control-label">หมายเลขบาร์โค๊ดอุปกรณ์</label>
            <div class="col-sm-4 input-group">
                <input class="form-control" id="barcode_asset" name="barcode_asset" />
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
					<button type="reset" class="button orange medium">
						Reset
					</button>
				</div>
			</div>
			<br>
			<br>
		</div>
	</form>
	</div>
</div>
</div>
</div> 

<div class="row">
	<div class="col-sm-9 box col-sm-push-2" style="background-color: beige	">
		<form class="form-signin" id="table_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
			<div class="form-group">
				<div class="table-responsive">
					<table id="insertasset_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
						<thead>
							<tr class="centert" style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef;">
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle;">รหัสร้าน</th>
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle;">ชื่อร้าน</th>
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle;">ประเภทอุปกรณ์</th>
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle;">ชื่อย่ออุปกรณ์<br/>(<font color="green">Editable</font>)</th>
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle;">หมายเลขบาร์โค๊ดอุปกรณ์<br/>(<font color="green">Editable</font>)</th>
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle;">ค่าความคาดเคลื่อน<br/>(<font color="green">Editable</font>)</th>
								<th style="max-width:300px; width: 30px; white-space: nowrap; vertical-align: middle; display: <?= $user_id_edit ?>">ลบ</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($data_table > 0) {
								foreach ($data_table as $r) {
									// $r['id'] = $i;
									echo "<tr id='".$r['id']."'>";
									echo "<td type='store_id'  style='max-width:300px; width: 30px; white-space: nowrap'>{$r['store_id']}</td>";
									echo "<td class='text-overflow' type='store_name'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['store_name']}</td>";
									echo "<td type='type'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['type']}</td>";
									echo "<td class='editable ". $user_id_edit ."' type='asset_shortname'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['asset_shortname']}</td>";
									echo "<td class='editable ". $user_id_edit ."' type='asset_barcode'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['asset_barcode']}</td>";
									echo "<td class='editable ". $user_id_edit ."' type='adjust_value'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['adjust_value']}</td>";
									echo "<td align='center' style='display : ". $user_id_edit ."'>" . "<a class='mouse_hover remove_icon'><img src=" . base_url('public/images/remove.png') . "></td>";
									echo "</tr>";
									// $i++;
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
		<form id="add_form" name="add_form" method="post">
			<a id="add_icon" name="add_icon" style="display: <?= $user_id_edit ?>" class="col-xs-offset-10 mouse_hover" data-toggle="modal" data-target="#myModal"> <img src='public/images/icon/add_icon.png' height='48px' width='48px'></a>				
		</form>
		<br>
	</div>
</div>
</div>