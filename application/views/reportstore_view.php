<script> var ar = []</script>
<div class="container-fluid">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 850px; overflow: auto" >
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      	<h4 class="modal-title" id="myModalLabel">Show graph</h4>
      	
      </div>
      <div class="modal-body">
      	
        <form class="registerForm" name="insert_form" id="insert_form" action= "<?= base_url("insertmeter/added") ?>" role="form" method="post">
        	<?php 
        	$i=0;
			if($g_show != null) {
	        	foreach($g_show as $r) {
	        		$ar = $r;
					echo 
					"<script>
		        		ar[".$i."] = " . json_encode($ar ) . ";
		        	</script>";
					$i++;
				}
			}
			?>
	    	
			<div id="container" style="min-width: 600px; height: 400px; margin: 0 auto"></div>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="container box" style="background-color: beige">
	<form name="search_form" id="search_form" class="form-inline registerForm" role="form" action="<?= base_url("reportstore/search") ?>" method="post">
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
		<button id="search" name="search" type="submit" class="button blue small">
			Search
		</button>
		<a id="show_graph" name="show_graph" class="mouse_hover form-control" data-toggle="modal" data-target="#myModal"  ><i class="fa fa-bar-chart active fa-2x"></i></a>	
	</form>
	<br>
</div>

<div class="row">
	<div class="box container" style="background-color: beige">
		<form id="table_form" method="post">
			<div class='table-responsive'>
			<table id="table_export" class="table table table-hover table-bordered" border="0">
				<thead>
					<tr style="white-space: nowrap">
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
							echo "<tr style='white-space: nowrap'>";
							echo "<td>{$i}</td>";
							echo "<td>{$r['store_id']}</td>";
							echo "<td>{$r['store_name']}</td>";
							echo "<td>{$r['type']}</td>";
                            echo "<td>{$r['asset_shortname']}</td>";
                           	$str = $r['asset_barcode'];
							echo "<td>".$str."</td>";
							$avg = round($r['temp'], 2);
							echo "<td>{$avg}</td>";
							$i++;
							echo "</tr>";
						}
					}
					?>
				</tbody>
			</table>
			</div>
		</form>
	</div>
	<br>
	<br>
	
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
		<button class="button orange medium col-sm-push-5" type="submit">Export to PDF</button>
	</form>
</div>
</div>
<script>
	$(function() {
	  	// var str = '<?=$storename?>';
	    // var availableTags = str.split(',');
	    // $( '#search_storeasset' ).autocomplete({
	      // source: availableTags
	    // });
// 	    
	    
	    $( "#begindate" ).datepicker({
	        defaultDate: "w",
	        changeMonth: true,
	        changeYear: true,
	        dateFormat: ('yy-mm-dd'),
	        onClose: function( selectedDate ) {
	            $( "#lastdate" ).datepicker( "option", "minDate", selectedDate );
	        },
	        monthNamesShort: [ "ม.ค.", "ก.พ.", "มี.ค", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." ]
	    });
	    $( "#lastdate" ).datepicker({
	        defaultDate: "w",
	        changeMonth: true,
	        changeYear: true,
	        dateFormat: ('yy-mm-dd'),
	        onClose: function( selectedDate ) {
	            $( "#begindate" ).datepicker( "option", "maxDate", selectedDate );
	        },
	        monthNamesShort: [ "ม.ค.", "ก.พ.", "มี.ค", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." ]
	    });
	    
	    $("#export_pdf").on("click", function () { 	
			$.post("<?=base_url('reportstore/exporttopdf')?>",$('#table_form').serialize(),function(response){});
		}); 
	});
	
	
	$.fn.dataTable.TableTools.defaults.aButtons = [ "xls" ];
	
	$(document).ready(function () {
		$('#table_export').DataTable({
	    	dom: 'T<"clear">lfrtip',
	    	"oTableTools": {
            	"sSwfPath" : "../public/dataTables-1.10.2/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
			}
	    });
	    
		$('#container').highcharts({
	        chart: {
	            type: 'spline'
	        },
	        title: {
	            text: 'กราฟอุณหภูมิเฉลี่ยของแต่ละอุปกรณ์'
	        },
	        xAxis: {
	            type: 'datetime',
	            dateTimeLabelFormats: { // don't display the dummy year
	                month: '%e. %b',
	                year: '%b'
	            },
	            title: {
	                text: 'วัน'
	            }
	        },
	        yAxis: {
	            title: {
	                text: 'อุณหภูมิเฉลี่ย'
	            },
	            min: 0
	        },
	        tooltip: {
	            headerFormat: '<b>{series.name}</b><br>',
	            pointFormat: '{point.x:%e. %b}: {point.y:.2f} องศาเซียเซียล'
	        }
	    });
	    	    
	    var options = {
	        chart: {
	            renderTo: 'container',
	            type: 'spline'
	        },
	        xAxis: {
	            type: 'datetime',
	            dateTimeLabelFormats: { // don't display the dummy year
	                month: '%e. %b',
	            },
	            title: {
	                text: 'Date'
	            }
	    	},
	        title: {
	       		text: "Graph average temperature"
	        },
	        yAxis: {
	            title: {
	                text: 'Temperature'
	            }
	        }
	    };
	    
	    var chart = new Highcharts.Chart(options);
	    
	    for(var i=0; i< ar.length; i++) {    	
	    	var useable = new Array();
	     	for(var c=0; c< 12; c++) {
	     		for(var d=0; d<31; d++) {
	     			//alert(ar);
		    		if(c < 10) {
		    			c = "0" + c;
		    		}
					if(d < 10) {
		    			d = "0" + d;
		    		}
		    		
		    		if(ar[i][c] != null) {
		    			if(ar[i][c][d] != null) {
			   				useable.push([Date.UTC(2557,  c-1, d),ar[i][c][d]]);
						}
					}
				}
			}
			chart.addSeries ({
				name: ar[i][-1],
				data: useable
			});
		}
	    // alert(tes.split(','));
	    //}
	    		
		$('.registerForm').bootstrapValidator({
	        message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            search_storeasset: {
	                validators: {
	                    notEmpty: {
	                        message: 'Store id is required and cannot be empty'
	                    },
	                    regexp: {
	                        regexp: /^[0-9]+$/,
	                        message: 'Store id can only consist of numberic'
	                    },
	                    stringLength: {
	                        min: 5,
	                        max: 5,
	                        message: 'Store id must be 5 digits'
	                    }
	                }
	            }
	        },
	    });
    }); 
        
	function load_assettype() {
		var search_valuelist = document['search_form']['search_assetlist'].value;

		var url = '<?= base_url("reportstore/load_statestype") ?>/' + search_valuelist;
		loadStates(url, 'assettypelist');
	}
</script>