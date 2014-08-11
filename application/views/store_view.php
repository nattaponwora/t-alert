<script>
$(function () {
	$("td").dblclick(function () { 
		var element_row = $(this).parent().attr("id");
		var element_col = $(this).attr("type");
		
		$('#table_form').append("<input type='hidden' id='temp1' name='id'  value='"  + element_row + "' />");
		$('#table_form').append("<input type='hidden' id='temp2' name='type'  value='"  + element_col + "' />");
		
		var OriginalContent = $(this).text();
		
		$(this).addClass("cellEditing"); 
		$(this).html("<input id='editvar' name='editvar' type='text' value='" + OriginalContent + "' />"); 
		$(this).children().first().focus(); 
		$(this).children().first().keypress(function (e) { 
			if (e.which == 13) { 
				var newContent = $(this).val();
				$.post("<?=base_url('technician/insert')?>",$('#table_form').serialize(),function(response){
					$('#show').html(response);
				});
				$('#temp1').remove();
				$('#temp2').remove();
				$(this).parent().removeClass();
				$(this).parent().text(newContent);
			}
		}); 
		$(this).children().first().blur(function() { 
			$(this).parent().removeClass();
			$(this).parent().text(OriginalContent);
		});
	}); 
});
</script>

<div class="box" style="background-color: beige	; margin-top: 60px; width: 60%">
        <form id="table_form" method="post">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" border="0">
            	<caption style="font-size: 50px">Store</caption>
                <thead>
                    <tr>
                    	<th style="max-width:30px; width:30px">เขต</th>
                        <th style="max-width:30px; width:30px">รหัสร้าน</th>
                        <th style="max-width:30px; width:30px">ชื้อร้าน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($id > 0) {
                        foreach ($id as $r) {
                            echo "<tr>";
							echo "<td style='max-width:30px; width:30px'>{$r['opt_team']}</td>";
                            echo "<td style='max-width:30px; width:30px'>{$r['store_id']}</td>";
                            echo "<td style='max-width:30px; width:30px'>{$r['store_name']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </form>
</ul>
</div>