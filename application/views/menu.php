<style>
	body {
		background-image: url("<?= base_url('public/images/backgroundall.png') ?>" );
	}
	define(['pace'], function(pace){
  pace.start({
    document: false
  });
});
</style>

<?php $session_page = $this->session->userdata('session_page'); ?>

<div class="navbar navbar-inverse" style="border-radius: 0px; border: 0px;">
	<div class="container">
		<div class="navbar-header">
			<img style="" height="50" src=<?= base_url('public/images/logo.png') ?> /> 
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        </button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav purple">
				<li class="<?= (($session_page == 'temp') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("temp") ?>">ตรวจสอบอุณหภูมิ</a>
				</li>
				<li class="<?= (($session_page == 'criticaltemp') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("criticaltemp") ?>">รายการอุปกรณ์ที่ผิดปกติ</a>
				</li>
				
				<!-- <li class="<?= (($session_page == 'register') ?  'active' : 'last'); ?>">
					<a href="<?= base_url("register") ?>">Register</a>
				</li> -->
				<li class="dropdown <?= (($session_page == 'inserttemp' || ($session_page == 'insertasset') || ($session_page == 'technician' || ($session_page == 'store')) ) ?  'active' : 'last'); ?>">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">แก้ไขข้อมูล<b class="caret"></b></a>
		        	<ul class="dropdown-menu">
						<li class="<?= (($session_page == 'insertasset') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("insertasset") ?>">เพิ่มอุปกรณ์</a>
						</li>
						<li class="<?= (($session_page == 'insertmeter') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("insertmeter") ?>">อุปกรณ์ตรวจจับอุณหภูมิ</a>
						</li>
						<li class="<?= (($session_page == 'inserttemp') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("inserttemp") ?>">ตั้งค่าช่วงมาตรฐาน</a>
						</li>
						<li class="<?= (($session_page == 'technician') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("technician") ?>">เบอร์โทรศัพท์ทีมช่าง</a>
						</li>
						<li class="<?= (($session_page == 'store') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("store") ?>">สาขา 7-11</a>
						</li>
			        </ul>
			 	</li>
			 	
				<li class="dropdown <?= (($session_page == 'reportstore' || ($session_page == 'reportasset') ) ?  'active' : 'last'); ?>">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงาน<b class="caret"></b></a>
		        	<ul class="dropdown-menu">
			          	<li class="<?= (($session_page == 'reportasset') ?  'active' : 'last'); ?>">
							<a href="<?= base_url("reportasset") ?>">รายงานเฉพาะอุปกรณ์</a>
						</li>
			          	<li class="<?= (($session_page == 'reportstore') ?  'active' : 'last'); ?>">
			          		<a href="<?= base_url("reportstore") ?>">รายงานเฉพาะร้าน</a>
			       		</li>
		        	</ul>
		      	</li>
		      	<li class="<?= (($session_page == 'config') ?  'active' : 'last'); ?> ">
					<a href="<?= base_url("config") ?>">ตั้งค่า</a>
				</li>
			</ul>
			
			<form name="logout_form" id="logout_form" class="form-inline" role="form" action="<?= base_url("login/logout") ?>" method="post">
				<ul class="nav navbar-nav navbar-right">
					<?php  $log_user = get_cookie('log_cookie'); ?>
					<li><label style="color: #FFFFFF; margin-top: 15px">สวัสดี &nbsp; <?= $log_user ?> &nbsp;</label></li>
					<li>
						<button name="logout_btn" id="logout_btn" type="submit" class="button gray small" style="margin-top: 5px" >
							Logout
						</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>


