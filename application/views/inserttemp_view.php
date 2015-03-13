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
	        	$.get("<?=base_url('inserttemp/remove')?>/" + dialogr,$('#table_form').serialize(),function(response){});
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
		//alert($("#temp_table").children().children().eq(0).attr('temp_''));
		var new_row = "<tr style='white-space: nowrap' id='edition' role='row' class=''>"+
					  "<td class='cellEditing' type='type' style='max-width:30px; width:30px'><input id='type_input' name='type_input' type='text' style='height: 30px;'/></td>"+
					  "<td class='cellEditing' type='shortcode' style='max-width:30px; width:30px'><input id='shortcode_input' name='shortcode_input' type='text' style='height: 30px;'/></td>"+
					  "<td class='cellEditing' type='min_temp' style='max-width:30px; width:30px'><input id='min_temp_input' name='min_temp_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' type='max_temp' style='max-width:30px; width:30px'><input id='max_temp_input' name='max_temp_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' type='std_time' style='max-width:30px; width:30px'><input id='std_time_input' name='std_time_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' type='std_temp' style='max-width:30px; width:30px'><input id='std_temp_input' name='std_temp_input' type='text' style='height: 30px;' /></td>"+
					  "<td class='cellEditing' align='center'>" + "<a class='mouse_hover remove_icon'><img src='public/images/remove.png'></td>"+

					  "</tr>";
					  
		$('#temp_table').append(new_row);		
		$('#add_icon').hide();
		$('#add_form').append("<img class='col-xs-offset-9 mouse_hover' id='add_btn' name='add_btn' src='public/images/icon/save_icon.png' height='32px' width='32px' />");				
		$('#add_form').append("<img class='col-xs-offset-1 mouse_hover' id='cancel_btn' name='cancel_btn' src='public/images/icon/cancel_icon.png' height='32px' width='32px' />");				

		$("#add_btn").on("click", function () {
			$.post("<?=base_url('inserttemp/addval')?>",$('#table_form').serialize(),function(response){
				$('#show').html(response);
			});
			
			var textbox = $("#edition").find('td');
			for(i=0; i<textbox.length-1; i++) {
				var newContent = $(textbox[i]).children().val();
				$(textbox[i]).removeClass();
				if(i >= 2 ) {
					$(textbox[i]).addClass("editable"); 
				}
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
			$("#add_btn").remove();
			$("#cancel_btn").remove();
			$("#new_row").remove();
			$(tr).remove();
		});
	}); 
	
	// $(".remove_icon").on("click", function () {
		// var newcontent = $(this).parent().parent().attr('id');
		// $(this).parent().parent().addClass("removetr");
		// if(newcontent != 0) {
			// dialogr = newcontent;
			// $("#dialog-confirm").dialog( "open" );
		// }
	// });
	
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
		remove_btn();
		$('#temp_table').dataTable();
	});
});

function remove_btn() {
	$(".remove_icon").on("click", function () {
		var newcontent = $(this).parent().parent().children().eq(0).text();
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
	<div class="box col-sm-8 col-sm-push-2" style="background-color: beige">
		<div class="form-group">
		    <form  id="table_form" name="table_form" method="post">
		        <div class="table-responsive">
		            <table id="temp_table" class="table table-striped table-bordered table-hover editableTable" border="0">
		                <thead>
		                    <tr class='text-overflow centert' style="font-weight: bold; background-color: #acf; border-bottom: 1px solid #cef; white-space: nowrap">
		                        <th rowspan="2" style="text-align: center; vertical-align: middle;">ประเภทอุปกรณ์</th>
		                        <th rowspan="2" style="text-align: center; vertical-align: middle;">ชื่อย่ออุปกรณ์</th>
		                        <th colspan="2" style="text-align: center; vertical-align: middle;">อุณหภูมิมาตราฐาน(องศาเซลเซียส)<br/>(<font color="green">Editable</font>)</th>
		                        <th rowspan="2" style="text-align: center; vertical-align: middle;">เวลาสูงสุด(นาที)<br/>(<font color="green">Editable</font>)</th>
								<th rowspan="2" style="text-align: center; vertical-align: middle;">ค่ากลางเครื่องมีดเตอร์<br/>(<font color="green">Editable</font>)</th>
								<th rowspan="2" style="max-width:500px; width: 50px; vertical-align: middle; display: <?= $user_id_edit ?>">ลบ</th>
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
		                        	echo "<tr style='white-space: nowrap' id=".$r['id'].">";
		                            echo "<td type='type' style='max-width:30px;'>{$r['type']}</td>";
									echo "<td type='shortcode' style='max-width:30px; '>{$r['shortcode']}</td>";	
		                            echo "<td class='editable ". $user_id_edit ."' type='min_temp' style='max-width:30px;'>{$r['min_temp']}</td>";
		                            echo "<td class='editable ". $user_id_edit ."' type='max_temp' style='max-width:30px;'>{$r['max_temp']}</td>";
									echo "<td class='editable ". $user_id_edit ."' type='std_time' style='max-width:30px;'>{$r['std_time']}</td>";
									echo "<td class='editable ". $user_id_edit ."' type='std_temp' style='max-width:30px;'>{$r['std_temp']}</td>";
									echo "<td align='center' style='display : ". $user_id_edit ."'>" . "<a class='mouse_hover remove_icon'><img src=" . base_url('public/images/remove.png') . "></td>";
		                           
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
				<a id="add_icon" name="add_icon" style="display: <?= $user_id_edit ?>" class="col-xs-offset-10 mouse_hover"> <img src='public/images/icon/add_icon.png' height='48px' width='48px'></a>	
			</form>
			
		</div>
	</div>
</div>
</div>