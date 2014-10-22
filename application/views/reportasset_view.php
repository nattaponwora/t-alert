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
        
        $('#table_export').dataTable();
    });

	$(document).ready(function () {
        $("#export_excel").click(function () {
            $("#table_export").btechco_excelexport({
                containerid: "asset report"
               , datatype: $datatype.Table
            });
        });
    });
        

	function load_assettype() {
		var search_valuelist = document['search_form']['search_assetlist'].value;

		var url = '<?= base_url("reportasset/load_statestype") ?>/' + search_valuelist;
		loadStates(url, 'assettypelist');
	}
</script>
<div class="container box" style="background-color: beige">
	<form name="search_form" id="search_form" class="form-inline" role="form" action="<?= base_url("reportasset/search") ?>" method="post">
		<label>วันที่</label>
		<?php if ( $begindate == null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="begindate" name="begindate" style="cursor: pointer" readonly="readonly" />
        <?php } if ( $begindate != null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="begindate" name="begindate" style="cursor: pointer" readonly="readonly" value="<?= $begindate ?>" />
        <?php } ?>
        <label>ถึง</label>
        <?php if ( $lastdate == null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="lastdate" name="lastdate" style="cursor: pointer" readonly="readonly" />
        <?php } if ( $lastdate != null ) { ?>
        	<input class="form-control mouse_hover" type="text" id="lastdate" name="lastdate" style="cursor: pointer" readonly="readonly" value="<?= $lastdate ?>" />
       	<?php } ?>
		<label>อุปกรณ์</label>
		<div class="form-group" id ="assetlist" name="assetlist">
			<?php $js2 = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"'; ?>
			<?= form_dropdown('search_assetlist', $selection, $search_asset, $js2); ?>
		</div>

		<button id="search" name="search" type="submit" class="button blue small">
			Search
		</button>
	</form>
	<br>
</div>

<div class="row"></div>
	<div class="container box" style="background-color: beige">
		<form id="table_form" method="post">
			<div class='table-responsive'>
			<table id="table_export" class="table table- -->hover table table-hover" border="0">
				<thead>
					<tr class='text-overflow'>
						<th style="width:100px; white-space: nowrap">ลำดับที่</th>
						<th style="width:100px; white-space: nowrap">รหัสสาขา</th>
						<th style="width:100px; white-space: nowrap">ชื่อสาขา</th>
						<th style="width:100px; white-space: nowrap">อุปกรณ์</th>
						<th style="width:100px; white-space: nowrap">หมายเลขบาร์โค้ด</th>
						<th style="width:100px; white-space: nowrap">อุณหภูมิเฉลี่ย</th>
						<th style="width:100px; white-space: nowrap">ชื่อย่ออุปกรณ์</th>					
					</tr>
				</thead>
				<tbody>
					<?php
					if ($id > 0) {
						$i = 1;
						foreach ($id as $r) {
							echo "<tr style='white-space: nowrap'>";
							echo "<td>{$i}</td>";
							echo "<td>{$r['store_id']}</td>";
							echo "<td>{$r['store_name']}</td>";
							echo "<td>{$r['type']}</td>";
							echo "<td>{$r['asset_barcode']}</td>";
							$avg = round($r['temp'], 2);
							echo "<td>{$avg}</td>";
							echo "<td>{$r['asset_shortname']}</td>";
							$i++;
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
	
	<div class="form-inline" style="width: 25%;margin: 0px auto 0px auto">
		<br>
		<br>
		<form class="form-group" role="form" >
			<button id="export_excel" class="button green medium" type="button">
				Export to Excel
			</button>
		</form>
		
		&nbsp&nbsp&nbsp
		<form id="export_pdf" name="export_pdf" class="form-group" action= "<?= base_url('reportasset/exporttopdf') ?>" role="form" method="post">
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
	       	<input class="form-control mouse_hover" type="hidden" id="set_search_asset" name="set_search_asset" value="<?= $search_asset ?>" />
			<button class="button orange medium" type="submit">
				Export to PDF
			</button>
		</form>
	</div>
</div>