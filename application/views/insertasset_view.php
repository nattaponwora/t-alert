<script>
	$(function() {
		var checkpoint_id = null;
		var checkpoint_type = null;
		var checkpoint_value = null;
		var str = '<?=$storename?>';
		var availableTags = str.split(',');
		$( '#search_storeasset' ).autocomplete({
			source: availableTags
		});
		
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
	}
	
	function change_storename(){
		var storename = document['insert_form']['search_storeid'].value;		
       	var url = '<?= base_url("insertasset/get_storename") ?>/' + storename; 
        loadStates(url, 'search_storename_span_d');  
	}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"  style="max-width: 500px; overflow: hidden" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel">Insert Asset</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
		<form class="form-signin" name="insert_form" id="insert_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
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
			<div class="col-sm-3 input-group" id="search_assetshortname_span_d">
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

			<div id='show'></div>
			<br>
			<br>
		</div>
	</form>
</div>
</div>
</div>
</div> 

<div class="row">
	<div class="container box" style="background-color: beige	">
		<form class="form-signin" id="table_form" action= "<?= base_url("insertasset/added") ?>" role="form" method="post">
			<div class="form-group">
				<div class="table-responsive">
					<table id="insertasset_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
						<thead>
							<tr style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef; ">
								<th style="max-width:300px; width: 30px; white-space: nowrap">รหัสร้าน</th>
								<th style="max-width:500px; width: 50px; white-space: nowrap">ชื่อร้าน</th>
								<th style="max-width:500px; width: 50px; white-space: nowrap">ประเภทอุปกรณ์</th>
								<th style="max-width:500px; width: 50px; white-space: nowrap">ชื่อย่ออุปกรณ์</th>
								<th style="max-width:500px; width: 50px; white-space: nowrap">หมายเลขบาร์โค๊ดอุปกรณ์</th>
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
									echo "<td class='editable' type='asset_shortname'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['asset_shortname']}</td>";
									echo "<td class='editable' type='asset_barcode'  style='max-width:500px; width: 50px; white-space: nowrap'>{$r['asset_barcode']}</td>";
									echo "</tr>";
									// $i++;
								}
							}
							?>
						</tbody>
					</table>
					<div id='show'></div>
				</div>
			</div>
		</form>
		<form id="add_form" name="add_form" method="post">
			<a id="add_icon" name="add_icon" class="col-xs-offset-10 mouse_hover" data-toggle="modal" data-target="#myModal"> <img src='public/images/icon/add_icon.png' height='48px' width='48px'></a>				
		</form>
		<br>
	</div>
</div>
