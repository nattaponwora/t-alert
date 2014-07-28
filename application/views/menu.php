<div class="navbar navbar-default ">
	<div class="container">
		<div class="navbar-header">
			<a href="<?= base_url("login") ?>" class="navbar-brand">Home</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"></button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li>
					<a href="<?= base_url("temp") ?>">Search</a>
				</li>
				<li>
					<a href="<?= base_url("criticaltemp") ?>">Critical Temperature</a>
				</li>
				<li>
					<a href="<?= base_url("inserttemp") ?>">Insert Temperature</a>
				</li>
				<li>
					<a href="<?= base_url("insertasset") ?>">Insert Asset</a>
				</li>
			</ul>
		</div>
	</div>
</div>