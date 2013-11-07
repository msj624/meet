<div id="sidebar">

	<a id="ghost" href="<?php echo get_option('home'); ?>/"></a>
		
	<div id="box-rss" class="box">
		<h2>Feeds</h2>
		<div class="interior">
			<ul>
				<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed">RSS</a></li>
				<li class="email"><a href="#" title="Email">Email</a></li>
				<li class="twitter"><a href="#" title="Twitter">Twitter</a></li>
			</ul>
		</div>
	</div>
	
	<div id="box-search" class="box">
		<h2>Search</h2>
		<div class="interior">
			<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
				<p><input type="text" value="Search" name="s" id="s" /></p>
			</form>
		</div>
	</div>
	
	<div id="box-navmenu" class="box">
		<h2>Navigation Menu</h2>	
		<div class="interior">
			<ul>
				<li<?php echo (is_home() ? ' class="current_page_item"': '')?>><a href="<?php echo get_option('home'); ?>/"><span>Home</span></a></li>
				<?php 
					add_filter('wp_list_pages','themefunction_alterlinks');
					wp_list_pages('title_li=&depth=2');
					remove_filter('wp_list_pages','themefunction_alterlinks');
				?>
			</ul>
		</div>
	</div>
	
	<?php include (TEMPLATEPATH . '/banners.php'); ?>
	
	<div id="box-tabs" class="box">
		<h2>Interesting Topics</h2>	
		<div class="interior">
			<ul class="tabs">
				<li class="pop"><a href="#tab-pop"><span>Popular</span></a></li>
				<li class="rec"><a href="#tab-rec"><span>Recent</span></a></li>
				<li class="com"><a href="#tab-com"><span>Active</span></a></li>
			</ul>
			<div class="details" id="tab-pop">
				<?php if (function_exists('akpc_most_popular')) : ?>
				<ul>
					<?php akpc_most_popular(5,'<li>','</li>'); ?>
				</ul>
				<?php else : ?>
				<p class="notice">You have to install <a href="http://wordpress.org/extend/plugins/popularity-contest/">Alex King's Popularity Contest</a> plugin.</p>
				<?php endif; ?>
			</div>
			<div class="details" id="tab-rec">
				<ul>
				<?php wp_get_archives('type=postbypost&limit=5'); ?>
				</ul>
			</div>
			<div class="details" id="tab-com">
				<?php themefunction_recentcomments(); ?>
			</div>
		</div>
	</div>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Side Bar') ) : ?>
	
	<div class="box box-categories">
		<h2>Categories</h2>
		<div class="interior">
			<ul>
			<?php 
				add_filter('wp_list_categories','themefunction_altercategories');
				wp_list_categories('sort_column=name&show_count=1&hierarchical=0&title_li='); 
				remove_filter('wp_list_categories','themefunction_altercategories');
			?>
			</ul>
		</div>
	</div>

	<?php endif; ?>
</div>