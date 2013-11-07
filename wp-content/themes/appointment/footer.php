<?php 
/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appoinment/footer.php
 */


?>




<!-- Footer_Widget_area -->
<div class="hero-unit-footer">
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
			      
                   <?php if(is_active_sidebar('first-footer-widget-area','second-footer-widget-area','third-footer-widget-area','fourth-footer-widget-area')):?>
                            <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
                                 <div class="span3">
                                       <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
                                  </div>
                                <?php endif; ?>
                                
                             <?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?> 
                             <div class="span3">
                              <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
                              </div>
                          
								 
	                          <?php endif; ?>      
                        <?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
                              <div class="span3">
                              <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
                               </div>
                          
								 
	                  <?php endif; ?>
                        <?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
                              <div class="span3">
                              <?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
                               </div>
                          
								 
	                        <?php endif; ?>
            <?php else : ?>                   
               			 
					    <div class="span3">
                       
					    <?php the_widget('WP_Widget_Archives'); ?>
                         </div>
               
							 
						 <div class="span3">
                       
					     <?php the_widget('WP_Widget_Categories'); ?>
                         </div>
	 
						 <div class="span3">
                         <?php
					  the_widget('WP_Widget_Meta'); ?>
                         </div>
               	 
					    <div class="span3">
                         <?php
					  the_widget('WP_Widget_Pages'); ?>
                         </div>
                        
       <?php endif; ?>
                        
 </div>
					
		</div>
	</div>
</div>
<!-- /Footer_Widget_area -->

    <!-- Footer -->
<div class="container">
	<div class="row-fluid">
		<div class="span12 footer_space">
			<div class="span8">
				<p><?php _e(' Powered by ', 'appointment'); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'appointment' ) ); ?>"><?php _e('WordPress', 'appointment'); ?></a>
				
				<?php bloginfo(); ?> <?php echo date( 'Y' ); ?>. <?php _e( 'Designed by', 'appointment' ); ?> <a href="<?php echo esc_url( __( 'http://priyanshumittal.com/','appointment' ) ); ?>"><?php _e( 'Appointment &copy;', 'appointment' ); ?></a>
				<?php _e( 'All Rights Reserved.', 'appointment' ); ?>
				
				</p>
               
            </div>
       <div class="span4">
	<!--		<div class="footer_right">
                	<a class="facebook" href="#">&nbsp;</a>
                    <a class="twitter" href="#">&nbsp;</a>
                    <a class="google" href="#">&nbsp;</a>
          
                </div> -->
		</div>
	</div>
</div>
<?php wp_footer(); ?> 
<!-- /Footer -->
</body>
</html>