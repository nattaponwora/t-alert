<style>
	body {
		background-image: url("<?= base_url('public/images/backgroundall.png') ?>" );
	}
</style>

<?php $session_page = $this->session->userdata('session_page'); ?>
<div class="navbar navbar-default ">
	<div class="container">
		<div class="navbar-header">
			<a href="<?= base_url("index") ?>" class="navbar-brand"><img src=<?= base_url('public/images/logo.png') ?> style="margin-top: -15px;" height="50"></a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        </button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li class="<?= (($session_page == 'temp') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("temp") ?>">Search</a>
				</li>
				<li class="<?= (($session_page == 'criticaltemp') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("criticaltemp") ?>">Critical Temperature</a>
				</li>
				<li class="<?= (($session_page == 'inserttemp') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("inserttemp") ?>">Insert Temperature</a>
				</li>
				<li class="<?= (($session_page == 'insertasset') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("insertasset") ?>">Insert Asset</a>
				</li>
				<li class="<?= (($session_page == 'technician') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("technician") ?>">Technician</a>
				</li>
				<li class="<?= (($session_page == 'store') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("store") ?>">Store</a>
				</li>
				<li class="<?= (($session_page == 'register') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("register") ?>">Register</a>
				</li>
				
				<li class="dropdown <?= (($session_page == 'reportstore' || ($session_page == 'reportasset') ) ?  'active' : 'last'); ?>">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
		        	<ul class="dropdown-menu">
			          	<li class="<?= (($session_page == 'reportasset') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("reportasset") ?>">Report Asset</a>
						</li>
			          	<li class="<?= (($session_page == 'reportstore') ?  'active' : 'last'); ?>">
			          		<a href="<?= base_url("reportstore") ?>">Report Store</a>
			       		</li>
		        	</ul>
		      	</li>
			</ul>
		
			<form name="logout_form" id="logout_form" class="form-inline" role="form" action="<?= base_url("login/logout") ?>" method="post">
				<ul class="nav navbar-nav navbar-right">
					<?php  $cookie = get_cookie('username_cookie'); ?>
					<li><label style="color: #FFFFFF; margin-top: 15px">สวัสดี &nbsp; <?= $cookie ?> &nbsp;</label></li>
					<li>
						<button name="logout_btn" id="logout_btn" type="submit" class="btn btn-danger" style="margin-top: 5px" >
							Logout
						</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>