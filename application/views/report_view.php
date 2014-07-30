<script>
        $(function() {
            $( "#begindate" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                changeYear: true,
                numberOfMonths: 1,
                dateFormat: ('yy-mm-dd'),
                onClose: function( selectedDate ) {
                    $( "#lastdate" ).datepicker( "option", "minDate", selectedDate );
                }
            });
            $( "#lastdate" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                changeYear: true,
                numberOfMonths: 1,
                dateFormat: ('yy-mm-dd'),
                onClose: function( selectedDate ) {
                    $( "#begindate" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
        });
</script>

<div class="container box">
	<script type="text/javascript">
	function load_asset() {
		var search_value = document['search_form']['search_storeasset'].value;
		var url = '<?= base_url("report/load_states") ?>/' + search_value;
		loadStates(url, 'assetlist');
		load_assettype();
	}

	function load_assettype() {
		var search_value = document['search_form']['search_storeasset'].value;
		var search_valuelist = document['search_form']['search_assetlist'].value;

		var url = '<?= base_url("report/load_statestype") ?>/' + search_value + '/' + search_valuelist;
		loadStates(url, 'assettypelist');
	}
	</script>

	<form name="search_form" id="search_form" class="form-inline" role="form" action="<?= base_url("report/search") ?>" method="post">
		<label>วันที่</label>
		<?php if ( $begindate == null ) { ?>
        	<input class="form-control" type="text" id="begindate" name="begindate" />
        <?php } if ( $begindate != null ) { ?>
        	<input class="form-control" type="text" id="begindate" name="begindate" value=" <?= $begindate ?>" />
        <?php } ?>
        <label>ถึง</label>
        <?php if ( $lastdate == null ) { ?>
        	<input class="form-control" type="text" id="lastdate" name="lastdate" />
        <?php } if ( $lastdate != null ) { ?>
        	<input class="form-control" type="text" id="lastdate" name="lastdate" value=" <?= $lastdate ?>" />
       	<?php } ?>
		 <br>
		 <br>
		<label>รหัสร้าน</label>
		<div class="form-group">
			<?php $js = 'id="search_storeasset" name="search_storeasset" class="btn btn-default dropdown-toggle" onchange="load_asset()"'; ?>
			<?= form_dropdown('search_storeasset', $search_store, $searchTerm, $js); ?>
		</div>

		<label>อุปกรณ์</label>
		<div class="form-group" id ="assetlist" name="assetlist">
			<?php $js = 'id="search_assetlist" name="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"'; ?>
			<?= form_dropdown('search_assetlist', $selection, $search_asset, $js); ?>
		</div>

		<label>หมายเลขอุปกรณ์</label>
		<div class="form-group" id ="assettypelist" name="assettypelist">
			<?php $js2 = 'id="search_assettypelist" name="search_assettypelist" class="btn btn-default dropdown-toggle"'; ?>
			<?= form_dropdown('search_assettypelist', $selectiontype, $search_assettypelists, $js2); ?>
		</div>

		<button id="search" name="search" type="submit" class="btn btn-primary">
			Search
		</button>
	</form>
	<br>
</div>
<div class="row"></div>
	<div class="container box" >

		<form id="table_form" method="post">
			<table class="table table- -->hover table table-hover" border="0">
				<thead>
					<tr>
						<th style="width:100px">ลำดับที่</th>
						<th style="width:100px">รหัสสาขา</th>
						<th style="width:100px">ชื่อสาขา</th>
						<th style="width:100px">อุปกรณ์</th>
						<th style="width:100px">หมายเลขบาร์โค้ด</th>
						<th style="width:100px">อุณหภูมิ</th>
						<th style="width:100px">ชื่อย่ออุปกรณ์</th>					
						<th style="width:100px">เวลา</th>
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
							echo "<td>{$r['asset_barcode']}</td>";
							echo "<td>{$r['temp']}</td>";
							echo "<td>{$r['asset_shortname']}</td>";
							echo "<td>{$r['time']}</td>";
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
		<form id="export_excel" name="export_excel" class="form-group" role="form">
			<button class="btn btn-success btn-block" type="button" style="width: 100%;margin: 0px auto 0px auto">
				Export to Excel
			</button>
		</form>
		
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<form id="export_pdf" name="export_pdf" class="form-group" action= "<?= base_url('report/exportpdf') ?>" role="form">
			<button class="btn btn-danger" type="button" style="width: 100%;margin: 0px auto 0px auto" onclick="">
				Export to PDF
			</button>
		</form>
	</div>
</div>