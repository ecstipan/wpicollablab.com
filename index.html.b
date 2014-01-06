<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/tr/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>wpicollablab.com is under construction</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="images/ixcp.css" rel="stylesheet" type="text/css" />

<?php #Hashing Function
$keywords = array("web host",
"web hosting",
"web site hosting",
"web server",
"web site host",
"cheap hosting",
"hosting site",
"hosting website",
"server hosting",
"website hosting",
"dedicated hosting",
"dedicated webhosting",
"best hosting",
"best webhosts",
"cheap web host",
"hosting services",
"web hosting site");

$hash = crc32($_SERVER['HTTP_HOST']);
$index = $hash % count($keywords);

?>

</head>

<body>

<div id="wrapper">
<a href="http://www.ixwebhosting.com" id="logo" class="hideText" target="_blank">Hosted by IX Web Hosting</a>
<div id="content" class="section">
<h1>Website is Under Construction</h1>
<div id="title" class="clearfix"><i>wpicollablab.com</i><br />is currently <strong>UNDER CONSTRUCTION</strong><br />
<span>You can access your website from: <a href="http://66.116.229.186/">66.116.229.186</a></span>
<p>Permanent address access to this website will be available once all DNS servers update themselves in the next few days</p>
</div>
<ul class="floatR right" id="login_links">
<li><a href="https://manage.ixwebhosting.com/" target="_blank" id="ix_helpdesk" class="login_links">Control Panel Login <span>- User-friendly, fast and reliable</span></a></li>
<li><a href="https://manage.ixwebhosting.com/" target="_blank" id="ix_password" class="login_links">Site Studio <span>- Easy to use Online Website Creator</span></a></li>
<li><a href="http://www.ixwebhosting.com/index.php/pages.manual" id="ix_faqs" class="login_links">FAQs and manuals</a></li>
<li><a href="http://blog.ixwebhosting.com" id="ix_blog" class="login_links" target="_blank" rel="nofollow">Visit IX Blog</a></li>
<li><a href="http://status.ixwebhosting.com" id="ix_stats" class="login_links" target="_blank" rel="nofollow">Visit Status Blog</a></li>
</ul>
<div class="clear spacing"></div>
<div id="ipad"><span id="button"></span>
<iframe marginwidth="5" marginheight="5" src="http://www.dsparking.com/?a_id=48883&domainname=wpicollablab.com" frameborder="0" width="100%" height="600"></iframe>
</div>
<div class="clear spacing"></div>
<div class="clear section clearfix">
<h1 class="subtitle">Resources</h1>
<div class="cols2 marginR">
<h2>Hosted by IX Web Hosting</h2>
<img src="images/icon_server.png" alt="Hosted by IX Web Hosting" />
<p><strong>IX Web Hosting</strong> is one of the world's fastest growing hosting companies. We have a superior selection of most generous plans and 24 / 7 telephone support. <br /><br /><a href="http://www.ixwebhosting.com" target="_blank"><?php echo $keywords[$index] ?></a></p>
</div>
<div class="cols2">
<h2>MakeMeRich&trade; Affiliate Program</h2>
<img src="images/icon_money.png" alt="Make Me Rich" />
<p>Become part of the record-breaking IX Web Hosting <strong>Affiliate Program</strong> and receive up to INDUSTRY-LEADING <strong>$150 per Referral.</strong> Join today! <br /><br /><a href="http://www.ixwebhosting.com/index.php/pages.affiliates" target="_blank">Click Here <b>&raquo;</b></a></p>
</div>
</div>
</div>
<div id="footer">
<p>&copy; 1999-<?php echo date("Y") ?> IX Web Hosting. All Rights Reserved</p>
</div>
</div>

</body>
</html>
