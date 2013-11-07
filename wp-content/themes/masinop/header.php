<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php bloginfo('name'); ?>
<?php if ( is_single() ) { ?> :: <?php foreach((get_the_category()) as $cat) { echo $cat->cat_name . ' '; } ?> <?php } ?> 
<?php wp_title(' :: '); ?>
</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE]> 
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-browser-ie.css" type="text/css" media="screen" /> 
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.tabs.js"></script>
<script type="text/javascript">
<!--
/* <![CDATA[ */
$(function() {
	$("input#s").focus(function() {
		$(this).val('');
	});
	$("input#s").blur(function() {
		$(this).val('Search');
	});
	$('div#box-tabs > div.interior > ul').tabs();
	$('div#box-navmenu ul > li:first a').css('border-top','none');
	$('div#box-navmenu a:last').css('border-bottom','none');
	$('div#tab-pop ul li:last').css('background','transparent none');
	$('div#tab-rec ul li:last').css('background','transparent none');
	$('div#tab-com ul li:last').css('background','transparent none');
});
/* ]]> */
//-->
</script>
</head>

<body>
<div id="container">
	<div id="googleads">
		<div id="googleads-wrapper">
		<!-- Google Adsense Code Start -->
		<script type="text/javascript">
			<!--
			/* <![CDATA[ */
			google_ad_client = "<?php include (TEMPLATEPATH . '/adsense.php'); ?>";
			/* 728x15, Masinop */
			google_ad_slot = "3012614223";
			google_ad_width = 468;
			google_ad_height = 15;
			/* ]]> */
			//-->
		</script>
		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
		<!-- Google Adsense Code End -->
		</div>
	</div>
	
	<div id="title">
		<h1><?php bloginfo('name'); ?></h1>
		<p><?php bloginfo('description'); ?></p>
	</div>

	<div id="wrapper">
		<div id="wrapper-wrapper">