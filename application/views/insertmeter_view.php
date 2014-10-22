<script>
	$(function() {
		var select = document.getElementById("search_assetlist");
		var option = document.createElement('option');
        option.text = option.value = "โปรดเลือก";
        select.add(option, 0);
        
		var checkpoint_id = null;
		var checkpoint_type = null;
		var checkpoint_value = null;
		$(".editableTable").on("dblclick", ".editable", function () {
			if($(this).hasClass( "editable" ))
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
				//$(this).append("<img id='ok' src='public/images/icon/ok_icon.png' height='32px' width='32px'/>");
				$(this).append("&nbsp&nbsp<input type='image' class='margin_center_okay' id='ok' name='ok' src='public/images/icon/ok_icon.png' height='24px' width='24px' /> &nbsp");
				$(this).append("<input type='image' class='margin_center_no_okay' id='cancel' name='cancel' src='public/images/icon/cancel_icon.png' height='24px' width='24px' />");
				
				$(this).children().first().focus(); 
				$("#ok").on("click", function(){
					$.post("<?=base_url('insertmeter/insert')?>",$('#table_form').serialize(),function(response){
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
		
		$(".edit_icon").on("click", function () {
			$("#edit_meterid").val($(this).parent().parent().children().eq(0).text());
			$("#edit_storeasset").val($(this).parent().parent().children().eq(1).text());
			var type_id = $(this).parent().parent().children().eq(1).attr('use_it');
			load_asset('edit_form', type_id);			
			var assettype = $(this).parent().parent().children().eq(3).text();
		});
	
		$('#insertmeter_table').dataTable();
	});

    
    function load_asset(changevar, type_id) {
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
    	load_assettype(changevar, type_id);
    }
    
    function load_assettype(changevar, type_id) {
    	if(changevar == 'insert_form') {
			var search_value = $('#search_storeasset').val(); 
			var search_valuelist = $('#search_assetlist').val();
			var assettypelist = 'assettypelist';
		}
		else if(changevar == 'edit_form') {
			var search_value = $('#edit_storeasset').val(); 
			var search_valuelist = type_id;//$('#edit_assetlist').val();
			var assettypelist = 'editassettypelist';
		}
		
        var url = '<?= base_url("insertmeter/load_statestype") ?>/' + search_value + '/' + search_valuelist + '/' + changevar ; 
        loadStates(url, assettypelist);      
    }
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      	<h4 class="modal-title" id="myModalLabel">Insert Meter</h4>
      </div>
      <div class="modal-body">
        <form class="form-signin" name="insert_form" id="insert_form" action= "<?= base_url("insertmeter/added") ?>" role="form" method="post">
					<br>
					<br>
					<div class="form-group">
						<label class="col-sm-5 control-label">หมายเลขเครื่องวัด</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="search_meterid" name="search_meterid" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">รหัสร้าน</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="search_storeasset" name="search_storeasset" required="" onchange="load_asset('insert_form', 0)" />
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
						<div class="col-sm-7 input-group" id ="assetlist">            
				            <?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype(\'insert_form\', 0)'; ?>
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
								<button id="search" name="search" type="reset" class="button orange medium">
									Reset
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
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      	<h4 class="modal-title" id="myModalLabel">Edit Meter</h4>
      </div>
      <div class="modal-body">
        <form class="form-signin" name="edit_form" id="edit_form" action= "<?= base_url("insertmeter/insert") ?>" role="form" method="post">
					<br>
					<br>
					<div class="form-group">
						<label class="col-sm-5 control-label">หมายเลขเครื่องวัด</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="edit_meterid" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 control-label">รหัสร้าน</label>
						<div class="col-sm-4 input-group">
					  		<input class="form-control" id="edit_storeasset" required="" onchange="load_asset('edit_form', 0)">
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
				            <?php $js = 'id="edit_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype(\'edit_form\', 0)"'; ?>
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
							<div class="col-xs-4 col-xs-offset-4">
								<button id="search" name="search" type="submit" class="button green medium">
									Update
								</button>
							</div
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

<div class="row">
	<div class="box col-sm-8 col-center-block" style="background-color: beige;">
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
							<th style="max-width:500px; width: 50px">แก้ไข</th>
							<th style="max-width:500px; width: 50px">ลบ</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($data_table > 0) {
							$i=0;
							foreach ($data_table as $r) {
								$r['id'] = $r['meter_id'];
								echo "<tr style='white-space: nowrap' id='" . $r['id'] . "'>";
								echo "<td align='center' class='editable' type='meter_id' style='max-width:300px; width: 30px'>{$r['meter_id']}</td>";
								echo "<td type='store_id' class='store_id' style='max-width:300px; width: 30px' use_it='". $r['asset_typeid'] . "'>{$r['store_id']}</td>";
								echo "<td type='store_name' class='store_name' style='max-width:500px; width: 50px'>{$r['store_name']}</td>";
								echo "<td align='center' type='type' class='type' style='max-width:50px; width: 500px' >{$r['type']}</td>";
								echo "<td type='asset_shortname' class='asset_shoername' style='max-width:500px; width: 50px'>{$r['asset_shortname']}</td>";
								echo "<td align='center'><a class='mouse_hover edit_icon' data-toggle='modal' data-target='#modal_edit' > <img src='public/images/setting.png'></a></td>";
								echo "<td align='center'>" . "<a href=" . base_url('#') . "><img src=" . base_url('public/images/remove.png') . "></td>";
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
				<a id="add_icon" name="add_icon" class="col-xs-offset-10 mouse_hover" data-toggle="modal" data-target="#myModal" control='insert_form'> <img src='public/images/icon/add_icon.png' height='48px' width='48px'></a>				
		</form>
		<br>
	</div>
</div>