<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Detection and Alertion</title>
    <?php
        echo link_tag( "public/bootstrap/css/bootstrap.css" , 'stylesheet');
    ?>
</head>
<body onload="ajaxFunction('fw')" ;="">
    
    <div class="navbar navbar-default navbar-fixed-top">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Home</a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Temperature</a></li>
      <li><a href="#">Insert Asset</a></li>
    </ul>
  </div>
</div>

    <script type="text/javascript" src="<?= base_url("public/bootstrap/js/jquery.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("public/bootstrap/js/bootstrap.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("public/bootstrap/js/jquery-dataTables.js") ?>"></script>
    <div class="container-fluid" style="padding-top: 50px">