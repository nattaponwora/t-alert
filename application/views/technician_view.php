<script>
var dialogr = 0;
$(function () {
	var checkpoint_id = null;
	var checkpoint_type = null;
	var checkpoint_value = null;
	
	$( "#dialog-confirm" ).dialog({
		resizable: false,
	    modal: true,
	    
	    autoOpen: false,
	   	buttons: {
	        "ใช่": function() {
	        	// alert(dialogr);
	        	$.get("<?=base_url('technician/remove')?>/" + dialogr,$('#table_form').serialize(),function(response){});
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
	
	$("#add_icon").on("click", function () { 	
		var new_row = "<tr id='edition' class='finding'>"+
					  "<td class='cellEditing' type='team' style='max-width:30px; width:30px'><input id='team_input' name='team_input' type='text' /></td>" +
					  "<td class='cellEditing' type='supervisor_name' style='max-width:30px; width:30px'><input id='supervisor_name_input' name='supervisor_name_input' type='text' /></td>" +
					  "<td class='cellEditing' type='tel' style='max-width:30px; width:30px'><input id='tel_input' name='tel_input' type='text' /></td>" +
					  "<td align='center'>" + "<a class='mouse_hover remove_icon'><img src='public/images/remove.png'></td>" +
					  "</tr>";
		
		
		$('#teachnical_table').append(new_row);		
		$('#add_icon').hide();
		$('#add_form').append("<img class='col-xs-offset-9 mouse_hover' id='add_btntech' name='add_btntech' src='public/images/icon/save_icon.png' height='32px' width='32px' />");
		$('#add_form').append("<img class='col-xs-offset-1 mouse_hover' id='cancel_btn' name='cancel_btn' src='public/images/icon/cancel_icon.png' height='32px' width='32px' />");				
		$("#add_btntech").on("click", function () {
			$.post("<?=base_url('technician/addval')?>",$('#table_form').serialize(),function(response){
				$('.finding').attr('id', response);
				$('#' + response).removeAttr('class');
			});
			
			var textbox = $("#edition").find('td');
			for(i=0; i<textbox.length-1; i++) {
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
			
			remove_btn();
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
	
	$(".conan").on("click", function () {
		if($(this).parent().parent().parent().children().eq(0).hasClass( "editable" ))
			{				
			if(checkpoint_id != null) {
				var old_id = "#" + checkpoint_id;
				var old = $( old_id + " td[type='" + checkpoint_type + "']" );
				$("#table_form input").remove();
				$("#ok").remove();
				$(old).html( checkpoint_value );
				$(old).removeClass('cellEditing');
				$(old).addClass("editable"); 
				$(old).addClass("conan")
			}
			$(this).parent().parent().parent().children().eq(0).removeClass("editable");
			var element_row = $(this).parent().parent().parent().children().eq(0).parent().attr("id");
			var element_col = $(this).parent().parent().parent().children().eq(0).attr("type");
			checkpoint_id = element_row;
			checkpoint_type = element_col;
			$('#table_form').append("<input type='hidden' id='temp1' name='id'  value='"  + element_row + "' />");
			$('#table_form').append("<input type='hidden' id='temp2' name='type'  value='"  + element_col + "' />");
			var OriginalContent = $(this).parent().parent().parent().children().eq(0).text();
			checkpoint_value = OriginalContent;
			
			$(this).parent().parent().parent().children().eq(0).addClass("cellEditing"); 
			$(this).parent().parent().parent().children().eq(0).html("<input id='editvar' name='editvar' type='text' value='" + OriginalContent + "' />"); 			
			$(this).parent().parent().parent().children().eq(0).append("&nbsp&nbsp<input type='image' class='margin_center_okay' id='ok_mobile' name='ok_mobile' src='public/images/icon/ok_icon.png' height='24px' width='24px' /> &nbsp");
			$(this).append("<input type='image' class='margin_center_no_okay' id='cancel_mobile' name='cancel_mobile' src='public/images/icon/cancel_icon.png' height='24px' width='24px' />");
			
			$(this).parent().parent().parent().children().eq(0).children().first().focus(); 
			$("#ok_mobile").on("click", function(){
				$.post("<?=base_url('technician/insert')?>",$('#table_form').serialize(),function(response){
					$('#show').html(response);
				});
				var textbox = $(this).parent().parent().parent().children().eq(0).parent().find('input').eq(0);
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
			
			$("#cancel_mobile").on("click", function(){
				$('#temp1').remove();
				$('#temp2').remove();
				$(this).parent().parent().parent().children().eq(0).parent().removeClass();
				$(this).parent().parent().parent().children().eq(0).parent().addClass("editable"); 
				$(this).parent().parent().parent().children().eq(0).parent().text(checkpoint_value);
				
				checkpoint_id = null;
				checkpoint_type = null;
				checkpoint_value = null;
			});
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
		remove_btn();
		$('#teachnical_table').dataTable();
	});
});

function remove_btn() {
	$(".remove_icon").on("click", function () {
		var newcontent = $(this).parent().parent().attr('id');
		$(this).parent().parent().addClass("removetr");
		if(newcontent != 0) {
			dialogr = newcontent;
			$("#dialog-confirm").dialog( "open" );
		}
	});
}
</script>
<div class="container-fluid">
<div id="dialog-confirm" title="ยืนยันการลบ" style="font: white">
	<p>คุณต้องการจะลบข้อมูลใช่หรือไม่</p>
</div>

<div class="row">
	<div class="box col-sm-6 col-sm-push-3" style="background-color: beige">
		<div class="form-group">
			<form id="table_form" name="table_form" method="post">
				<div class="table-responsive">
					<table id="teachnical_table" class="table table-striped table-bordered table-hover editableTable" cellspacing="0" border="0">
						<thead>
							<tr class="centert" style="font-weight: bold;background-color: #acf;border-bottom: 1px solid #cef; white-space: nowrap">
								<th class='text-overflow' style="max-width:300px; width: 30px; vertical-align: middle;">ทีม<br/>(<font color="green">Editable</font>)</th>
								<th class='text-overflow' style="max-width:500px; width: 50px; vertical-align: middle;">หัวหน้าแผนก<br/>(<font color="green">Editable</font>)</th>
								<th class='text-overflow' style="max-width:500px; width: 50px; vertical-align: middle;">เบอร์โทร<br/>(<font color="green">Editable</font>)</th>
								<th class='text-overflow' style="max-width:500px; width: 50px; vertical-align: middle; display: <?= $user_id_edit ?>">ลบ</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($id > 0) {
								foreach ($id as $r) {
									echo "<tr style='white-space: nowrap' id='".$r['id']."'>";
									echo "<td class='editable text-overflow edit ". $user_id_edit ."' type='team' style='max-width:300px; width: 30px'>{$r['team']}</td>";
									// "<a class='mouse_hover mobile_platform'><img class='conan' width='16px' height='16px' src=" . base_url('public/images/setting.png') . "></td>";
									echo "<td class='editable text-overflow ". $user_id_edit ."' type='supervisor_name' style='max-width:500px; width: 50px'>{$r['supervisor_name']}</td>";
									// "<a class='mouse_hover mobile_platform'><img class='conan' width='16px' height='16px' src=" . base_url('public/images/setting.png') . "></td>";
									echo "<td class='editable text-overflow ". $user_id_edit ."' type='tel' style='max-width:500px; width: 50px'>{$r['tel']}</td>";
									// "<a class='mouse_hover mobile_platform'><img class='conan' width='16px' height='16px' src=" . base_url('public/images/setting.png') . "></td>";
									echo "<td align='center' style='display : ". $user_id_edit ."'>" . "<a class='mouse_hover remove_icon'><img src=" . base_url('public/images/remove.png') . "></td>";
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
				<a id="add_icon" name="add_icon" style="display: <?= $user_id_edit ?>" class="col-xs-offset-10 mouse_hover"> <img src='public/images/icon/add_icon.png' height='48px' width='48px'></a>				
			</form>
		</div>
	</div>
</div>

</div>