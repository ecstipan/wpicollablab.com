<div id="navbar">
	<div class="navbar_link" id="navbar_home">
		<a href="<?php echo BASE_URL; ?>">Home</a>
	</div>
	<div class="navbar_link" id="navbar_users">
		<a href="<?php echo BASE_URL.'users/page/1/'; ?>">Members</a>
	</div>
	<div class="navbar_link" id="navbar_facebook">
		<a href="<?php echo BASE_URL.'facebook/'; ?>">Facebook</a>
	</div>
	<div class="navbar_link" id="navbar_stats">
		<a href="<?php echo BASE_URL.'stats/'; ?>">Stats</a>
	</div>
	<div class="navbar_link" id="navbar_gallery">
		<a href="<?php echo BASE_URL.'gallery/'; ?>">Gallery</a>
	</div>
	
	<!-- BEGIN ACCOUNT-RELATED THINGS-->
	
	<?php if (isset($loggedIn) && $loggedIn == true) 
		echo '
	<div class="navbar_link_profile" id="navbar_logout">
		<a href="'.BASE_URL.'logout/">Logout</a>
	</div>
	<div class="navbar_link_profile" id="navbar_account">
		<a href="'.BASE_URL.'me/">Account</a>
	</div>
	'; else echo '
	<div class="navbar_link_profile" id="navbar_login">
		<a href="'.BASE_URL.'login/">Login</a>
	</div>';
	?>
	
	<?php if (isset($isAdmin) && $isAdmin == true) 
		echo '
	<div class="navbar_link_profile" id="navbar_admin">
		<a href="'.BASE_URL.'admin/">Admin</a>
	</div>';
	?>
</div>
<div id="navbar_shadow"></div>
