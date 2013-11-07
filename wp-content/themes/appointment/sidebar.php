<?php
/**
 * Sidebar Template
 *
 @file            sidebar.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appoinment/sidebar.php
*/ 
?>
 <div class="span4 appo_sidebar" id="sidebar">

  <?php if ( !dynamic_sidebar('sidebar-primary') ) : ?>     
						
		<?php the_widget('WP_Widget_Archives'); ?>
		<?php the_widget('WP_Widget_Categories'); ?>
		<?php the_widget('WP_Widget_Meta'); ?>
		<?php the_widget('WP_Widget_Pages'); ?>
																					
								 
	<?php endif;?>
	
	
	</div>
 