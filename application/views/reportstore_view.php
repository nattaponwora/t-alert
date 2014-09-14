<script>
  $(function() {
  	var str = '<?=$storename?>';
    var availableTags = str.split(',');
    $( '#search_storeasset' ).autocomplete({
      source: availableTags
    });
  });
</script>
 

<script type="text/javascript">
    $(function() {
        $( "#begindate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            dateFormat: ('yy-mm-dd'),
            onClose: function( selectedDate ) {
                $( "#lastdate" ).datepicker( "option", "minDate", selectedDate );
            },
            monthNamesShort: [ "ม.ค.", "ก.พ.", "มี.ค", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." ]
        });
        $( "#lastdate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            dateFormat: ('yy-mm-dd'),
            onClose: function( selectedDate ) {
                $( "#begindate" ).datepicker( "option", "maxDate", selectedDate );
            },
            monthNamesShort: [ "ม.ค.", "ก.พ.", "มี.ค", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." ]
        });
        
        $("#export_pdf").on("click", function () { 	
			$.post("<?=base_url('reportstore/exporttopdf')?>",$('#table_form').serialize(),function(response){
	 			//$('#show').html(response);
			});
		}); 
	});
	
	$(document).ready(function () {
        $("#export_excel").click(function () {
            $("#table_export").btechco_excelexport({
                containerid: "table_export"
               , datatype: $datatype.Table
            });
        });
    });
        
	function load_assettype() {
		var search_valuelist = document['search_form']['search_assetlist'].value;

		var url = '<?= base_url("reportstore/load_statestype") ?>/' + search_valuelist;
		loadStates(url, 'assettypelist');
	}
</script>
<div class="container box" style="background-color: beige">
	<form name="search_form" id="search_form" class="form-inline" role="form" action="<?= base_url("reportstore/search") ?>" method="post">
		<label>วันที่</label>
		<?php if ( $begindate == null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="begindate" name="begindate" style="cursor: pointer" readonly="readonly" />
        <?php } if ( $begindate != null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="begindate" name="begindate"  style="cursor: pointer" readonly="readonly"  value="<?= $begindate ?>" />
        <?php } ?>
        <label>ถึง</label>
        <?php if ( $lastdate == null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="lastdate" name="lastdate"  style="cursor: pointer" readonly="readonly"  />
        <?php } if ( $lastdate != null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="lastdate" name="lastdate"  style="cursor: pointer" readonly="readonly"  value="<?= $lastdate ?>" />
       	<?php } ?>
		<div class="form-group" id ="select_assettype_d" name="select_assettype_d">
			<label class="control-label">รหัสร้าน</label>
			<div class="form-group">
				<?php if($searchTerm == null) { ?>
		  		<input class="form-control" id="search_storeasset" name="search_storeasset" type="text" />
		  		<?php } ?>
            	<?php if($searchTerm != null) { ?>
            	<input class="form-control" id="search_storeasset" name="search_storeasset" type="text" value="<?= $searchTerm ?>" />
            	<?php } ?>
			</div>
		</div>

		<button id="search" name="search" type="submit" class="btn btn-primary">
			Search
		</button>
	</form>
	<br>
</div>

<div class="row"></div>
	<div class="container box" style="background-color: beige">

		<form id="table_form" method="post">
			<table id="table_export" class="table table- -->hover table table-hover" border="0">
				<thead>
					<tr>
						<th style="width:100px">ลำดับที่</th>
						<th style="width:100px">รหัสสาขา</th>
						<th style="width:100px">ชื่อสาขา</th>
						<th style="width:100px">อุปกรณ์</th>
						<th style="width:100px">ชื่อย่ออุปกรณ์</th>
						<th style="width:100px">หมายเลขบาร์โค้ด</th>
						<th style="width:100px">อุณหภูมิเฉลี่ย</th>	
						<!-- <th style="width:100px">เวลา</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					if ($id > 0) {
						$i = 1;
						foreach ($id as $r) {
							echo "<tr>";
							echo "<td>{$i}</td>";
							echo "<td>{$r['store_id']}</td>";
							echo "<td>{$r['store_name']}</td>";
							echo "<td>{$r['type']}</td>";
                            echo "<td>{$r['asset_shortname']}</td>";
							echo "<td>{$r['asset_barcode']}</td>";
							$avg = round($r['temp'], 2);
							echo "<td>{$avg}</td>";
							$i++;
							echo "</tr>";
						}
					}
					?>
				</tbody>
			</table>
		</form>
		</ul>
	</div>
	
	<div class="form-inline" style="width: 25%;margin: 0px auto 0px auto">
		<br>
		<br>
		<form class="form-group" role="form">
			<button id="export_excel" class="button green medium" type="button" style="width: 100%;margin: 0px auto 0px auto">
				Export to Excel
			</button>
		</form>
		
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<form id="export_pdf" name="export_pdf" class="form-group" action= "<?= base_url('reportstore/exporttopdf') ?>" role="form" method="post">
			<?php if($searchTerm == null) { ?>
	  		<input class="form-control" id="search_storeasset" name="search_storeasset" type="hidden" />
	  		<?php } ?>
        	<?php if($searchTerm != null) { ?>
        	<input class="form-control" id="search_storeasset" name="search_storeasset" type="hidden" value="<?= $searchTerm ?>" />
        	<?php } ?>
        	<?php if ( $begindate == null ) { ?>
        	<input class="form-control mouse_hover" type="hidden" id="begindate" name="begindate" style="cursor: pointer" readonly="readonly" />
	        <?php } if ( $begindate != null ) { ?>
	        <input class="form-control mouse_hover" type="hidden" id="begindate" name="begindate"  style="cursor: pointer" readonly="readonly"  value="<?= $begindate ?>" />
	        <?php } ?>
	        <?php if ( $lastdate == null ) { ?>
	        <input class="form-control mouse_hover" type="hidden" id="lastdate" name="lastdate"  style="cursor: pointer" readonly="readonly"  />
	        <?php } if ( $lastdate != null ) { ?>
	        <input class="form-control mouse_hover" type="hidden" id="lastdate" name="lastdate"  style="cursor: pointer" readonly="readonly"  value="<?= $lastdate ?>" />
	       	<?php } ?>
			<button class="button orange medium" type="submit" style="width: 100%;margin: 0px auto 0px auto">
				Export to PDF
			</button>
		</form>
	</div>
</div>