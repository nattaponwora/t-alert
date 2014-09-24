<script>
$(function () {
	var checkpoint_id = null;
	var checkpoint_type = null;
	var checkpoint_value = null;
	
	$("#add_icon").on("click", function () { 	
		var new_row = "<tr id='edition'>"+
					  "<td class='cellEditing' type='type' style='max-width:30px; width:30px'><input id='type_input' name='type_input' type='text' style='height: 30px;'/></td>"+
					  "<td class='cellEditing' type='shortcode' style='max-width:30px; width:30px'><input id='shortcode_input' name='shortcode_input' type='text' style='height: 30px;'/></td>"+
					  "<td class='cellEditing' type='min_temp' style='max-width:30px; width:30px'><input id='min_temp_input' name='min_temp_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' type='max_temp' style='max-width:30px; width:30px'><input id='max_temp_input' name='max_temp_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' type='std_time' style='max-width:30px; width:30px'><input id='std_time_input' name='std_time_input' type='text' style='height: 30px;' /></td>"+
					  "</tr>";
					  
		$('#temp_table').append(new_row);		
		$('#add_icon').hide();
		$('#add_form').append("<img class='col-xs-offset-10 mouse_hover' id='add_btn' name='add_btn' src='public/images/icon/save_icon.png' height='32px' width='32px' />");				
		$('#add_form').append("<img class='col-xs-offset-1 mouse_hover' id='cancel_btn' name='cancel_btn' src='public/images/icon/cancel_icon.png' height='32px' width='32px' />");				

		$("#add_btn").on("click", function () {
			$.post("<?=base_url('inserttemp/addval')?>",$('#table_form').serialize(),function(response){
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
			$("#add_btn").remove();
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
			$("#add_btn").remove();
			$("#cancel_btn").remove();
			$("#new_row").remove();
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
			var element_row = $(this).parent().attr('id');
			var element_col = $(this).attr("type");
			checkpoint_id = element_row;
			checkpoint_type = element_col;
			$('#table_form').append("<input type='hidden' id='temp1' name='id'  value='"  + element_row + "' />");
			$('#table_form').append("<input type='hidden' id='temp2' name='type'  value='"  + element_col + "' />");
			
			var OriginalContent = $(this).text();
			checkpoint_value = OriginalContent;
			
			$(this).addClass("cellEditing"); 
			$(this).html("<input id='editvar' name='editvar' type='text' value='" + OriginalContent + "' />"); 			
			$(this).append("&nbsp&nbsp<input class='margin_center_okay' type='image' id='ok' name='ok' src='public/images/icon/ok_icon.png' height='24px' width='24px' /> &nbsp");
			$(this).append("<input class='margin_center_no_okay' type='image' id='cancel' name='cancel' src='public/images/icon/cancel_icon.png' height='24px' width='24px' />");
			
			$(this).children().first().focus(); 
			$("#ok").on("click", function(){
				$.post("<?=base_url('inserttemp/insert')?>",$('#table_form').serialize(),function(response){
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
		$('#temp_table').dataTable();
	});
});
</script>

<div class="box" style="background-color: beige	; margin-top: 60px; width: 60%">
	<div class="row">
		<div class="form-group">
		    <form  id="table_form" name="table_form" method="post">
		        <div class="table-responsive">
		            <table id="temp_table" class="table table-striped table-bordered table-hover editableTable" border="0">
		                <thead>
		                    <tr style="font-weight: bold; background-color: #acf; border-bottom: 1px solid #cef;">
		                        <th rowspan="2" style="text-align: center;">ประเภทอุปกรณ์</th>
		                        <th rowspan="2" style="text-align: center;">ชื่อย่ออุปกรณ์</th>
		                        <th colspan="2" style="text-align: center;">อุณหภูมิมาตราฐาน(องศาเซลเซียส)</th>
		                        <th rowspan="2" style="text-align: center;">เวลาสูงสุด(นาที)</th>
		                    </tr>
		                    <tr style="font-weight: bold; background-color: #acf; border-bottom: 1px solid #cef;">
		                    	<td style="text-align: center;">ต่ำสุด</td>
					            <td style="text-align: center;">สูงสูด</td>
        					</tr>
		                </thead>
		                <tbody>
		                    <?php
		                    if ($id > 0) {
		                    	$id_row = 0;
		                        foreach ($id as $r) {
		                        	echo "<tr id=".$r['id'].">";
		                            echo "<td class='editable' type='type' style='max-width:30px; width:30px'>{$r['type']}</td>";
									echo "<td class='editable' type='shortcode' style='max-width:30px; width:20px'>{$r['shortcode']}</td>";	
		                            echo "<td class='editable' type='min_temp' style='max-width:30px; width:30px'>{$r['min_temp']}</td>";
		                            echo "<td class='editable' type='max_temp' style='max-width:30px; width:30px'>{$r['max_temp']}</td>";
									echo "<td class='editable' type='std_time' style='max-width:30px; width:30px'>{$r['std_time']}</td>";
		                            echo "</tr>";
									$id_row++;
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