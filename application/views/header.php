<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="public/images/Image001.ico">
		<title>Temperature Detection and Alertion</title>
		<?php
		echo link_tag("public/bootstrap/css/bootstrap.css", 'stylesheet');
		echo link_tag("public/bootstrap/css/bootstrapValidator.min.css", 'stylesheet');
		echo link_tag("public/jquery/ui/1.11.1/jquery-ui.css", 'stylesheet');
		echo link_tag("public/css/media-queries.css", "stylesheet");
		echo link_tag("public/dataTables-1.10.2/media/css/jquery.dataTables.css", 'stylesheet');
		echo link_tag("public/dataTables-1.10.2/media/css/dataTables.bootstrap.css", 'stylesheet');
		echo link_tag("public/dataTables-1.10.2/extensions/TableTools/css/dataTables.tableTools.css", 'stylesheet');	
		echo link_tag("public/nprogress/nprogress.css", 'stylesheet');
		echo link_tag("public/fontawesome/css/font-awesome.min.css", 'stylesheet');
		echo link_tag("public/icheck/skins/all.css", 'stylesheet');
		echo link_tag("public/css/style.css", 'stylesheet');
		?>
	</head>
	<body>
		
		<script type="text/javascript" src="<?= base_url("public/html5shiv.min.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/respond.min.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/jquery/jquery-1.11.1.min.js") ?>"></script>		
		<script type="text/javascript" src="<?= base_url("public/bootstrap/js/bootstrap.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/bootstrap/js/bootstrapValidator.min.js") ?>"></script>
		
		<script type="text/javascript" src="<?= base_url("public/jquery/ui/1.11.1/jquery-ui.js") ?>"></script>
		
		<script type="text/javascript" src="<?= base_url("public/dynamic_dropdown.js") ?>"></script>

		<script type="text/javascript" src="<?= base_url("public/jquery.battatech.excelexport.js") ?>"></script>

		<script type="text/javascript" src="<?= base_url("public/dataTables-1.10.2/media/js/jquery.dataTables.min.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/dataTables-1.10.2/extensions/TableTools/js/dataTables.tableTools.min.js") ?>"></script>
		
		
		<script type="text/javascript" src="<?= base_url("public/script.js") ?>"></script>
		
		<script type="text/javascript" src="<?= base_url("public/highcharts.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/nprogress/nprogress.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/icheck/icheck.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/exporting.js") ?>"></script>
				
		<script>
			$(window).load(function(){
			   NProgress.done();
			});
			
			$(document).ready(function() {
			   NProgress.start();
			});			
		</script>
					
		<!-- <script type="text/javascript" src="<?= base_url("public/dataTables.bootstrap.js") ?>"></script> -->
