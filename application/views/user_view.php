<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<!-- Let's output our user page because of awesomeness-->

<img id="profile_image" src="http://graph.facebook.com/<?php if(isset($facebookPage) && $facebookPage)echo $facebookPage; ?>/picture?width=200&height=200">
<img id="profile_gear" src="<?php echo BASE_URL; ?>static/gear.svg">

<?php include('footer.php'); ?>