<script>
$(function () {
	var checkpoint_id = null;
	var checkpoint_type = null;
	var checkpoint_value = null;
	
	$("#add_icon").on("click", function () { 	
		var new_row = "<tr id='edition'>"+
					  "<td class='cellEditing' type='team' style='max-width:30px; width:30px'><input id='team_input' name='team_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' type='supervisor_name' style='max-width:30px; width:30px'><input id='supervisor_name_input' name='supervisor_name_input' type='text' /></td>"+
					  "<td class='cellEditing' type='tel' style='max-width:30px; width:30px'><input id='tel_input' name='tel_input' type='text' /></td>"+
					  "</tr>";
					  
		$('#teachnical_table').append(new_row);		
		$('#add_icon').hide();
		$('#add_form').append("<img class='col-xs-offset-10 mouse_hover' id='add_btntech' name='add_btntech' src='public/images/icon/save_icon.png' height='32px' width='32px' />");
		$('#add_form').append("<img class='col-xs-offset-1 mouse_hover' id='cancel_btn' name='cancel_btn' src='public/images/icon/cancel_icon.png' height='32px' width='32px' />");				
		
		$("#add_btntech").on("click", function () {
			$.post("<?=base_url('technician/addval')?>",$('#table_form').serialize(),function(response){
 				$('#show').html(response);
			});
			
			var textbox = $("#edition").find('td');
			for(i=0; i<textbox.length; i++) {
				var newContent = $(textbox[i]).children().val();
				$(textbox[i]).removeClass();
				$(textbox[i]).addClass("editable"); 
				$(textbox[i]).text(newContent);				
				checkpoint_id = null;
				checkpoint_type = null;
				checkpoint_value = null;
			}
			
			var tr = $("#edition");
			$(tr).attr('id', $(textbox[0]).text());
			$('#add_icon').show();
			$("#add_btntech").remove();
			$("#cancel_btn").remove();
		});
		
		$("#cancel_btn").on("click", function () {
			var textbox = $("#edition").find('td');
			for(i=0; i<textbox.length; i++) {
				var newContent = $(textbox[i]).children().val();
				$(textbox[i]).removeClass();
				$(textbox[i]).addClass("editable"); 
				$(textbox[i]).text(newContent);				
				checkpoint_id = null;
				checkpoint_type = null;
				checkpoint_value = null;
			}
			
			var tr = $("#edition");
			$(tr).attr('id', $(textbox[0]).text());
			$('#add_icon').show();
			$("#add_btntech").remove();
			$("#cancel_btn").remove();
			$(tr).remove();
			
		});
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
			//$(this).append("<img id='ok' src='public/images/icon/ok_icon.png' height='32px' width='32px'/>");
			$(this).append("&nbsp&nbsp<input type='image' class='margin_center_okay' id='ok' name='ok' src='public/images/icon/ok_icon.png' height='24px' width='24px' /> &nbsp");
			$(this).append("<input type='image' class='margin_center_no_okay' id='cancel' name='cancel' src='public/images/icon/cancel_icon.png' height='24px' width='24px' />");
			
			$(this).children().first().focus(); 
			$("#ok").on("click", function(){
				$.post("<?=base_url('technician/insert')?>",$('#table_form').serialize(),function(response){
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
	
	$(function() {
		$('#teachnical_table').dataTable();
	});
});
</script>

<div class="box" style="background-color: beige	; margin-top: 60px; width: 70%">
	<div class="row">
		<div class="form-group">
			<form id="table_form" name="table_form" method="post">
				<div class="table-responsive">
					<table id="teachnical_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
						<thead>
							<tr style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef;">
								<th style="max-width:30px; width: 30px">ทีม</th>
								<th style="max-width:50px; width: 50px">หัวหน้าแผนก</th>
								<th style="max-width:50px; width: 50px">เบอร์โทร</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($id > 0) {
								foreach ($id as $r) {
									echo "<tr id='".$r['id']."'>";
									echo "<td class='editable' type='team' style='max-width:30px; width: 30px'>{$r['team']}</td>";
									echo "<td class='editable' type='supervisor_name' style='max-width:50px; width: 50px'>{$r['supervisor_name']}</td>";
									echo "<td class='editable' type='tel' style='max-width:50px; width: 50px'>{$r['tel']}</td>";
									// echo ("<td><a href=\"edit_form.php?id=$row[employees_number]\">Edit</a></td></tr>");
									//echo "<td><a href='".base_url('technician')."/".$count . "'>"."<img src='public/images/icon/edit_icon.png' height='32px' width='32px'></a></td>";
									echo "</tr>";
								}
							}
							?>
						</tbody>
					</table>
					<div id='show'></div>
				</div>
			</form>
			<br>
			<form id="add_form" name="add_form" method="post">
				<a id="add_icon" name="add_icon" class="col-xs-offset-11 mouse_hover"> <img src='public/images/icon/add_icon.png' height='32px' width='32px'></a>				
			</form>
		</div>
	</div>
</div>