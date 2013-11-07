<!DOCTYPE html>
<html>
<head <?php global $classicbiz; language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link href="http://fonts.googleapis.com/css?family=Arvo|Oswald" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="description" content="<?php bloginfo( 'name' ); ?>" >
	<?php if ((is_single() || is_category() || is_page() || is_home()) && (!is_paged())){} else { ?>
		<meta name="robots" content="noindex,follow" >
	<?php } ?>
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name'); ?> RSS Feed" href="<?php bloginfo( 'rss2_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class()?>>

	<div id="wrapper">

	<div id="logo" class="container">
		<div class="left">
			<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
			<p><?php bloginfo('description'); ?></p>
		</div>
		<div class="right">
			<!-- Spot 1 -->
			<?php if ($classicbiz->hideSpot1() !== 'true' ){ ?>
				<div class="spot">
					<?php if ($classicbiz->spot1Content() != '') : ?>
					<?php echo $classicbiz->spot1Content(); ?>
					<?php else : ?>
						<p>Show your <a href="">contact information</a> here, or display a banner ad easily by editing <b>Spot 1</b> in the Header section of the <em>ClassicBiz Options</em> page.</p>
					<?php endif; ?>			
				</div>
			<?php } ?>
		<!-- End spot 1 -->
		</div>
	</div>
	<div id="menu" class="container">
		<ul>
			<li class="<?php if (is_home()) echo 'selected'; ?>"><a href="<?php echo home_url(); ?>/" class="<?php if (is_home()) echo 'selected'; ?>">Home</a></li>
		</ul>
		<?php classicbiz_nav(); ?>
	</div>
	<?php if ($classicbiz->hideFeatured() !== 'true' ): ?>	
	<div id="featured" class="container">
		<div class="text">
			<?php if ($classicbiz->titleFeatured() != '') : ?>
				<h2><?php echo $classicbiz->titleFeatured(); ?></h2>
			<?php else : ?>
				<h2>Get Your Message Out with ClassicBiz</h2>
			<?php endif; ?>	
			<?php if ($classicbiz->headerFeatured() != '') : ?>
				<?php echo $classicbiz->headerFeatured(); ?>
				<?php else : ?>					
					<p>Replace this with your custom text in the Header section of the <em>ClassicBiz Options</em> page. Type some stuff in the box, click save, and your new Featured section shows up in the header. You can also update the Featured image with your custom one. You can hide this whole section by checking the related box in the <em>ClassicBiz Options</em>.</p>
			<?php endif; ?>
					<p><a href="<?php if ($classicbiz->buttonUrl() != '' ) { echo $classicbiz->buttonUrl(); } else { echo home_url();} ?>" class="button">
					<?php if ($classicbiz->buttonFeatured() != '') : ?>
						<?php echo $classicbiz->buttonFeatured(); ?>
					<?php else : ?>					
						Read More</a></p>
					<?php endif; ?>
		</div>				
		<div class="img">
			<a href="<?php if ($classicbiz->buttonUrl() != '' ) { echo $classicbiz->buttonUrl(); } else { echo home_url();} ?>"><img src="<?php if ($classicbiz->headerUrl() != '' ) { echo $classicbiz->headerUrl(); } else { echo get_template_directory_uri().'/images/featured/featured_d.png';} ?>" alt="<?php echo bloginfo( 'name'); ?>"></a>
		</div>
	</div>
	<?php endif; ?>	
		
	<div id="page">		
