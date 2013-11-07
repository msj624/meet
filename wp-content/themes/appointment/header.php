<?php  
/**
 * Header Template
 * @file           header.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt

 * @filesource     wp-content/themes/appoinment/header.php
 */
 
  define("AdminAjaxURL", admin_url('admin-ajax.php'));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>"/>
 <title><?php wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />

   
     
	 <!-- Date Picker -->
<?php 
//redify_comment_script();  
			  
		/* Always have wp_head() just before the closing </head>
     	* tag of your theme, or you will break many plugins, which
     	* generally use this hook to add elements to <head> such
     	* as styles, scripts, and meta tags.
     	*/
  
  
   
	wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
<div class="container">
	
	<div class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
			     
    			 <?php   $appointment_header_image = get_header_image();
                         if ( $appointment_header_image ) :
                    ?>
                        <a  class="brand" href="<?php echo home_url( '/' ); ?>">
						<img  src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>"  /> 
						</a>
                  <?php 
					endif;
					?>    		
    
            <div class="nav-collapse collapse navbar-responsive-collapse ">
                 
                <?php
                              if ( has_nav_menu( 'header-menu' ) ):
				
			  wp_nav_menu( array(  'menu'   => 'header-menu',
						   'theme_location' => 'header-menu',
						   'depth'      => 3,
						   'container'  => false,
						   'menu_class' => 'nav',
						   'menu_id'=>'a',
						   'echo'=>'true',
						  
			             // 'fallback_cb'	  =>  'spa_fallback_menu',
						
						 'walker' => new appointment_nav_walker()
							)
							);

	         else:
			         wp_page_menu(array('show_home'=>'HOME','echo'=>false));
	             
				
	           endif;  ?> 
			
		
	     </div><!-- /.nav-collapse -->
		 
            </div>
              </div><!-- /navbar-inner -->
            </div>
  
</div>	<!-- /close of Header -->
