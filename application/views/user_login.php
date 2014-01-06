<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<!-- Let's output our user page because of awesomeness-->
<div id="login_box">
	<form method="POST" action="../users/login/">
		<label>Username</label>
		<input type="text" name="username">
		<label>Password</label>
		<input type="password" name="password">
		<input type="submit" id="login_submit" value="Login">
	</form>
	<input type="submit" id="login_reset" value="Reset Password">
</div>
<?php include('footer.php'); ?>