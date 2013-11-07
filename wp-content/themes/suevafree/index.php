<?php 

	get_header();

	if ( (!suevafree_setting('suevafree_home')) || (suevafree_setting('suevafree_home') == "home-default") ):
	
		get_template_part('home-default');
		
	else:

		get_template_part('home-blog');
	
	endif;
	
	get_template_part('pagination');
	
	get_footer(); 

?>