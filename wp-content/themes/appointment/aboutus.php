<?php  
/**
   Template Name:About Us
 * @file           aboutus.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 2.3.6
 * @filesource     wp-content/themes/appoinment/aboutus.php
 */

?>
<?php get_header();
  get_template_part('orange','header');
?>
	
 
    
 	<!-- About Us Content -->
		<div class="container">
			<div class="row-fluid about_space_main">
				<div class="span12"> 
				  <?php the_post();?>
				   <?php if(has_post_thumbnail()):?>	
				 <div class="span3"><?php the_post_thumbnail('large',array('class' => 'img-aboutus'));?> </div>
					<?php endif; ?>
			  	<div class="span9">
					<h3 class="wel_head"><?php _e('Welcome to','appointment') ?> <span class="wel_head_orange"><?php the_title();?></span></h3>
			   <p><?php  the_content();?></p>
				 </div>	
	
			
			
  	</div>
 </div>
</div>

	<!-- /About Us Content -->

<?php get_footer(); ?>