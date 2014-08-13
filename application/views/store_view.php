<script>
$(function () {
	var checkpoint_id = null;
	var checkpoint_type = null;
	var checkpoint_value = null;
	$(".editable").dblclick(function () { 		
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
			//$(this).append("<img id='ok' src='public/images/icon/ok_icon.png' height='32px' width='32px'/>");
			$(this).append("&nbsp&nbsp<input type='image' id='ok' name='ok' src='public/images/icon/ok_icon.png' height='24px' width='24px' /> &nbsp");
			$(this).append("<input type='image' id='cancel' name='cancel' src='public/images/icon/cancel_icon.png' height='24px' width='24px' />");
			
			$(this).children().first().focus(); 
			$("#ok").on("click", function(){
				$.post("<?=base_url('store/insert')?>",$('#table_form').serialize(),function(response){
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
});
</script>

<div class="box" style="background-color: beige	; margin-top: 60px; width: 60%">
        <form id="table_form" name="table_form" method="post">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover editableTable" border="0">
            	<caption style="font-size: 50px">Store</caption>
                <thead>
                    <tr>
                        <th style="max-width:30px; width:30px">รหัสร้าน</th>
                        <th style="max-width:30px; width:30px">ชื้อร้าน</th>
                        <th style="max-width:30px; width:30px">เขต</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($id > 0) {
                    	$id_row = 0;
                        foreach ($id as $r) {
                            echo "<tr id=".$r['store_id'].">";
                            echo "<td type='store_id' style='max-width:30px; width:30px'>{$r['store_id']}</td>";
                            echo "<td class='editable' type='store_name' style='max-width:30px; width:30px'>{$r['store_name']}</td>";
                            echo "<td class='editable' type='opt_team' style='max-width:30px; width:30px'>{$r['opt_team']}</td>";
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
</div>