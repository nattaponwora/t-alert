<style>
	body {
		background-image: url("public/images/background.png");
	}
</style>
<br><br>
<div class="row">
<img class="col-sm-2 col-sm-push-5 col-xs-12" alt="Responsive image" src=<?= base_url('public/images/logo.png') ?> style="max-height: 20%;">
</div>
<br><br><br>
<div class="row">
<div class="boxshadow1 boxshadow2 col-sm-4 col-sm-push-4 col-xs-12">
	<form id="login_form" name="login_form" class="form-signin" action="<?= base_url('login/check') ?>" role="form" method="post">
		<center>
			<h2 class="form-signin-heading" style="color: white">Sign in</h2>
		</center>
		<div style="height: 5px;width: 20%; float: left; background-color: #d81b60"></div>
		<div style="height: 5px;width: 20%; float: left; background-color: #3f51b5"></div>
		<div style="height: 5px;width: 20%; float: left; background-color: #259b24"></div>
		<div style="height: 5px;width: 20%; float: left; background-color: #ff9800"></div>
		<div style="height: 5px;width: 20%; float: left; background-color: #e51c23"></div>
		<br>
		<br>
		<input id="username" name="username" type="username" class="form-control" style="width: 80%; margin: 0px auto 0px auto" placeholder="Username" required="" autofocus="">
		<br>
		<input id="password" name="password" type="password" class="form-control" style="width: 80%; margin: 0px auto 0px auto" placeholder="Password" required="">
		<br>
		<button class="button blue medium" type="submit" style="width: 30%;margin: 0px auto 0px auto">
			Login
		</button>
	</form>
	<br>
</div>
</div>
<!-- /container -->