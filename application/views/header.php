<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Temperature Detection and Alertion</title>
		<?php
		echo link_tag("public/bootstrap/css/bootstrap.css", 'stylesheet');
		echo link_tag("public/jquery/ui/1.11.1/jquery-ui.css", 'stylesheet');
		echo link_tag("public/jquery.dataTables.css", 'stylesheet');
		echo link_tag("public/css/style.css", 'stylesheet');
		echo link_tag("public/css/media-queries.css", "stylesheet");
		echo link_tag("http://fonts.googleapis.com/css?family=Lobster");
		?>
		<style>
			table, td, th {
				border: 1px solid black;
			}
			table {
				width: 100%;
			}

			th {
				height: 50px;
			}
		</style>
	</head>
	<body>
		<script type="text/javascript" src="<?= base_url("public/jquery/jquery-1.11.1.min.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/bootstrap/js/bootstrap.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/jquery/ui/1.11.1/jquery-ui.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/dynamic_dropdown.js") ?>"></script>

		<script type="text/javascript" src="<?= base_url("public/jquery.battatech.excelexport.js") ?>"></script>

		<script type="text/javascript" src="<?= base_url("public/dataTables.bootstrap.js") ?>"></script>
		<script type="text/javascript" src="<?= base_url("public/jquery.dataTables.min.js") ?>"></script>

