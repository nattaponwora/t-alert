<div class="container-fluid">

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      	<h4 class="modal-title" id="myModalLabel">Insert Meter</h4>
      	
      </div>
      <div class="modal-body">
        <form class="form-signin registerForm" name="insert_form" id="insert_form" action= "<?= base_url("insertmeter/added") ?>" role="form" method="post">
		<br>
		<br>
		<div class="form-group">
			<label class="col-sm-5 control-label">หมายเลขเครื่องวัด</label>
			<div class="col-sm-4 input-group">
		  		<input class="form-control" id="search_meterid" name="search_meterid" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-5 control-label">รหัสร้าน</label>
			<div class="col-sm-4 input-group">
		  		<input class="form-control" id="search_storeasset" name="search_storeasset" onchange="load_asset('insert_form', 0, 0)" />
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
			<div class="col-sm-7 input-group" id ="assetlist">            
	            <?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype(\'insert_form\', 0, 0)'; ?>
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
					<button id="reset_btn" name="reset_btn" type="reset" class="button orange medium">
						Reset
					</button>
				</div>
			</div>
		</div>
			<br>
			<br>
			</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      	<h4 class="modal-title" id="myModalLabel">Edit Meter</h4>
      </div>
      <div class="modal-body">
        <form class="form-signin editForm" name="edit_form" id="edit_form" action= "<?= base_url("insertmeter/edit") ?>" role="form" method="post">
					<br>
					<br>
					<input class='hidden'  />
					<div class="form-group">
						<label class="col-sm-5 control-label">หมายเลขเครื่องวัด</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="edit_meterid" name="edit_meterid" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">รหัสร้าน</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="edit_storeasset" name="edit_storeasset" onchange="load_asset('edit_form', 0, 0)">
						</div>			
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ชื่อร้าน</label>
						<div class="col-sm-4 input-group" id="edit_storename_span_d">
					  		<input class="form-control" readonly='readonly' id="edit_store" name="edit_store" required="" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ประเภทอุปกรณ์</label>
						<div class="col-sm-7 input-group" id ="edit_assetlist2">            
				            <?php $js = 'id="edit_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype(\'edit_form\', 0, 0)"'; ?>
				            <?= form_dropdown('edit_assetlist', $selection, $search_asset, $js); ?>
				        </div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">ชื่อย่ออุปกรณ์</label>
						<div class="col-sm-2 input-group" id ="editassettypelist">
							<?php $js2 = 'id="edit_assettypelist" name="search_assettypelist" class="btn btn-default dropdown-toggle"'; ?>
				            <?= form_dropdown('edit_assettypelist', $selectiontype, $search_assettypelists, $js2); ?>
				        </div>
					</div>
					<br>
					
					<div class="row">
						<div class="form-group">
							<div class="col-m-4 col-xs-offset-4">
								<button id="update_btn" name="update_btn" type="submit" class="button green medium">
									Update
								</button>
							</div>
						</div>
					</div>
				</div>
			<br>
			<br>
			</form>
      </div>
    </div>
  </div>

<div class="row">
	<div class="box col-sm-8 col-sm-push-2" style="background-color: beige;">
		<form class="form-signin" id="table_form"  action="<?= base_url("insertmeter/added") ?>" role="form" method="post">
			<div class="table-responsive">
				<table id="insertmeter_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
					<thead>
						<tr class="centert" style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef; white-space: nowrap">
							<th style="max-width:300px; width: 30px">หมายเลขเครื่องวัด</th>
							<th style="max-width:300px; width: 30px">รหัสร้าน</th>
							<th style="max-width:500px; width: 50px">ชื่อร้าน</th>
							<th style="max-width:500px; width: 50px">ประเภทอุปกรณ์</th>
							<th style="max-width:500px; width: 50px">ชื่อย่ออุปกรณ์</th>
							<th style="max-width:500px; width: 50px; display: <?= $user_id_edit ?>">แก้ไข</th>
							<th style="max-width:500px; width: 50px; display: <?= $user_id_edit ?>">SMS</th>
							<th style="max-width:500px; width: 50px; display: <?= $user_id_edit ?>">ลบ</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						if ($data_table > 0) {
							$i=0;
							foreach ($data_table as $r) {
								$r['id'] = $r['meter_id'];
								echo "<tr name='different_add' barcode_data='" . $r['asset_barcode'] . "' style='white-space: nowrap' id='" . $r['id'] . "'>";
								echo "<td align='center' class='editable' type='meter_id' style='max-width:300px; width: 30px'>{$r['meter_id']}</td>";
								echo "<td type='store_id' class='store_id' style='max-width:300px; width: 30px' use_it='". $r['asset_typeid'] . "'>{$r['store_id']}</td>";
								echo "<td type='store_name' class='store_name' style='max-width:500px; width: 50px'>{$r['store_name']}</td>";
								echo "<td align='center' type='type' class='type' style='max-width:50px; width: 500px' >{$r['type']}</td>";
								echo "<td type='asset_shortname' class='asset_shortname' style='max-width:500px; width: 50px'>{$r['asset_shortname']}</td>";
								echo "<td align='center' style='display : ". $user_id_edit ."'><a class='mouse_hover edit_icon' data-toggle='modal' data-target='#modal_edit' > <img src='public/images/setting.png'></a></td>";
								
								if($r['get_sms'] == 1) {
									echo "<td style='vertical-align: middle; display : ". $user_id_edit ."' align='center' ><input class='trick_sms' value='1' type='checkbox' checked /></td>";
								} else if($r['get_sms'] == 0) {
									echo "<td style='vertical-align: middle; display : ". $user_id_edit ."' align='center' ><input class='trick_sms' value='0' type='checkbox' /></td>";
								}
								echo "<td align='center' style='display : ". $user_id_edit ."'>" . "<a class='mouse_hover remove_icon'><img src=" . base_url('public/images/remove.png') . "></td>";
								echo "</tr>";
								$i++;
							}
						}
						?>
					</tbody>
				</table>
				<div id='show'></div>
			</div>
		</form>
		<br>	
		<form id="add_form" name="add_form" action="<?= base_url("insertmeter/added") ?>" role="form" method="post" >
				<a id="add_icon" name="add_icon" style="display: <?= $user_id_edit ?>" class="col-xs-offset-10 mouse_hover" data-toggle="modal" data-target="#myModal" control='insert_form'> <img src='public/images/icon/add_icon.png' height='48px' width='48px'></a>				
		</form>
		<br>
	</div>
</div>

<div id="dialog-confirm" title="ยืนยันการลบ" style="font: white">
	<p>คุณต้องการจะลบข้อมูลใช่หรือไม่</p>
</div>

</div>
<script>
	var dialogr = 0;
	var temp_meterid = "";
	var temp_storeid = "";
	var temp_shortname = "";
	
	$(function() {
		
		$('input').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});

		$('.registerForm').bootstrapValidator({
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            search_meterid: {
	                message: 'The username is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'meter id is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'meter id can only consist of numberic'
	                    }
	                }
	            },
	            search_storeasset: {
	                validators: {
	                    notEmpty: {
	                        message: 'store id is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'store id can only consist of numberic'
	                    }
	                }
	            }
	        }
	    });
	    
	    $('.editForm').bootstrapValidator({
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            edit_meterid: {
	                message: 'The username is not valid',
	                validators: {
	                    notEmpty: {
	                        message: 'meter id is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'meter id can only consist of numberic'
	                    }
	                }
	            },
	            edit_storeasset: {
	                validators: {
	                    notEmpty: {
	                        message: 'store id is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'store id can only consist of numberic'
	                    }
	                }
	            },
	            search_meterid: {
	            	validators: {
	            		different: {
	                        field: 'different_add',
	                        message: 'The password cannot be the same as username'
	                    }
	            	}
	            }
	        }
	    });
		var select = document.getElementById("search_assetlist");
		var option = document.createElement('option');
        option.text = option.value = "โปรดเลือก";
        select.add(option, 0);
		
		$( "#dialog-confirm" ).dialog({
			resizable: false,
		    modal: true,
		    
		    autoOpen: false,
		   	buttons: {
		        "ใช่": function() {
		        	$.get("<?=base_url('insertmeter/remove')?>/" + dialogr,$('#table_form').serialize(),function(response){});
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
			
		$(".edit_icon").on("click", function () {
			var store_id = $(this).parent().parent().children().eq(1).text();
			$("#edit_meterid").val($(this).parent().parent().children().eq(0).text());
			
			$("#edit_storeasset").val($(this).parent().parent().children().eq(1).text());
			var barcode = $(this).parent().parent().attr('barcode_data');
			var type_id = $(this).parent().parent().children().eq(1).attr('use_it');
			load_asset('edit_form', type_id, barcode);			
			load_assettype('edit_form', type_id, barcode)
			
			temp_meterid = $(this).parent().parent().children().eq(0).text();
			temp_storeid = store_id;
			temp_shortname = $(this).parent().parent().children().eq(4).text();
			var assettype = $(this).parent().parent().children().eq(3).text();
			var element_row = $(this).parent().parent().attr("id");
			var element_col = $(this).parent().parent().children().eq(0).attr("type");
			
			checkpoint_id = element_row;
			checkpoint_type = element_col;
			
			$('#edit_form').append("<input type='hidden' id='temp1' name='id'  value='"  + element_row + "' />");
			$('#edit_form').append("<input type='hidden' id='temp2' name='type'  value='"  + element_col + "' />");
		});
		
		$("#search").on("click", function () {
			//alert("IN");
			var check_duc = false;	
			var meterid_echeck = $("#search_meterid").val();
			var storeid_echeck = $("#search_storeasset").val();
			var shortname = $("#search_assettypelist option:selected").text();
			if(temp_meterid == meterid_echeck && temp_storeid == storeid_echeck && temp_shortname ==  shortname) {}
			else {
				$('#insertmeter_table tbody tr').each(function() {
					var meter_check = $(this).children().eq(0).text();
					var storeid_check = $(this).children().eq(1).text();
					var shortname_check = $(this).children().eq(4).text();
					
					if(meterid_echeck == meter_check && meterid_echeck != temp_meterid ) {
						alert("ไม่สามารถใส่หมายเลขเครื่องวัดซ้ำได้");
						check_duc = true;
						return false;
					} 
					
					else if(storeid_echeck == storeid_check && meter_check == meterid_echeck) {
						if(shortname == shortname_check) {
							alert("ไม่สามารถใส่หรหัสร้านซ้ำได้");
							check_duc = true;
							return false;
						}
					}
					
					else if(storeid_echeck == storeid_check && shortname == shortname_check ) {
						alert("ไม่สามารถใส่อุปกรณ์ซ้ำได้");
						check_duc = true;
						return false;
					}
				});
			}
			
			if(check_duc == true) {
				return false;
			}
			
			$('#insert_form').append("<input type='hidden' id='temp3' name='asset_shortname'  value='"  + shortname + "' />");
		});
		
		$("#update_btn").on("click", function () {
			var check_duc = false;
			var meterid_echeck = $("#edit_meterid").val();
			var storeid_echeck = $("#edit_storeasset").val();
			var shortname = $("#edit_assettypelist option:selected").text();
			if(temp_meterid == meterid_echeck && temp_storeid == storeid_echeck && temp_shortname ==  shortname) {}
			else {
				$('#insertmeter_table tbody tr').each(function() {
					var meter_check = $(this).children().eq(0).text();
					var storeid_check = $(this).children().eq(1).text();
					var shortname_check = $(this).children().eq(4).text();
					
					if(meterid_echeck == meter_check && meterid_echeck != temp_meterid ) {
						check_duc = true;
						return false;
					} 
					else {
						if(storeid_echeck == storeid_check && meter_check == meterid_echeck) {
							if(shortname == shortname_check) {
								alert("ค่าไม่สามารถซ้ำกันได้");
								check_duc = true;
								return false;
							}
						}
					}
				});
			}
			
			if(check_duc == true) {
				return false;
			}
			
			$('#edit_form').append("<input type='hidden' id='temp3' name='asset_shortname'  value='"  + shortname + "' />");
		});
		
		$(".remove_icon").on("click", function () {
			var newcontent = $(this).parent().parent().children().eq(0).text();
			$(this).parent().parent().addClass("removetr");
			if(newcontent != 0) {
				dialogr = newcontent;
				$("#dialog-confirm").dialog( "open" );
			}
		});
			
		$(".iCheck-helper").on("click", function() {
			
			var meter_id = $(this).parent().parent().parent().attr('id');
			var trick = $(this).parent().hasClass("checked");;
						
			if(trick == true ) trick = 1;
			else trick = 0;
			
			$.ajax({
		        type: "GET",
		        data:  {},
		        url: "insertmeter/sms",
		        success: function () {
		            $.get("<?=base_url('insertmeter/sms')?>/" + trick + "/" + meter_id,$('#table_form').serialize(),function(response){});
		        }              
		    });
		});	
			
		$("#reset_btn").on("click", function () {
			$(".registerForm").data('bootstrapValidator').resetForm();
		});	
			
		$('#insertmeter_table').dataTable();
	});

    
    function load_asset(changevar, type_id, barcode) {
    	if(changevar == 'insert_form') {
    		var search_value = document['insert_form']['search_storeasset'].value; 
    		dd_data_area = 'assetlist';
    		name_data_area = 'search_storename_span_d';
    		
    	}else if(changevar == 'edit_form'){
    		var search_value = document['edit_form']['edit_storeasset'].value;
    		dd_data_area = 'edit_assetlist';
    		name_data_area = 'edit_storename_span_d';
    	}
    	
    	//alert(type_id);
    	var url = '<?= base_url("insertmeter/load_states") ?>/' + search_value + '/' + changevar + '/' + type_id;
    	loadStates(url, dd_data_area); 
    	
    	var url = '<?= base_url("insertmeter/get_storename") ?>/' + search_value + '/' + changevar;
    	loadStates(url, name_data_area); 
    	load_assettype(changevar, type_id, barcode);
    }
    
    function load_assettype(changevar, type_id, barcode) {
    	
    	if(changevar == 'insert_form') {
			var search_value = $('#search_storeasset').val(); 
			var search_valuelist = $('#search_assetlist').val();
			var assettypelist = 'assettypelist';
			var url = '<?= base_url("insertmeter/load_statestype") ?>/' + search_value + '/' + search_valuelist + '/' + changevar + '/' + 0; 
		}
		else if(changevar == 'edit_form') {
			var search_value = $('#edit_storeasset').val(); 
			var search_valuelist = $('#edit_assetlist').val();
			var assettypelist = 'editassettypelist';
			if(type_id != 0) var url = '<?= base_url("insertmeter/load_statestype") ?>/' + search_value + '/' + type_id + '/' + changevar + '/' + barcode; 
			else var url = '<?= base_url("insertmeter/load_statestype") ?>/' + search_value + '/' + search_valuelist + '/' + changevar + '/' + barcode; 

		}
		//alert(type_id);
        
        loadStates(url, assettypelist);      
    }
</script>

